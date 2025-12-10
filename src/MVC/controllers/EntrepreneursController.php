<?php
class EntrepreneursController
{
    public function entrepreneurs(): void
    {
        // als iemand geen admin of medewerker is, redirect home
        if (!isLoggedIn()) {
            header("Location: /");
            exit;
        }

        require_once "../src/MVC/views/entrepreneurs.php";
    }
}