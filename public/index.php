<?php

header("Cache-Control: max-age=0");

include __DIR__ . "/../includes/Autoloader.php";
include __DIR__ . "/../includes/Config.php";
include __DIR__ . "/../includes/Connection.php";

use Controller\EntryPoint;

error_reporting(E_ALL);
ini_set('display_errors', '1');

$route = rtrim(ltrim(strtok($_SERVER['REQUEST_URI'], "?"), "/"), "/");

if (substr($route, 0, 3) === "api")
{
    $route = "api";
}

$entry_point = new EntryPoint($route, $connection);
$entry_point->load_page();