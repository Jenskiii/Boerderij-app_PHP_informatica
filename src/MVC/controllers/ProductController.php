<?php
class ProductController
{
    private $vakModel;
    public function __construct()
    {
        $this->vakModel = new AutomaatVakModel();
    }


    // PAGE INFORMATION
    public function product(string $id): void
    {
        $product = ["id" => $id, "name" => "Product $id"];

        require_once "../src/MVC/views/product.php";
    }



    // BUY PRODUCTs
    public function buyProduct($vakId)
    {
        $this->vakModel->sellProductFromVak($vakId);
    }
}
