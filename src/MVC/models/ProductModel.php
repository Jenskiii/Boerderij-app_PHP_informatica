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

  // check product stock
  public function getProductStock($id)
  {
    // kijken wat de voorraad is
    $stmt = $this->pdo->prepare("SELECT * FROM voorraad WHERE product_id = ?");
    $stmt->execute([$id]);

    return $stmt->fetch();
  }

  // update product stock
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
}
