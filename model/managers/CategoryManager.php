<?php
// Tous les Managers (dossier Model) hériteront de la classe Manager (dossier App) pour bénéficier des méthodes pré-établies : findAll, findOneById, ...

namespace Model\Managers;

use App\Manager;
use App\DAO;

class CategoryManager extends Manager{

    protected $className = "Model\Entities\Category";
    protected $tableName = "category";


    public function __construct()
    {
        parent::connect();
    }

    public function findCategory($id) 
    {
        $sql = "SELECT *
        FROM " . $this->tableName." p
        WHERE p.topic_id = :id";

        // var_dump($sql);die;

        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::select($sql, ['id' => $id]),
            $this -> className
        );
    }

    public function addCategory($id, $categoryName){
        $sql = "INSERT INTO categoryName 
        VALUES :categoryName";

        return $this-> getMultipleResults(
            DAO::insert($sql, ['id' => $id], true),
            $this->className
        );
    }


    public function listCategorys($id)
    {
        $sql = "SELECT *
        FROM " . $this->tableName;

        // var_dump($sql);die;

        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::select($sql, ['id' => $id], true),
            $this -> className
        );
    }
}