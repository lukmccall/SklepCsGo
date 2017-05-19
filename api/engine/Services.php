<?php

/**
 * Created by PhpStorm.
 * User: LukMcCall
 * Date: 19.05.2017
 * Time: 09:44
 */
class Services
{

    private $log;

    public function __construct($l)
    {
        $this->log=$l;
    }

    /**
     * @param $database array
     * @param $service array
     * @param $id
     * @return array
     */
    public function addService($database, $service, $id){
        if(isset(   $database['host'],
                    $database['dbname'],
                    $database['username'],
                    $database['password'],
                    $service['name'],
                    $service['flags'],
                    $service['credits'],
                    $service['sms'],
                    $service['psc'],
                    $service['transfer'],
                    $service['time'], $id)){

            try {
                $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['dbname'],
                    $database['username'], $database['password']);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                $query = $pdo->prepare("INSERT INTO services (id,name,server_id,flags,credits,sms,psc,transfer,time) VALUES (NULL,:name,:server_id,:flags,:credits,:sms,:psc,:transfer,:time)");
                $query->bindParam(":name", $service['name']);
                $query->bindParam(":server_id", $id);
                $query->bindParam(":flags", $service['flags']);
                $query->bindParam(":credits", $service['credits']);
                $query->bindParam(":sms", $service['sms']);
                $query->bindParam(":psc", $service['psc']);
                $query->bindParam(":transfer", $service['transfer']);
                $query->bindParam(":time", $service['time']);
                $query->execute();

                $json = ["status" => 1, "info" => "Usługa dodana"];
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

    public function updateService($database, $service, $id){
        if(isset(   $database['host'],
                    $database['dbname'],
                    $database['username'],
                    $database['password'],
                    $service['name'],
                    $service['flags'],
                    $service['credits'],
                    $service['sms'],
                    $service['psc'],
                    $service['transfer'],
                    $service['time'], $id)){

            try {
                $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['dbname'],
                    $database['username'], $database['password']);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                $query = $pdo->prepare("UPDATE services SET name=:name,flags=:flags,credits=:credits,sms=:sms,psc=:psc,transfer=:transfer,time=:time WHERE id=:id");
                $query->bindParam(":name", $service['name']);
                $query->bindParam(":id", $id);
                $query->bindParam(":flags", $service['flags']);
                $query->bindParam(":credits", $service['credits']);
                $query->bindParam(":sms", $service['sms']);
                $query->bindParam(":psc", $service['psc']);
                $query->bindParam(":transfer", $service['transfer']);
                $query->bindParam(":time", $service['time']);
                $query->execute();

                $json = ["status" => 1, "info" => "Usługa zaaktualizowana"];
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
    public function deleteService($database, $id){
        if(isset(   $database['host'],
                    $database['dbname'],
                    $database['username'],
                    $database['password'], $id)){

            try {
                $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['dbname'],
                    $database['username'], $database['password']);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                $query = $pdo->prepare("DELETE FROM services WHERE id=:id");
                $query->bindParam(":id", $id);
                $query->execute();

                $json = ["status" => 1, "info" => "Usługa usunięta"];
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