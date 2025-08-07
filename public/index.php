<?php

require_once "../config/configDb.php";
require_once "../app/core/App.php";
require_once "../app/core/Controller.php";
require_once "../config/config.php";

/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

spl_autoload_register(function ($class) {
    if(file_exists("../app/controllers/$class.php")) {
        require_once "../app/controllers/$class.php";
    } else if(file_exists("../app/models/$class.php")) {
        require_once "../app/models/$class.php";
    }
});

$app = new App();
?>