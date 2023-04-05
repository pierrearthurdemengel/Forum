<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager
{

    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";


    public function __construct()
    {
        parent::connect();
    }

    public function findTopicByCategory($id)
    {
        $sql = "SELECT *
            FROM " . $this->tableName . " t
            WHERE t.category_id = :id";

        //  var_dump($sql);die;

        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::select($sql, ['id' => $id], TRUE),
            $this->className
        );
    }

    public function addPost($text)
    {
            $sql = "INSERT INTO " . $this->tableName . " (text)
            VALUES (:text)";

        //  var_dump($sql);die;

        $params = array(

            'text' => $text,

        );

        DAO::insert($sql, $params);

        // //Exemple d'insertion de données dans une table nommée 'ma_table'
        // $sql = "INSERT INTO post (text-input) VALUES (:text)";

        // //les valeurs à insérer
        // $valeurs = array(
        //     'text-input' => 'text'
        // );

        // //on exécute la requête
        // $resultat = Post::insert($sql, $valeurs);

        // //vérification du succès de l'opération
        // if ($resultat !== false) {
        //     echo "L'insertion a réussi, l'id de l'enregistrement ajouté est : " . $resultat;
        // } else {
        //     echo "L'insertion a échoué.";
        // }
    }
}
