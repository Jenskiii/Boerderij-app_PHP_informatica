<?php
class SlotManagementController
{
  private $vakModel;
  private $productModel;
  public function __construct()
  {
    $this->vakModel = new VakkenModel();
    $this->productModel = new ProductModel();
  }


  // MAIN
  public function slotManagement()
  {
    // user not logged in? redirect home \\\ extra safety on top of router
    if (!isLoggedIn()) {
      header("Location: /");
      exit;
    }

    // JS LINK
    $jsLinks = ['handleUrl.js',];

    // fetch all vakken with products
    $slotsWithProducts = $this->vakModel->getAllVakkenWithProducts($this->productModel);
    $getAllProductsInStock = $this->productModel->getAllProductsInStock();


    // check if vak is full
    foreach ($slotsWithProducts as &$vak) {
      $vak["status"] = match ($vak["aantal"]) {
        0 => 'Leeg',
        default => 'Gevuld'
      };
    }
    unset($vak);

    require_once "../src/MVC/views/slots/slotManagement.php";
  }



  // ADD PRODUCT
  public function slotManagementAddProduct()
  {
    if (!isLoggedIn()) {
      header("Location: /");
      exit;
    }

    // set value to int
    $productId = (int) ($_POST['product_option_id']);
    $vakId = (int) $_GET['vak_id'];

    // bind product to slot
    $succesAdd = $this->vakModel->addProductToVak($vakId, $productId);
    // set product status to "in use"
    $successStatus = $this->productModel->updateProductStatus($productId);

    // if error
    if (!$succesAdd || !$successStatus) {
      header("Location: /vakkenbeheer?error");
      exit;
    }

    // return
    header("Location: /vakkenbeheer?success");
    exit;
  }


  // EMPTY VAK
  public function slotManagementEmptyVak()
  {
    if (!isLoggedIn()) {
      header("Location: /");
      exit;
    }
    // post value
    $vakId = (int) ($_POST['vak_delete_id']);

    // remove product from vak
    $success = $this->vakModel->emptyVak($vakId);

    // if error
    if (!$success) {
      header("Location: /vakkenbeheer?error");
      exit;
    }
    // else return with succes
    header("Location: /vakkenbeheer?success");
    exit;
  }

  // EDIT VAK 
  public function slotManagementEditVak()
  {
    if (!isLoggedIn() || !isPost()) {
      header("Location: /");
      exit;
    }
    // post value
    $vakId = (int) ($_POST['vak_edit_id']);

    // call functions
    $selectedVak = $this->vakModel->getSpecificVak($vakId);
    $selectedProduct = $this->productModel->getSpecificProduct($selectedVak["product_id"]);
    $selectedProductStock = $this->productModel->getProductStock($selectedVak["product_id"]);
    $allProductsInStock = $this->productModel->getAllProductsInStock();


    require_once "../src/MVC/views/slots/slotEdit.php";
  }



  // safe changes
  public function slotManagementEditSafe()
  {
    if (!isLoggedIn() || !isPost()) {
      header("Location: /");
      exit;
    }

    // update vak with new value's
    $vakId = $_POST["edit_vak_id"];
    $productId = $_POST["edit_product_id"];
    $newAmount = (int) $_POST['edit_product_amount'];
    $newStorage = $_POST['edit_product_storage'];


    // update values
    $success = $this->productModel->updateProductStock($productId, $newStorage);

    if (!$success) {
      header("Location: /vakkenbeheer?error");
      exit;
    }

    // if new amount = 0 empty vak, else update status to 1
    if ($newAmount === 0) {
      $this->vakModel->emptyVak($vakId);
    } else {
      $this->vakModel->updateVakStorage($newAmount, $vakId);
    }


    // return
    header("Location: /vakkenbeheer?success");
    exit;
  }
}

