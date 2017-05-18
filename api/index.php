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


//Usuwanie licencji
$app->get('/autoDelete', function (Request $request, Response $response) {
    if($this->users->deleteLicence()) $this->logger->addInfo("Licencje Zostały Usunięte Poprawnie");
    else $this->logger->addInfo("Wystąpił Błąd podczas Usuwania Licencji");
});

$app->run();
