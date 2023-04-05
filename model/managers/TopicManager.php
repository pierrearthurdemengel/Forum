<?php

namespace Model\Managers;
use App\AbstractController;
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
        $sql="SELECT *
            FROM ".$this->tableName."
            WHERE category_id = :id
            ORDER BY creationDate DESC";

        //  var_dump($sql);die;

        return $this->getMultipleResults(
            // ou getOneOrNullResult si un seul objet
            DAO::select($sql, ['id' => $id], TRUE),
            $this->className
        );
    }

    public function addTopic($id)
    {
        $TopicManager = new TopicManager();
        $PostManager = new PostManager();

            if(isset($_POST['submit'])){
                $topicName = filter_input(INPUT_POST, "topicName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($topicName){
                $newTopic = $ $TopicManager->add(["topicName" => $topicName]);
                $PostManager->add(["text"]);
                $this->redirecTo("forum", 'postSelectbyTopic', $newTopic);
            }

            }
    }
}
