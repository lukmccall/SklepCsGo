<?php
// Tekst w <> to przykładowe użycie ;)

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'engine/Users.php';

define('URL', '/SklepCsGo/api');
$_SERVER['REQUEST_URI'] = str_replace(URL, '', $_SERVER['REQUEST_URI']); // todo: TO trzeba zrobić inaczej ale to w wersji koncowej

//Konfiguracja
$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($config);

//Dodanie Containera W Osobnym Pliku
require 'engine/container.php';


$app->get('/', function (Request $request, Response $response) {

    echo ($this->users->validateUserLicence("admin", "admin"))?'Tak':"Nie";
});

$app->get('/delete', function (Request $request, Response $response) {

    var_dump($this->users->deleteLicence(3));
});

$app->get('/test', function (Request $request, Response $response) {
    echo "hello World";
    $this->logger->addInfo("Something interesting happened");
});
$app->run();
