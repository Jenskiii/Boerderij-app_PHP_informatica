<?php
class ProductController
{
    private $productModel;
    private $vakModel;
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->vakModel = new VakkenModel();
    }


    // PAGE INFORMATION
    public function product(): void
    {
        // JS LINK
        $jsLinks = ["product.js", "form.js"];

        $filter = $_GET['product_filter'] ?? 'all';
        $products = $this->productModel->getAllProductsWithStock();

        // insert selected filter, then return if case = true
        function filterProduct($product, $filter)
        {
            switch ($filter) {
                case 'in_use':
                    return $product['ingebruik'] == true;
                case 'in_stock':
                    return $product['aantal'] > 0;
                case 'out_of_stock':
                    return $product['aantal'] <= 0;
                default:
                    return true; // alles
            }
        }


        require_once "../src/MVC/views/product/products.php";
    }

    // PAGE INFORMATION
    public function selectedProduct(string $id): void
    {
        $products = ["id" => $id, "name" => "Product $id"];

        require_once "../src/MVC/views/product/selectedProduct.php";
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
