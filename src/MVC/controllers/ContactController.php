<?php
class ContactController
{
    public function contact(): void
    {
        // JS LINK
        $jsLinks = ["form.js"];

        require_once "../src/MVC/views/contact.php";
    }
}