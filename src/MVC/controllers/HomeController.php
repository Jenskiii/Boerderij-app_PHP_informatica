<?php
require_once "../src/MVC/models/HomeModel.php";
require_once "../src/MVC/models/ProductModel.php";
// DISPLAY FOR VIEW
class HomeController
{
    public function home(): void
    {
        // JS LINK
        $jsLink = "home.js";
        
        // AUTOMAAT
        // get automaat vakken
        $vakModel = new AutomaatVak();
        $productModel = new Product();
        $alleAutomaatVakken = $vakModel->getAllVakkenWithProducts($productModel);

        // vakken verdelen in 2 rije van 5
        $topAutomaatVakken = array_slice($alleAutomaatVakken, 0, 5);
        $bottomAutomaatVakken = array_slice($alleAutomaatVakken, 5, 10);

        require_once "../src/MVC/views/home.php";
    }

}
