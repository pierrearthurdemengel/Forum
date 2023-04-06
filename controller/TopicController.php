<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;


class TopicController extends AbstractController implements ControllerInterface
{

    public function index()
    {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "category" => $categoryManager->findAll(["categoryName", "DESC"]),
                "topics" => $topicManager->listTopics()
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

    public function listTopicsByCategory($id)
    {
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        if(isset($_POST['categorys'])) 
        {
            $categorySelected = filter_input(INPUT_POST, 'categorys', FILTER_SANITIZE_NUMBER_INT);
        

        return
            [
                "view" => VIEW_DIR . "forum/listTopics.php",
                "data" => 
                [
                    "categorys" => $categoryManager->findAll(["categoryName", "DESC"]),
                    "topics" => $topicManager->listTopicsByCategory($categorySelected),
                    "categorySelected" => $categorySelected
                ]
            ];
        }
        else {
                $categorySelected = null;
            }
         
            
        if($id) {
            return [
                "view" => VIEW_DIR. "forum/listTopics.php",
                "data" => 
                [
                    "categorys" => $categoryManager->findAll(["categoryName", "DESC"]),
                    "topics" => $topicManager->listTopicsByCategory($id)
                ]
                ];
            }

        else {
            $this->rediretTo("topic");
        }
    


    // public function addTopic($id){ //à finir
    //     $PostManager = new PostManager();

    //     if(isset($_POST['submit'])) {
    //         $text = 
    //     }
    // }
    }

    
}