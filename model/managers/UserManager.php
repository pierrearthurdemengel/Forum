<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager
{

    protected $className = "Model\Entities\User";
    protected $tableName = "user";


    public function __construct()
    {
        parent::connect();
    }

    public function retrievePassword($email)
    {
        $id = $_GET["id"];
        // récupérer le mdp de l'utilisateur par le mail
        $sql = "SELECT password, email 
        FROM user u 
        WHERE id_user = :id ";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id], true),
            $this->className
        );
        // l'envoyer par mail à l'adresse mail correspondante
    }

    public function add($data){
        //$keys = ['username' , 'password', 'email']
        $keys = array_keys($data);
        //$values = ['Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com']
        $values = array_values($data);
        //"username,password,email"
        $sql = "INSERT INTO ".$this->tableName."
                (".implode(',', $keys).") 
                VALUES
                ('".implode("','",$values)."')";
                //"'Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com'"
        /*
            INSERT INTO user (username,password,email) VALUES ('Squalli', 'dfsyfshfbzeifbqefbq', 'sql@gmail.com') 
        */
        try{
            return DAO::insert($sql);
        }
        catch(\PDOException $e){
            echo $e->getMessage();
            die();
        }
    }
    public function registerManager($pseudo, $email, $password)
    {
        $sql = "INSERT INTO " . $this->tableName . " (pseudo, email, password) VALUES (:pseudo, :email, :password)";

        return $this->getMultipleResults(
            DAO::insert($sql),
            $this->className
        );
    }

    // public function loginManager()
    // {
    //     $sql = "SELECT email, password
    //     FROM ".$this->tableName;

    //     return $this->getMultipleResults(
    //         DAO::insert($sql),
    //         $this->className
    //     );
    // }


    public function findOneByEmail($email)
    {
        parent::connect();

        $sql = "SELECT *
            FROM user
            WHERE email = :email";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
    }

    public function checkUserByEmail($email){
        parent::connect();

            $sql = "SELECT *
                    FROM ".$this->tableName."
                    WHERE email = :email
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false), 
                $this->className
            );
    }

    public function checkPseudo($pseudo){
        parent::connect();

            $sql = "SELECT *
                    FROM ".$this->tableName."
                    WHERE pseudo = :pseudo
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['pseudo' => $pseudo], false), 
                $this->className
            );
    }

    public function checkPassword($email){
        parent::connect();

            $sql = "SELECT *
                    FROM ".$this->tableName."
                    WHERE mail = :email
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false), 
                $this->className
            );
    }

    public function updatePassword($id,$newPassword) {
        parent::connect();

            $sql = "UPDATE ".$this->tableName."
                    SET password = :newPassword
                    WHERE id_".$this->tableName." = :id
                    ";

            DAO::update($sql, ['id' => $id,'newPassword' => $newPassword]);
    }
}
