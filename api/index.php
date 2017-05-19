<?php
// Tekst w <> to przykładowe użycie ;)

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'engine/Users.php';
require 'engine/Servers.php';
require 'engine/Services.php';

define('URL', '/SklepCsGo/api');
$_SERVER['REQUEST_URI'] = str_replace(URL, '', $_SERVER['REQUEST_URI']); // todo: TO trzeba zrobić inaczej ale to w wersji koncowej

//Konfiguracja
$config = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($config);

//Dodanie Containera
require 'engine/container.php';

//Grupa Adresów Przeznaczonych Jedynie Dla Ludzi Z Licencją
$app->group('/licence', function (){

    /*SERVERS*/
    $this->put('/addServer', function (Request $request, Response $response){
        $database = $request->getParsedBody()['database'];
        $server = $request->getParsedBody()['server'];

        return $response->withJson($this->servers->addServer($database,$server));

        /* Przykładowy PUT W FORMACIE JSON
         {
            "auth" : {
                 "username" : "admin" ,
                 "password" : "admin"
            },

            "database" : {
                 "host" : "nainformatyke.pl",
                 "dbname" : "lukmccal_sklepuser",
                 "username" : "lukmccal_sklep",
                 "password" : "sklep"
            },

            "server" :{
                "ip" : "132.157.546.256",
                "name" : "Nowy Serwer",
                "shopType" : "1",
                "shopHost" : "Host",
                "shopDbName" : "Nazwa",
                "shopUsername" : "Username",
                "shopPassword" : "Haslo"
            }
            }
         */
    });
    $this->patch('/updateServer/{id}', function (Request $request, Response $response, $arg){
        $database = $request->getParsedBody()['database'];
        $server = $request->getParsedBody()['server'];
        return $response->withJson($this->servers->updateServer($database,$server,$arg['id']));

        /* Przykładowy PUT W FORMACIE JSON
         {
            "auth" : {
                 "username" : "admin" ,
                 "password" : "admin"
            },

            "database" : {
                 "host" : "nainformatyke.pl",
                 "dbname" : "lukmccal_sklepuser",
                 "username" : "lukmccal_sklep",
                 "password" : "sklep"
            },

            "server" :{
                "ip" : "132.157.546.256",
                "name" : "Nowy Serwer",
                "shopType" : "1",
                "shopHost" : "Host",
                "shopDbName" : "Nazwa",
                "shopUsername" : "Username",
                "shopPassword" : "Haslo"
            }
            }
         */
    });
    $this->delete('/deleteServer/{id}', function (Request $request, Response $response, $arg){
        $database = $request->getParsedBody()['database'];
        return $response->withJson($this->servers->deleteServer($database,$arg['id']));

        /* Przykładowy DELETE W FORMACIE JSON
         {
            "auth" : {
                 "username" : "admin" ,
                 "password" : "admin"
            },

            "database" : {
                 "host" : "nainformatyke.pl",
                 "dbname" : "lukmccal_sklepuser",
                 "username" : "lukmccal_sklep",
                 "password" : "sklep"
            }

        }
         */

    });

    /*SERVICES*/
    $this->put('/addService/{id}', function (Request $request, Response $response, $arg){
        $database = $request->getParsedBody()['database'];
        $service = $request->getParsedBody()['service'];

        if($this->servers->isExist($database,$arg['id'])) return $response->withJson($this->services->addService($database,$service,$arg['id']));
        return $response->withJson(["status" => 0, "info" => "Taki serwer nie instnieje"]);
    });
    $this->patch('/updateService/{id}', function (Request $request, Response $response, $arg){
        $database = $request->getParsedBody()['database'];
        $service = $request->getParsedBody()['service'];
        return $response->withJson($this->services->updateService($database,$service,$arg['id']));
    });
    $this->delete('/deleteService/{id}', function (Request $request, Response $response, $arg){
        $database = $request->getParsedBody()['database'];
        return $response->withJson($this->services->deleteService($database,$arg['id']));
    });


})// Middleware - Sprawdzanie Czy Użytkownik Ma Licencję
->add(function ($request, $response, $next){

    $auth = $request->getParsedBody()['auth'];
    $username = $auth['username'];
    $password = $auth['password'];

    if($this->users->validateUserLicence($username,$password)) $response = $next($request, $response);
    else $response=$response->withJson(["status" => 0, "info" => "Odmowa dostępu"]);

    return $response;
});


//Usuwanie Licencji
$app->get('/autoDelete', function (Request $request, Response $response) {
    if($this->users->deleteLicence()) $this->logger->addInfo("Licencje Zostały Usunięte Poprawnie");
    else $this->logger->addInfo("Wystąpił Błąd podczas Usuwania Licencji");
});

$app->run();
