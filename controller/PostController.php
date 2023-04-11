<?php

namespace Controller;

use App\Session;
use App\DAO;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;

class PostController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topic" => $topicManager->findAll(["creationDate", "DESC"]),
                // la méthode "findAll" est une méthode générique qui provient de l'AbstractController (dont hérite chaque controller de l'application)
            ]
        ];
    }

    
    public function listPostByTopic($id)
    {
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        $data = [
            "view" => VIEW_DIR."forum/listPosts.php",
            "data" => [
                "topic" => $topicManager->findOneById($id),
                "post" => $postManager->findPostByTopic($id),
            ]
        ];

        return $data;
    }
        
    public function addPost($id)
    {
        $postManager = new PostManager();
        
        if(isset($_POST['submit'])) {
            
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user_id = 1;
            if($text) {
                $postManager->add(["text" => $text, "topic_id" => $id, "user_id" => $user_id]);
                $this->redirectTo('topic', 'listPosts', $id);
            }
        }
    }
}