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
     * @param $id
     * @return bool
     */
    public function isExist($database, $id){
        if(isset(   $database['host'],
                    $database['dbname'],
                    $database['username'],
                    $database['password'], $id)) {
            try {
                $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['dbname'],
                    $database['username'], $database['password']);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                $query = $pdo->prepare("SELECT COUNT(*) as count FROM servers WHERE id=:id");
                $query->bindParam(":id", $id);
                $query->execute();
                $result = $query->fetch();
                return ($result['count']>0)?true:false;

            }catch (PDOException $exception){
                return false;
            }

            } else return false;
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

    /**
     * @param $database array
     * @param $id
     * @return array
     */
    public function deleteServer($database, $id){
        if(isset(   $database['host'],
                    $database['dbname'],
                    $database['username'],
                    $database['password'], $id)){

            try {
                $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['dbname'],
                    $database['username'], $database['password']);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                $query = $pdo->prepare("DELETE FROM servers WHERE id=:id");
                $query->bindParam(":id", $id);
                $query->execute();

                $json = ["status" => 1, "info" => "Serwer został usuniety"];
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

    /**
     * @param $database array
     * @param $server array
     * @param $id
     * @return array
     */
    public function updateServer($database, $server, $id){
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
                    $server['shopPassword'], $id)){

            try {
                $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['dbname'],
                    $database['username'], $database['password']);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                $query = $pdo->prepare("UPDATE servers SET ip=:ip, name=:name, shopType=:shopType, shopHost=:shopHost, shopDbName=:shopDbName, shopUsername=:shopUsername, shopPassword=:shopPassword WHERE id=:id");
                $query->bindParam(":id", $id);
                $query->bindParam(":ip", $server['ip']);
                $query->bindParam(":name", $server['name']);
                $query->bindParam(":shopType", $server['shopType']);
                $query->bindParam(":shopHost", $server['shopHost']);
                $query->bindParam(":shopDbName", $server['shopDbName']);
                $query->bindParam(":shopUsername", $server['shopUsername']);
                $query->bindParam(":shopPassword", $server['shopPassword']);
                $query->execute();

                $json = ["status" => 1, "info" => "Serwer Zaaktualizowany"];
                return $json;

            }   catch (PDOException $Exception){
                $json = ["status" => 0, "info" => "Nie udało się połączyć z bazą danych".$Exception->getMessage()];
                return $json;
            }
        }
        else{
            $json = ["status" => 0, "info" => "Błądne dane"];
            return $json;
        }

    }

}