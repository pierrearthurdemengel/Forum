<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;


class TopicController extends AbstractController implements ControllerInterface
{

    public function index()
    {


        $topicManager = new TopicManager();
        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findAll(["creationDate", "DESC"])
                // la méthode "findAll" est une méthode générique qui provient de l'AbstractController (dont hérite chaque controller de l'application)
            ]
        ];
    }

    public function infoTopic($id)
    {
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        return
            [
                "view" => VIEW_DIR . "forum/infoTopic.php", //choisis la vue
                "data" => [         //crée le(s) tableau(x) avec la data dont j'ai beosin dans 
                    "topic" => $topicManager->findOneById($id),
                    "posts" => $postManager->findPostByTopic($id)
                ]
            ];
    }

    public function listTopicByCategory($id)
    {
        $topicManager = new TopicManager();

        return
            [
                "view" => VIEW_DIR . "forum/listTopics.php",
                "data" => ["topics" => $topicManager->findTopicByCategory($id)]
            ];
    }

    public function addTopic($id){
        
    }
}
