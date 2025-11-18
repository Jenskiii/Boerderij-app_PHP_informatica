<?php
// make .env work with composer
require __DIR__ . "/../../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
class Database
{
    private $pdo;

    public function __construct()
    {
        // VARIABLES
        $host = $_ENV["DB_HOST"];
        $db = $_ENV["DB_NAME"];
        $charset = 'utf8mb4';
        $user = $_ENV["DB_USER"];
        $password = $_ENV["DB_PASSWORD"];

        // DSN 
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // MAKE it so never have to write: PDO::FETCH_ASSOC inside fetch() or fetchAll()
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

    }
    
    public function getConnection()
    {
        return $this->pdo;
    }
}
