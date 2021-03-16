<?php

include __DIR__ . "/../includes/Autoloader.php";
include __DIR__ . "/../includes/Config.php";
include __DIR__ . "/../includes/Connection.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

use Controller\EntryPoint;

$route = rtrim(ltrim(strtok($_SERVER['REQUEST_URI'], "?"), "/"), "/");

if (substr($route, 0, 3) === "api")
{
    $route = "api";
}

$entry_point = new EntryPoint($route, $connection);
$entry_point->loadPage();