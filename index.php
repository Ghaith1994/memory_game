<?php
require_once('Controllers/GameController.php');

$route = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

session_start();

switch ($route ?? '') {

    case '':
    case '/':
        (new GameController)->index();
        break;

    case "/check-result":
        (new GameController)->checkResult();
        break;

    default:
        include 'Views/404.php';
        break;

}
