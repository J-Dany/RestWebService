<?php

namespace Controller;

class Homepage
{
    public function home() : array
    {
        return [
            "title" => "Homepage",
            "template" => "homepage.html.php",
            "page_variables" => [ ],
            "variables" => [
                "server_name" => $_SERVER['SERVER_NAME']
            ]
        ];
    }
};