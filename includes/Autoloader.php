<?php

function autoloader($className)
{
    $filename = str_replace("\\", "/", $className) . ".php";

    include __DIR__ . "/../classes/" . $filename;
}

spl_autoload_register("autoloader");