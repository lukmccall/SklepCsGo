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



//Grupa Adresów Przeznaczonych Jedynie Dla Ludzi Z Licencją
$app->group('/licence', function (){
    $this->post('/1', function (Request $request, Response $response){
        echo "1";
    });

    $this->post('/2', function (Request $request, Response $response){
        $date = $request->getParsedBody()['date'];
        echo $date;
    });
})// Middleware - Sprawdzanie Czy Użytkownik Ma Licencję
->add(function ($request, $response, $next){

    $auth = $request->getParsedBody()['auth'];
    $username = $auth['username'];
    $password = $auth['password'];

    if($this->users->validateUserLicence($username,$password)) $response = $next($request, $response);
    else $response->getBody()->write("Odmowa Dostępu"); //todo zmienić to

    return $response;
});


//Usuwanie Licencji
$app->get('/autoDelete', function (Request $request, Response $response) {
    if($this->users->deleteLicence()) $this->logger->addInfo("Licencje Zostały Usunięte Poprawnie");
    else $this->logger->addInfo("Wystąpił Błąd podczas Usuwania Licencji");
});

$app->run();
