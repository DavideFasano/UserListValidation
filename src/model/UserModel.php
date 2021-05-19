<?php

namespace sarassoroberto\usm\model;

use \PDO;
use sarassoroberto\usm\config\local\AppConfig;
use sarassoroberto\usm\entity\User;

class UserModel
{

    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:dbname=' . AppConfig::DB_NAME . ';host=' . AppConfig::DB_HOST, AppConfig::DB_USER, AppConfig::DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // TODO: togliere echo
            echo $e->getMessage();
        }
    }

    // CRUD
    public function create(User $user)
    {

        try {
            $pdostm = $this->conn->prepare('INSERT INTO User (firstName,lastName,email,birthday,password)
            VALUES (:firstName,:lastName,:email,:birthday,:password);');

            $pdostm->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
            $pdostm->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
            $pdostm->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
            $pdostm->bindValue(':birthday', $user->getBirthday(), PDO::PARAM_STR);
            $pdostm->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);

            $pdostm->execute();
        } catch (\PDOException $e) {
            // TODO: Evitare echo
            echo $e->getMessage();
        }
    }


    public function readAll()
    {
        $pdostm = $this->conn->prepare('SELECT * FROM User;');
        $pdostm->execute();
        return $pdostm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, User::class, ['', '', '', '', '']);
    }

    public function readOne($user_id)
    {
        try {
            $sql = "Select * from User where userId=:user_id";
            $pdostm = $this->conn->prepare($sql);
            $pdostm->bindValue('user_id', $user_id, PDO::PARAM_INT);
            $pdostm->execute();
            $result = $pdostm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, User::class, ['', '', '', '', '']);

            return count($result) === 0 ? null : $result[0];
        } catch (\Throwable $th) {

            echo "qualcosa è andato storto";
            echo " " . $th->getMessage();
            //throw $th;
        }
    }


    public function update($user)
    {       //mySQL capisce da se se qualcuno è stato modificato o no
        $sql = "UPDATE User set firstName=:firstName, 
                                lastName=:lastName,
                                email=:email,
                                birthday=:birthday
                                password=:password
                                where userId=:user_id;";
        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $pdostm->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $pdostm->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $pdostm->bindValue(':birthday', $user->getBirthday(), PDO::PARAM_STR);
        $pdostm->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $pdostm->bindValue(':user_id', $user->getUserId());
        $pdostm->execute();

        if ($pdostm->rowCount() === 0) {
            return false;
        } else if ($pdostm->rowCount() === 1) {
            return true;
        }
    }

    public function delete(int $user_id): bool
    {
        $sql = "delete from User where userId=:user_id ";

        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $pdostm->execute();


        if ($pdostm->rowCount() === 0) {
            return false;
        } else if ($pdostm->rowCount() === 1) {
            return true;
        }
    }

    public function autenticate($email, $password)
    {
        
        try {
            //echo"diocane";
            //var_dump($email);
            //var_dump($password);
            $sql = "SELECT * FROM User WHERE email=:email and password=:password";
            $pdostm = $this->conn->prepare($sql);
            $pdostm->bindValue(':email', $email, PDO::PARAM_STR);
            $pdostm->bindValue(':password', $password, PDO::PARAM_STR);
            $pdostm->execute();
            $result = $pdostm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, User::class, ['', '', '', '', '']);
            return count($result) === 0 ? false : true;
        } catch (\Throwable $th) {

            echo "porcodio";
            echo " " . $th->getMessage();
            //throw $th;
        }
    }
}
