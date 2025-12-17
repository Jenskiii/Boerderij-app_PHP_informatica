<?php
require_once "../src/config/database.php";

class OrderModel
{
  // DB CONNECTION
  private $pdo;
  public function __construct()
  {
    $db = new Database();
    $this->pdo = $db->getConnection();
  }

  public function createOrder($productId, $bedrag, $aantal)
  {
    $stmt = $this->pdo->prepare("
            INSERT INTO verkooporders (product_id, aantal, bedrag)
            VALUES (?, ?, ?)
        ");
    $stmt->execute([$productId, $aantal, $bedrag]);
  }
}