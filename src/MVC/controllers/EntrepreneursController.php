<?php
class EntrepreneursController
{
    public function entrepreneurs(): void
    {
        $title = "ondernemers";
        $content = "hoi ondernemers";
        require_once "../src/MVC/views/entrepreneurs.php";
    }
}