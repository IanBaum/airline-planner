<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Flight.php";
    require_once __DIR__."/../src/City.php";
    date_default_timezone_set("America/New_York");

    $app = new Silex\Application();

    $server = "mysql:host=localhost:8889;dbname=airline";
    $username = "root";
    $password = "root";
    $DB = new PDO ($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));

    $app->get("/", function() use($app){
        return $app["twig"]->render("index.html.twig", array("cities" => City::getAll()));
    });

    $app->post("/departure_city_add", function() use($app) {
        $city = new City($_POST['city-name']);
        $city->save();
        return $app["twig"]->render("index.html.twig", array("cities" => City::getAll()));
    });

    return $app;

?>
