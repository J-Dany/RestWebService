<?php

namespace Controller;

use Controller\Homepage;
use \mysqli;
use Model\Observation;

class EntryPoint
{
    private $route;
    private $connection;

    public function __construct(string $route, mysqli $connection)
    {
        $this->route = $route;
        $this->connection = $connection;
    }

    private function load_template(string $templatefile, array $variables)
    {
        extract($variables);
        ob_start();

        include __DIR__ . "/../../templates/" . $templatefile;
        return ob_get_clean();
    }

    public function load_page()
    {
        if ($this->route === "")
        {
            $c = new Homepage();

            $page = $c->home();
        }
        else if ($this->route === "api")
        {
            if (!empty($_POST))
            {
                http_response_code(406);
                exit;
            }

            $formato = isset($_GET['format'])
                ? $_GET['format']
                : "json";

            $pk = isset($_GET['pk'])
                ? $_GET['pk']
                : null;

            $f = $formato;

            if ($formato === "json")
            {
                $formato = "application/json";
            }
            else if ($formato === "xml")
            {
                $formato = "application/xml";
            }

            header("Content-Type: $formato");

            $object = ucfirst(strtolower($_GET['get']));

            switch ($object)
            {
                case "Observation":
                    $model = new Observation($this->connection, $object, "time");
                break;
            }

            $model->api_prendi($pk);
            echo $model->$f();

            exit;
        }
        else
        {
            http_response_code(404);
            exit;
        }

        $output = $this->load_template($page['template'], $page['variables']);

        extract($page['page_variables']);
        $title = $page['title'];

        include __DIR__ . "/../../templates/layout.html.php";
    }
}