<?php

/**
 * Created by PhpStorm.
 * User: LukMcCall
 * Date: 18.05.2017
 * Time: 13:55
 */

/* Klasa Do Obsługi użytkowników */
class Users
{
    private $pdo;

    public function __construct($p)
    {
        $this->pdo = $p;
    }
    /**
     * @param $c   <- obiekt app
     * @param $username
     * @param $password
     * @return bool
     */
    public function validateUser( $username, $password){
        try{

            $query = $this->pdo-> prepare("SELECT count(*) as count FROM users WHERE username=:username AND password=:password");
            $query->bindParam(":username", $username);
            $query->bindParam(":password", $password);
            $query->execute();
            $result=$query->fetch();
            if($result['count'] > 0 ) return true;
            else return false;

        } catch (PDOException $Exception){
            $c->logger->addInfo("Wystąpił problem");
            return false;
        }
    }
}