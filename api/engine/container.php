<?php
/**
 * Created by PhpStorm.
 * User: LukMcCall
 * Date: 18.05.2017
 * Time: 15:10
 */

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

// Dodawanie Klasy Users <$this->user;>
$container['users'] = function ($c){
    $users = new Users($c->db, $c->logger);
    return $users;
};

// Dodawanie Klasy Servers <$this->servers;>
$container['servers'] = function ($c){
    $servers = new Servers($c->db, $c->logger);
    return $servers;
};