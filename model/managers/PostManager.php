<?php
// Tous les Managers (dossier Model) hériteront de la classe Manager (dossier App) pour bénéficier des méthodes pré-établies : findAll, findOneById, ...

namespace Model\Managers;

use App\Manager;
use App\DAO;
use App\AbstractController;
use App\PostController;

class PostManager extends Manager
{

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";


    public function __construct()
    {

        parent::connect();
    }



    // sortir la suite de postes par topic
    public function findPostByTopic($id)
    {
        $sql = "SELECT *
            FROM " . $this->tableName . " p
            WHERE p.topic_id = :id";


        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::select($sql, ['id' => $id], TRUE),
            $this->className
        );
    }

    public function delPost($id)
    {
        $sql = "DELETE
                FROM " . $this->tableName . " p
                WHERE p.id_post = :id";


        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::delete($sql, ['id' => $id]),
            $this->className
        );
    }
}
