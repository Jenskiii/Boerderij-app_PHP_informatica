<?php
require_once "../src/config/database.php";
// fetch vak data voor automaat
class AutomaatVak
{
  private $pdo;
  private $productModel;
  public function __construct()
  {
    $db = new Database();
    $this->pdo = $db->getConnection();
    // models
    $this->productModel = new Product();
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
      $product = $productModel->getSpecificProduct($vak['product_id']);
      // als product is ingevoerd geef product anders null
      $vak['product'] = $product ?: null;
      // set all product variables
      $vak['product_name'] = $product['naam'] ?? 'geen product';
      $vak['product_price'] = $product['verkoopprijs_per_stuk'] ?? '0.00';
      $vak['product_img'] = $product['afbeelding'] ?? 'assets/images/uploaded/default-image.png';
    }
    // return
    return $vakken;
  }

  public function sellProductFromVak($vakId)
  {
    // haal het vak op
    $selectedVak = $this->getSpecificVak($vakId);

    if (!empty($selectedVak['product_id']) && $selectedVak['aantal'] > 0) {
      // verminder voorraad van product
      $success = $this->productModel->decreaseProductStock($selectedVak['product_id']);

      // verminder voorraad van vak
      $stmt = $this->pdo->prepare("
                UPDATE vak
                SET aantal = aantal - 1
                WHERE vak_id = ? AND aantal > 0
            ");

      $stmt->execute([$vakId]);

      // check of productvoorraad op is
      if (!$success) {
        header("Location: /?error=outofstock");
        exit;
      }
    }

    // terug naar home
    header("Location: /?succes");
    exit;
  }

}