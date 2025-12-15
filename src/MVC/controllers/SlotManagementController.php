<?php

class SlotManagementController
{
  private $vakModel;
  private $productModel;
  public function __construct()
  {
    $this->vakModel = new AutomaatVakModel();
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


    // fetch alle vakken met producten
    $slotsWithProducts = $this->vakModel->getAllVakkenWithProducts($this->productModel);
    $getAllProducts = $this->productModel->getAllProductsInStock();
    require_once "../src/MVC/views/slotManagement.php";
  }

  // ADD PRODUCT
  public function slotManagementAddProduct()
  {
    if (!isLoggedIn()) {
      header("Location: /");
      exit;
    }

    // set value to int
    $vakId = (int) ($_POST['vak_option_id']);
    $productId = (int) ($_POST['product_option_id']);

    // bind product to slot
    $this->vakModel->addProductToVak($vakId, $productId);

    // return
    header("Location: /vakkenbeheer");
    exit;
  }

  // EMPTY VAK
  public function slotManagementEmptyVak()
  {
    if (!isLoggedIn()) {
      header("Location: /");
      exit;
    }

    $vakId = (int) ($_POST['vak_delete_id']);
    // remove product from vak
    $this->vakModel->emptyVak($vakId);

    // return
    header("Location: /vakkenbeheer");
    exit;
  }

  // EDIT VAK 
  public function slotManagementEditVak()
  {
    if (!isLoggedIn()) {
      header("Location: /");
      exit;
    }

    $vakId = (int) ($_POST['vak_edit_id']);

    var_dump($vakId);
    // update vak with new value's

    // // return
    // header("Location: /vakkenbeheer");
    // exit;
  }
}