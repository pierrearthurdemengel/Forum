<?php

namespace Controller;

use App\Session;
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
            $user_id = Session::getUser()->getId();

            if($text && $user_id && $user_id->getBan() == !1) {

                $postManager->add(["text" => $text, "topic_id" => $id, "user_id" => $user_id]);
                $this->redirectTo('topic', 'listPosts', $id);

            }
        }
    }

    public function delPost($id)
    {
        
        $postManager = new PostManager();
        
        if(isset($_POST['submit'])) {

            $id_post = filter_input(INPUT_POST, "delPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user_id = Session::getUser()->getId();
            
            if($id_post) {
                $postManager-> delPost($id_post);
                $this->redirectTo('topic', 'listPosts', $id);
            }
        }
    }


    public function delPostById($id)    //Boite suppression
    {
        $postManager = new PostManager();
        $post = $postManager->findOneByID($id); //recupère post par son id
        $id_topic = $post->getTopic()->getId(); //récupère l'id du topic par le id_topic dans post puis l'id du topic
                $postManager-> delPost($id);    
                $this->redirectTo('topic', 'listPosts', $id_topic);
    }
}