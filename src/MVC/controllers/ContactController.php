<?php
class ContactController
{
    public function contact(): void
    {
        $title = "Contact Us";
        $content = "This is the contact page. Here you can write details contact your company.";
        require_once "../src/MVC/views/contact.php";
    }
}