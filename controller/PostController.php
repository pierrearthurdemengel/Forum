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

        $data = [
            "view" => VIEW_DIR."forum/listPosts.php",
            "data" => [
                "topic" => $topicManager->findOneById($id),
                "posts" => $postManager->findPostByTopic($id),
            ]
        ];

        return $data;
    }
        
    public function addPost($id){
        $postManager = new PostManager();
        
        if(isset($_POST['submit'])) {
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($text) {
                $postManager->add(["text" => $text, "topic_id" => $id]);
                $this->redirectTo('forum', 'listPostByTopic', $id);
            }
        }   
    }
}
