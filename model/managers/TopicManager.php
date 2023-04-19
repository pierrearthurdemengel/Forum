<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager {

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

    public function findAllTopics(array $order = null, int $id)
    {
        $orderQuery = ($order) ?
            "ORDER BY " . $order[0] . " " . $order[1] :
            "";

        $sql = "SELECT id_topic, topicName, creationDate, locked, t.user_id, COUNT(p.topic_id) AS nbPosts
            FROM " . $this->tableName . " t
            LEFT JOIN post p ON t.id_topic = p.topic_id
            WHERE t.category_id = :id
            GROUP BY t.id_topic "
            . $orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql, ["id" => $id]),
            $this->className
        );
    }


    public function delTopic($id)
    {
        $sql = "DELETE
                FROM " . $this->tableName . " p
                WHERE p.id_topic = :id";


        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::delete($sql, ['id' => $id]),
            $this->className
        );
    }


}
