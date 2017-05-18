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

    /**
     * @param $c   <- obiekt app
     * @param $username
     * @param $password
     * @return bool
     */
    public function validateUser($c , $username, $password){
        try{
            $pdo = $c->db;
            $query = $pdo-> prepare("SELECT count(*) as count FROM users WHERE username=:username AND password=:password");
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