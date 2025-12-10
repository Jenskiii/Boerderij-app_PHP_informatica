<?php

class VakkenBeheerController
{

  public function main()
  {
    // als iemand geen admin of medewerker is, redirect home
    if (!isLoggedIn()) {
      header("Location: /");
      exit;
    }



    require_once "../src/MVC/views/vakkenBeheer.php";
  }


}