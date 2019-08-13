<?php

# Set to false for running in production
ini_set('display_errors', true); 

require("../vendor/autoload.php");

use Core\App;

$app = new App();
$app->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
