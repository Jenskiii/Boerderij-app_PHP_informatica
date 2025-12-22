<?php
require_once "../src/config/database.php";
class StatisticsModel
{
  private $pdo;
  public function __construct()
  {
    $db = new Database();
    $this->pdo = $db->getConnection();
  }



  // SHOWS STORAGE PER VAK
  public function getStoragePerVak()
  {
    $stmt = $this->pdo->query("
    SELECT  v.positie, p.naam,vo.aantal
    FROM vak v
    LEFT JOIN product p ON v.product_id = p.product_id
    LEFT JOIN voorraad vo ON p.product_id = vo.product_id
    ORDER BY v.vak_id ASC
    ");

    return $stmt->fetchAll();
  }

  // SHOWS SOLD PRODUCTS
  public function getSoldProducts()
  {
    $stmt = $this->pdo->query(
      "
      SELECT 
      p.naam AS product,
      COUNT(vo.product_id) AS aantal_verkocht,
      DATE_FORMAT(p.created_at, '%m-%Y') AS beschikbaar_vanaf
      FROM verkooporders vo
      JOIN product p ON vo.product_id = p.product_id
      GROUP BY vo.product_id, p.naam, DATE_FORMAT(p.created_at, '%m-%Y')
      ORDER BY aantal_verkocht DESC
    "
    );

    return $stmt->fetchAll();
  }


  // SHOWS PROFIT
  public function getProfit()
  {
    $stmt = $this->pdo->query(
      "
      SELECT
      p.naam AS product,
      COUNT(vo.product_id) AS aantal_verkocht,
      p.verkoopprijs * COUNT(vo.product_id) AS omzet,
      (p.verkoopprijs - p.inkoopprijs) * COUNT(vo.product_id) AS brutowinst
      FROM product p
      LEFT JOIN verkooporders vo ON p.product_id = vo.product_id
      GROUP BY p.product_id, p.naam, p.inkoopprijs, p.verkoopprijs
      ORDER BY brutowinst DESC
      "
    );

    return $stmt->fetchAll();
  }

}