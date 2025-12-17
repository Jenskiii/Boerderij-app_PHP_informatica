<?php
require_once "../src/MVC/models/VakkenModel.php";
require_once "../src/MVC/models/ProductModel.php";
require_once "../src/MVC/models/OrderModel.php";
// DISPLAY FOR VIEW
class HomeController
{
    public function home(): void
    {
        // JS LINK
        $jsLinks = [
            "home.js",
            'handleUrl.js',
        ];
        // AUTOMAAT
        // get automaat vakken
        $vakModel = new VakkenModel();
        $productModel = new ProductModel();
        $alleAutomaatVakken = $vakModel->getAllVakkenWithProducts($productModel);

        // vakken verdelen in 2 rije van 5
        $topAutomaatVakken = array_slice($alleAutomaatVakken, 0, 5);
        $bottomAutomaatVakken = array_slice($alleAutomaatVakken, 5, 10);

        require_once "../src/MVC/views/home.php";
    }

}
