<?php
require_once "../src/config/database.php";
// fetch vak data voor automaat
class VakkenModel
{
  private $pdo;
  private $productModel;
  private $orderModel;

  public function __construct()
  {
    // connection
    $db = new Database();
    $this->pdo = $db->getConnection();
    // models
    $this->productModel = new ProductModel();
    $this->orderModel = new OrderModel();

  }



  // fetch alle vakken
  public function getAllVakken()
  {
    // query
    $stmt = $this->pdo->query("SELECT * FROM vak");
    // return
    return $stmt->fetchAll();
  }

  // fetch specifiek vak
  public function getSpecificVak($id)
  {

    // query
    $stmt = $this->pdo->prepare("SELECT * FROM vak WHERE vak_id = ? ");
    // bind param
    $stmt->execute([$id]);
    // return
    return $stmt->fetch();
  }

  // fetch alle vakken met producten
  public function getAllVakkenWithProducts($productModel)
  {
    // fetch alle vakken, zie functie hier boven
    $vakken = $this->getAllVakken();

    // zoek bij elk vak, het passende product via product_id
    foreach ($vakken as &$vak) {
      // fetch product based on id
      $product = $productModel->getSpecificProduct($vak['product_id']);
      // fetch stock based on id
      $stock = $productModel->getProductStock($vak['product_id']);

      // if product return product : else null
      $vak['product'] = $product ?: null;

      // set all product variables
      $vak['product_name'] = $product['naam'] ?? 'geen product';
      $vak['product_price'] = $product['verkoopprijs'] ?? '0.00';
      $vak['product_img'] = $product['afbeelding'] ?? 'assets/images/uploaded/default-image.png';
      $vak['product_id'] = $product['product_id'] ?? rand(1, 1000);

      // set product stock
      $vak['stock'] = $stock['aantal'] ?? 'n.v.t.';
    }
    unset($vak);

    // return
    return $vakken;
  }

  // add to vak
  public function addProductToVak($vakId, $productId)
  {
    // Add product to vak + set value to 1
    $stmt = $this->pdo->prepare("
                UPDATE vak
                SET product_id = ?, aantal = 1
                WHERE vak_id = ? 
            ");
    $stmt->execute([$productId, $vakId]);

    return true;
  }

  // empty vak + update status
  public function emptyVak($vakId)
  {
    // Fetch product id for vak with fetchcollumn
    $stmt = $this->pdo->prepare("SELECT product_id FROM vak WHERE vak_id = ?");
    $stmt->execute([$vakId]);
    $productId = $stmt->fetchColumn();

    // empty vak
    if ($productId) {
      $stmt = $this->pdo->prepare("
            UPDATE vak
            SET product_id = NULL, aantal = 0
            WHERE vak_id = ?
        ");
      $stmt->execute([$vakId]);

      //  Check if product is in use in other vakken
      $stmt = $this->pdo->prepare("
            SELECT COUNT(*) 
            FROM vak
            WHERE product_id = ? AND aantal > 0
        ");
      $stmt->execute([$productId]);
      $count = $stmt->fetchColumn();

      // if no longer in use, set ingebruik to false
      if ($count == 0) {
        $stmt = $this->pdo->prepare("
                UPDATE product
                SET ingebruik = false
                WHERE product_id = ?
            ");
        $stmt->execute([$productId]);
      }
    }
    return true;
  }

  public function updateVakStorage($amount, $vakId)
  {
    // verminder voorraad van vak
    $stmt = $this->pdo->prepare("
                UPDATE vak
                SET aantal = ?
                WHERE vak_id = ? AND aantal > 0
            ");
    $stmt->execute([$amount, $vakId]);

    return true;
  }


  // SELL PRODUCT FROM VAK
  public function sellProductFromVak($vakId, $productId)
  {
    // haal het vak op
    $selectedVak = $this->getSpecificVak($vakId);
    $selectedProduct = $this->productModel->getSpecificProduct($productId);

    if (!empty($selectedVak['product_id']) && $selectedVak['aantal'] > 0) {
      // verminder voorraad van product
      $success = $this->productModel->updateProductStock($selectedVak['product_id'], -1);

      // Create order
      $this->orderModel->createOrder($productId, $selectedProduct["verkoopprijs"], 1);

      // Empty vak
      $this->emptyVak($vakId);



      // check of productvoorraad op is
      if (!$success) {
        header("Location: /?error=outofstock");
        exit;
      }
    }

    // terug naar home
    header("Location: /?success=payment");
    exit;
  }
}




