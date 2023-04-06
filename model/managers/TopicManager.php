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

    public function listTopics()
    {
        parent::connect();

        $sql = " SELECT *,
        (SELECT MAX(p.datePost) FROM post p 
        WHERE t.id_topic = p.topic_id) AS dernierMessage,
        (SELECT COUNT(*) FROM post p 
        WHERE t.id_topic = p.topic_id) AS nombreMessage
        FROM " . $this->tableName . " t
        ORDER BY t.creationDate
    ";

        return $this->getMultipleResults(
            DAO::select($sql, null, true),
            $this->className
        );
    }

    public function listTopicsByCategory($id){
        parent::connect();

        $sql = "SELECT *,
        (SELECT MAX(p.datePost) 
          FROM post p 
          WHERE t.id_topic = p.topic_id) AS dernierMessage,
        (SELECT COUNT(*) 
          FROM post p 
          WHERE t.id_topic = p.topic_id) AS nombreMessage
        FROM ".$this->tableName." t
        WHERE t.category_id = :id
        ORDER BY t.creationDate
    ";

    return $this->getMultipleResults(
        DAO::select($sql, ['id' => $id], true),
        $this->className
    );
    }

    public function findTopicByCategory($id)
    {
        $sql = "SELECT *
            FROM " . $this->tableName . "
            WHERE category_id = :id
            ORDER BY creationDate DESC";

        //  var_dump($sql);die;

        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::select($sql, ['id' => $id], TRUE),
            $this->className
        );
    }
}
