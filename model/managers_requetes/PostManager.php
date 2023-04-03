<?php
// Tous les Managers (dossier Model) hériteront de la classe Manager (dossier App) pour bénéficier des méthodes pré-établies : findAll, findOneById, ...

namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\PostManager;

class PostManager extends Manager{

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";


    public function __construct(){
        parent::connect();
    }

    public function findPostsByTopic($id) {
        $sql = "SELECT *
        FROM " . $this->tableName." p
        WHERE p.topic_id = :id";

        // var_dump($sql);die;

        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::query($sql, ['id' => $id]),
            $this -> className
        );
    }


}