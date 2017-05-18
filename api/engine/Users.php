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
    private $log;
    public function __construct($p, $l)
    {
        $this->pdo = $p;
        $this->log = $l;
    }

    /**
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

        } catch (PDOException $exception){
            $this->log->addInfo("Wystąpił problem");
            return false;
        }
    }

    /**
     * @param $username
     * @param $password
     * @return int  -1 <- brak użytkownika
     */
    public function getUserId($username, $password ){

        if($this->validateUser($username,$password)){
            try{
                $query = $this->pdo-> prepare("SELECT id FROM users WHERE username=:username AND password=:password");
                $query->bindParam(":username", $username);
                $query->bindParam(":password", $password);
                $query->execute();
                $result=$query->fetch();
                return $result['id'];
            } catch (PDOException $exception) {
                $this->log->addInfo("Wystąpił problem");
                return -1;
            }
        }
        return -1;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function validateUserLicence($username, $password){
        $id = $this->getUserId($username,$password);
        if($id>0){
            try{
                $query = $this->pdo->prepare("SELECT COUNT(*) as count FROM licence WHERE user_id=:id");
                $query->bindParam(":id", $id);
                $query->execute();
                $result=$query->fetch();

                if($result['count'] > 0 ){
                    $query = $this->pdo->prepare("SELECT endTime from licence WHERE user_id=:id");
                    $query->bindParam(":id", $id);
                    $query->execute();
                    $result=$query->fetch();

                    $today = new DateTime();
                    $endTime = new DateTime($result['endTime']);

                    if($endTime > $today) return true;
                    else return false;

                }else return false;

            }catch (PDOException $exception) {
                $this->log->addInfo("Wystąpił problem");
                return false;
            }
        }
        return false;
    }

    /**
     * @param null $id
     * @return bool
     */
    public function deleteLicence($id = NULL){
        if($id == NULL){
            try{
                $this->pdo->exec("DELETE FROM licence WHERE endTime < NOW()");
                return true;
            }catch (PDOException $exception){
                return false;
            }
        }
        else{
            try{
                $query = $this->pdo->prepare("DELETE FROM licence WHERE id=:id");
                $query->bindParam(":id", $id);
                $query->execute();
                return true;
            }catch (PDOException $exception) {
                return false;
            }
        }

    }
}