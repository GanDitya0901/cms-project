<?php
declare(strict_types= 1);
class Controller {
    public function __construct() {
        require_once "../config/configSession.php";
    }
    
    public function view(string $view) {
        require_once "../app/views/$view.php";
    }

    public function viewWithData(string $view, array $data = []) {
        extract($data);
        require_once "../app/views/$view.php";
    }
}
?>