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

$container = $app->getContainer();


// Dodanie Logera <$this->logger->addInfo("Something interesting happened");>
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('Log');
    $file_handler = new \Monolog\Handler\StreamHandler("./log/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

// Dodanie Bazy danych < $db = $this->db; >
$container['db'] = function ($c) {
    $db = [
        'host' => 'nainformatyke.pl',
        'dbname' => 'lukmccal_sklep',
        'user' => 'lukmccal_sklep',
        'pass' => 'sklep',
    ];
    try {
        $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
            $db['user'], $db['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }   catch (PDOException $Exception){
        $c->logger->addInfo("Nie udało się połączyć z bazą danych");
        return false;
    }
};


$container['users'] = function ($c){
    $users = new Users($c->db);
    return $users;
};


$app->get('/', function (Request $request, Response $response) {

    echo $this->users->validateUser("admin", "admin");

});

$app->get('/test', function (Request $request, Response $response) {
    echo "hello World";
    $this->logger->addInfo("Something interesting happened");
});
$app->run();
