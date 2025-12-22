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


    // //////////////////
    // MAIN PRODUCT
    /////////////////////
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




    // //////////////////
    // EDIT PRODUCT
    /////////////////////
    public function editProduct(): void
    {
        isPosted("/product");
        // JS LINK
        $jsLinks = ["form.js"];

        $productId = $_POST['edit_product_id'];
        $product = $this->productModel->getSpecificProduct($productId);
        $voorraad = $this->productModel->getProductStock($productId);

        require_once "../src/MVC/views/product/editProduct.php";
    }


    // //////////////////
    // SAFE EDIT PRODUCT
    /////////////////////
    public function safeEditProduct(): void
    {
        // check if posted
        isPosted("/product");

        // set variables
        $productId = $_POST['edit_pid'];
        $editInkoopprijs = $_POST['edit_pinkoopprijs'];
        $editVerkooprijs = $_POST['edit_pverkoopprijs'];
        $editVoorraad = $_POST['edit_pvoorraad'];

        // insert product details
        $productSuccess = $this->productModel->updateProductPrice(
            $productId,
            $editInkoopprijs,
            $editVerkooprijs,
        );

        $voorraadSuccess = $this->productModel->updateProductStock($productId, $editVoorraad);


        //SUCCES return to product page 
        if ($voorraadSuccess && $productSuccess) {
            header("Location: /product?success=change");
            exit;
        }

        // ERROR
        header("Location: /product?error=standard");
        exit;
    }


    // //////////////////
    // BUY PRODUCT
    /////////////////////
    public function buyProduct()
    {
        // check if request is post
        isPosted();

        // POST DATA top or bottom form
        $vakId = $_POST["buyProduct_vakId_top"] ?? $_POST["buyProduct_vakId_bottom"] ?? null;
        $productId = $_POST["buyProduct_productId_top"] ?? $_POST["buyProduct_productId_bottom"] ?? null;

        $this->vakModel->sellProductFromVak($vakId, $productId);
    }


    // //////////////////
    // ADD NEW PRODUCT
    /////////////////////
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










    // -------------------------------------------------------------------------------
    // NIET INGEBRUIK VERWIJDERT TEVEEL DATA, ZOALS ORDERS 
    // WEL LATEN STAAN VOOR ALS HET IN DE TOEKOMST MISSCHIEN NODIG IS
    // //////////////////
    // DELETE PRODUCT
    /////////////////////
    // public function deleteProduct(): void
    // {
    //     // check if posted else return
    //     isPosted("/product");

    //     // QUERY
    //     if (isset($_POST['deleteProductId'])) {
    //         $productId = (int) $_POST['deleteProductId'];

    //         $succes = $this->productModel->deleteProduct($productId);

    //         // RETURN WITH SUCCESS
    //         if ($succes) {
    //             header("Location: /product?success=product_delete");
    //             exit;
    //         }
    //     }

    //     // ELSE RETURN WITH ERROR
    //     header("Location: /product?error=standard");
    //     exit;
    // }

}
