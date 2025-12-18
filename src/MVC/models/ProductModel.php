<?php
require_once "../src/config/database.php";

class ProductModel
{
  // DB CONNECTION
  private $pdo;
  public function __construct()
  {
    $db = new Database();
    $this->pdo = $db->getConnection();
  }


  // ALL PRODUCTS
  // fetch alle producten
  public function getAllProducts()
  {
    // query
    $stmt = $this->pdo->query("SELECT * FROM product");
    return $stmt->fetchAll();
  }



  // SINGLE PRODUCT
  // fetch product dat overkomt met id
  public function getSpecificProduct($id)
  {
    // query
    $stmt = $this->pdo->prepare("SELECT * FROM product WHERE product_id = ?");
    $stmt->execute([$id]);

    $product = $stmt->fetch();
    // return product else null
    return $product ?: null;
  }

  // get products that are in stock
  public function getAllProductsInStock()
  {
    $stmt = $this->pdo->query("
        SELECT product.product_id, product.naam, voorraad.aantal
        FROM product
        INNER JOIN voorraad  ON product.product_id = voorraad.product_id
        WHERE voorraad.aantal > 0
    ");
    return $stmt->fetchAll();
  }

  // get products with stock
  public function getAllProductsWithStock()
  {
    $stmt = $this->pdo->query("
        SELECT product.*, voorraad.aantal
        FROM product
        INNER JOIN voorraad  ON product.product_id = voorraad.product_id
    ");
    return $stmt->fetchAll();
  }

  // check product stock
  public function getProductStock($id)
  {
    // kijken wat de voorraad is
    $stmt = $this->pdo->prepare("SELECT * FROM voorraad WHERE product_id = ?");
    $stmt->execute([$id]);

    return $stmt->fetch();
  }

  // UPDATE STOCK
  public function updateProductStock($id, $amount)
  {
    // als er voorraad is, start functie
    $stmt = $this->pdo->prepare("
      UPDATE voorraad 
      SET aantal = ?
      WHERE product_id = ?
      AND ? >= 0 ");
    return $stmt->execute([$amount, $id, $amount]);
  }


  //UPDATE STATUS
  public function updateProductStatus($id)
  {
    $stmt = $this->pdo->prepare("
    UPDATE product
    SET ingebruik = true
    WHERE product_id = ?
    AND ingebruik != true
    ");
    return $stmt->execute([$id]);
  }


  // CREATE NEW PRODUCT
  public function createProduct($naam, $inkoopprijs, $verkoopprijs, $afbeelding, $voorraad)
  {
    // INSERT INTO PRODUCT TABLE
    $stmt = $this->pdo->prepare("
            INSERT INTO product (naam, inkoopprijs, verkoopprijs, afbeelding)
            VALUES (?, ?, ?, ?)
        ");
    $stmt->execute([$naam, $inkoopprijs, $verkoopprijs, $afbeelding]);



    // GET NEW PRODUCT ID
    $productId = $this->pdo->lastInsertId();

    // CREATE PRODUCT STOCK
    $stmt = $this->pdo->prepare("
      INSERT INTO voorraad (product_id, aantal)
      VALUES (?, ?)
    ");
    
    $stmt->execute([$productId, $voorraad]);

    return true;
  }


}

