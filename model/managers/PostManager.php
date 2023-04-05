<?php
// Tous les Managers (dossier Model) hériteront de la classe Manager (dossier App) pour bénéficier des méthodes pré-établies : findAll, findOneById, ...

namespace Model\Managers;

use App\Manager;
use App\DAO;
use App\AbstractController;

class PostManager extends Manager{

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";


    public function __construct(){
        parent::connect();
    }

    public function findPostsByTopic($id) {
        $sql="SELECT *
        FROM ".$this->tableName."
        WHERE topic_id = :id
        ORDER BY postDate DESC";

        return $this-> getMultipleResults(
            DAO::select($sql,['id'=>$id],true),
            $this->className
        );
    }

    
    public function findPostByTopic($id)
    {
        $sql = "SELECT *
            FROM ". $this->tableName." p
            WHERE p.topic_id = :id";

        //   var_dump($sql);die;

        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::select($sql, ['id' => $id], TRUE),
            $this->className
        );
    }


    public function addPost($id)
    {
        $PostManager = new PostManager();
        // //Exemple d'insertion de données dans une table nommée 'ma_table'
        {
            if (isset($_POST["submit"])) {
                 
                $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    
                if ($text) {
    
                    $PostManager = add(["text" => $text]);
                    
                    $this->redirectTo('forum', 'findPostsByTopic', $id);

                }
            }
        }
    }

}