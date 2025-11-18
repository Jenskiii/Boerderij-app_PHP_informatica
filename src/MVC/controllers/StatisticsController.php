<?php
class StatisticsController {
    public function statistics(): void {
        $title = "hi statistics";
        require_once  "../src/MVC/views/statistics.php";
    }
}