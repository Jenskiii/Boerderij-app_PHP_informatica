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
        $jsLinks = ["product.js", "form.js", "handleUrl.js"];
        // models
        $products = $this->productModel->getAllProductsWithStock();

        // filter
        $filter = $_GET['product_filter'] ?? 'all';
        // switch case to filter products
        // insert selected filter, then return if case = true
        function filterProduct($product, $filter)
        {
            switch ($filter) {
                case 'in_use':
                    return $product['ingebruik'] == true;
                case 'not_in_use':
                    return $product['ingebruik'] == false;
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


    // EDIT PRODUCT
    public function editProduct(): void
    {

        require_once "../src/MVC/views/product/editProduct.php";
    }

    // DELETE PRODUCT
    public function deleteProduct(): void
    {

    }



    // BUY PRODUCTs
    public function buyProduct()
    {
        // check if request is post
        isPosted();

        // POST DATA top or bottom form
        $vakId = $_POST["buyProduct_vakId_top"] ?? $_POST["buyProduct_vakId_bottom"] ?? null;
        $productId = $_POST["buyProduct_productId_top"] ?? $_POST["buyProduct_productId_bottom"] ?? null;

        $this->vakModel->sellProductFromVak($vakId, $productId);
    }


    // ADD NEW PRODUCT
    public function addProduct()
    {
        // check if request is post
        isPosted("/product?error=no_post");

        // if no image uploaded return + send message
        if (empty($_FILES)) {
            header("Location: /product?error=no_file");
            exit;
        }

        /////////////
        // FORM DATA
        ///////////
        $newProductNaam = Ucfirst(strtolower($_POST['new_pname'])) ?? null;
        $newInkoopprijs = $_POST['new_pinkoopprijs'] ?? null;
        $newVerkooprijs = $_POST['new_pverkoopprijs'] ?? null;
        $newVoorraad = $_POST["new_pvoorraad"] ?? null;

        // Handle formdata
        // only letters allowd, and spacebar but not double spacebar
        if (!preg_match('/^[a-zA-Z]+(?: [a-zA-Z]+)*$/', $newProductNaam)) {
            header("Location: /product?error=invalid_letter_input");
            exit;
        }
        // only numbers
        if (!is_numeric($newInkoopprijs) && !is_numeric($newVerkooprijs) && !is_numeric($newVoorraad)) {
            header("Location: /product?error=invalid_number_input");
            exit;
        }



        // Get uploaded image input
        $uploadedImage = $_FILES['new_pimage'];
        // handle image upload
        $imagePath = handleImageUpload($uploadedImage);

        // insert product details
        $this->productModel->createProduct(
            $newProductNaam,
            $newInkoopprijs,
            $newVerkooprijs,
            $imagePath,
            $newVoorraad
        );

        // return to product page
        header("Location: /product?success=add_product");
        exit;
    }
}
