<?php
class AboutController
{
    public function about(): void
    {
        $title = "About Us";
        $content = "This is the about page. Here you can write details about your company.";
        require_once "../src/MVC/views/about.php";
    }
}