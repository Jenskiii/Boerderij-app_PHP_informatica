<?php
require_once "../src/config/database.php";
require_once "../src/MVC/models/StatisticsModel.php";
class StatisticsController
{
    private $pdo;
    private $statisticsModel;
    function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
        $this->statisticsModel = new StatisticsModel();
    }


    public function statistics(): void
    {

        $jsLinks = ["form.js"];
        $statisticsFilter = $_GET['statistics_filter'] ?? 'voorraad';
        $currencyColumns = ['omzet', 'brutowinst', 'inkoopprijs', 'voorraad_waarde'];

        // Check's if key is inside currencyColumns
        // yes = print EURO sign + value
        // no = print value
        function hasCurrency($array, $key, $value)
        {
            if (in_array($key, $array)) {
                return "&#8364; " . htmlspecialchars($value);
            }

            return $value;
        }

        // handle
        switch ($statisticsFilter) {
            case 'voorraad':
                $data = $this->statisticsModel->getStoragePerVak();
                $headers = ['Vak', 'Product', 'Huidige Voorraad'];
                break;
            case 'verkocht':
                $data = $this->statisticsModel->getSoldProducts();
                $headers = ['Product', 'Aantal Verkocht', 'In assortiment sinds'];
                break;
            case 'winst':
                $data = $this->statisticsModel->getProfit();
                $headers = ['Product', 'Aantal verkocht', 'Omzet', 'Brutowinst'];
                break;
            case 'verkoopfrequentie':
                $data = $this->statisticsModel->getSalesFrequency();
                $headers = ['Product', 'Aantal bestellingen', 'Eerste verkoop', 'Laatste verkoop'];
                break;
            case 'voorraadwaarde':
                $data = $this->statisticsModel->getStockValue();
                $headers = ['Product', 'Aantal op voorraad', 'Inkoopprijs', 'Totale voorraadwaarde'];
                break;

            default:
                $data = [];
                $headers = [];
        }
        require_once "../src/MVC/views/statistics.php";
    }
}