<?php

/**
 * Created by PhpStorm.
 * User: LukMcCall
 * Date: 18.05.2017
 * Time: 20:42
 */
class Servers
{
    private $log;

    public function __construct($l)
    {
        $this->log = $l;

    }

    /**
     * @param $database array
     * @param $server array
     * @return array
     */
    public function addServer($database, $server){
        if(isset(   $database['host'],
                    $database['dbname'],
                    $database['username'],
                    $database['password'],
                    $server['ip'],
                    $server['name'],
                    $server['shopType'],
                    $server['shopHost'],
                    $server['shopDbName'],
                    $server['shopUsername'],
                    $server['shopPassword'])){

            try {
                $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['dbname'],
                    $database['username'], $database['password']);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                $query = $pdo->prepare("INSERT INTO servers (id,ip,name,shopType,shopHost,shopDbName,shopUsername,shopPassword) VALUES (NULL,:ip,:name,:shopType,:shopHost,:shopDbName,:shopUsername,:shopPassword)");
                $query->bindParam(":ip", $server['ip']);
                $query->bindParam(":name", $server['name']);
                $query->bindParam(":shopType", $server['shopType']);
                $query->bindParam(":shopHost", $server['shopHost']);
                $query->bindParam(":shopDbName", $server['shopDbName']);
                $query->bindParam(":shopUsername", $server['shopUsername']);
                $query->bindParam(":shopPassword", $server['shopPassword']);
                $query->execute();

                $json = ["status" => 1, "info" => "Serwer dodany"];
                return $json;

            }   catch (PDOException $Exception){
                $json = ["status" => 0, "info" => "Nie udało się połączyć z bazą danych"];
                return $json;
            }
        }
        else{
            $json = ["status" => 0, "info" => "Błądne dane"];
            return $json;
        }
    }


}