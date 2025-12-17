<?php
class ProductController
{
    private $vakModel;
    public function __construct()
    {
        $this->vakModel = new VakkenModel();
    }


    // PAGE INFORMATION
    public function product(string $id): void
    {
        $product = ["id" => $id, "name" => "Product $id"];

        require_once "../src/MVC/views/product.php";
    }



    // BUY PRODUCTs
    public function buyProduct()
    {
        if (!isPost()) {
            header("Location: /");
            exit;
        }

        // POST DATA top or bottom form
        $vakId = $_POST["buyProduct_vakId_top"] ?? $_POST["buyProduct_vakId_bottom"] ?? null;
        $productId = $_POST["buyProduct_productId_top"] ?? $_POST["buyProduct_productId_bottom"] ?? null;

        $this->vakModel->sellProductFromVak($vakId, $productId);

    }
}
