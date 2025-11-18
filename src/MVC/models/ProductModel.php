<?php
require_once "../src/config/database.php";

class Product
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

  public function productStock($id)
  {
    // kijken wat de voorraad is
    $stmt = $this->pdo->prepare("SELECT * FROM voorraad WHERE product_id = ?");
    $stmt->execute([$id]);

    return $stmt->fetch();
  }

  // decrease product stock
  public function decreaseProductStock($id)
  {
    // als er voorraad is, start functie
    $stmt = $this->pdo->prepare("
      UPDATE voorraad 
      SET aantal = aantal -1 
      WHERE product_id = ?
      AND aantal > 0 ");
    return $stmt->execute([$id]);
  }
}