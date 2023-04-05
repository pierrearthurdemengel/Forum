<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;

class CategoryController extends AbstractController implements ControllerInterface
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

    
    public function listPostByTopic($id)
    {
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        return 
            [
                "view" => VIEW_DIR."forum/listPosts.php",
                "data" => 
                [
                    "topic" => $topicManager->findOneById($id),
                    "posts" => $postManager->listPostByTopic($id),
                ]
            ];
    }
    else 
    {
        return 
        [
            "view" => VIEW_DIR."forum/listTopics.php",
            "data" => 
            [
                "topics" => $topicManager->findAll(["topicName", "DESC"]),
                "posts" => $postManager->findAll(["text", "DESC"]),
            ]
        ];
    }

        
    public function addPost($id){
        $PostManager = new PostManager();
        
            if(isset($_POST['submit'])) {
                $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($text) {
                    $PostManager->add(["text" => $text]);
                    $this->redirectTo('forum', 'postByTopic', $id);
                }
            }
        
    }
        
}