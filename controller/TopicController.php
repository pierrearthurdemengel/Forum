<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;
use Model\Managers\UserManager;
use model\Entities\User;

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





    public function TopicsByCategory($id)
    {
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findAllTopics(["creationDate", "DESC"], $id);

        if (isset($_POST['category'])) {

            $categorySelected = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);

            return
                [
                    "view" => VIEW_DIR . "forum/listTopics.php",
                    "data" =>
                    [
                        "topics" => $topics,
                        "category" => $category,
                        "categorySelected" => $categorySelected
                    ]
                ];
        } else {
            $categorySelected = null;
        }

        // liste des sujets par catégories (via "la liste des catégories")
        if ($id) {
            return [
                "view" => VIEW_DIR . "forum/listTopics.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["topicName", "DESC"]),
                    "sujets" => $topicManager->listTopicsByCategory($id)
                ]
            ];

            // vue par defaut sans id spécifier
        } else {
            $this->redirectTo("topic");
        }
    }
    
    
    
    
    public function topicsThread($id){
        // Manager
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        if($id) {
            return [
                "view" => VIEW_DIR."forum/listPosts.php",
                "data" => [
                    "posts" => $postManager->findPostByTopic($id),
                    "topic" => $topicManager->findOneById($id)
                ]
            ];
        } 
    }
    
    
    
    
    public function addTopic($id)
    {
        $topicManager = new TopicManager();
        $postManager = new PostManager();
    
        if (isset($_SESSION["user"])) {

            $user_id = Session::getUser()->getId();

            if (isset($_POST['submit'])) {

                $addTopic = filter_input(INPUT_POST, "addTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $addPost = filter_input(INPUT_POST, "addPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user = Session::getUser();
    
                if ($addTopic && $addPost && $user->getBan() ==! 1) {
                    $idLastTopic = $topicManager->add([
                        "topicName" => $addTopic, 
                        "category_id" => $id, 
                        "user_id" => $user_id
                    ]);
                    $postManager->add([
                        "topic_id" => $idLastTopic, 
                        "text" => $addPost, 
                        "user_id" => $user_id
                    ]);
                    $this->redirectTo("topic", "listTopicsByCategory", $idLastTopic);
                } else {
                    Session::addFlash("error", "Tous les champs doivent être remplis et vous ne pouvez pas poster de message si vous êtes banni.");
                    $this->redirectTo("sujet", "listTopicsByCategory", $id);
                }
            }
        } else {
            Session::addFlash("error", "Vous devez être connecté pour poster un sujet.");
            $this->redirectTo("sujet", "listTopicsByCategory", $id);
        }
    }



    public function addPost($id)
    {

        $topicManager = new TopicManager();
        // $user = Session::getUser();

        if (isset($_POST['submit'])) {
            
            $text = filter_input(INPUT_POST, "addPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $user_id = Session::getUser()->getId();

            if ($text && $user_id && $user_id->getBan() == !1) {

                $topicManager->add(["topic_id" => $id, "user_id" => $user_id, "text" => $text]);

                $this->redirectTo('forum', 'listPosts', $id);
            }
        }
    }

    public function listPosts($id)
    {
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        return
            [
                "view" => VIEW_DIR . "forum/listPosts.php", //choisis la vue
                "data" => [         //crée le(s) tableau(x) avec la data dont j'ai beosin
                    "topic" => $topicManager->findOneById($id),
                    "post" => $postManager->findPostByTopic($id)
                ]
            ];
    }









    public function delAllPostAndTopic($id)    //Boite suppression
    {
        $postManager = new PostManager();
        $topicManager = new TopicManager();

        $topic = $topicManager->findOneById($id);
        $catId = $topic->getCategory()->getId();
        $posts = $postManager->findPostByTopic($id); //recupère tous les posts du Topic

        foreach ($posts as $post) {
            $postManager->delPost($post->getId());
        }
        $topicManager->delete($id);
        $this->redirectTo('topic', 'listTopicsByCategory', $catId);
    }








    public function delTopic($id){
        // Manager
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        // user
        $topic = $topicManager->findOneById($id);
        $user = Session::getUser();

        //on vérifie si l'user a les droits admin/modérateur OU si il est l'auteur du topic
        if (($user->getRole() == "ROLE_ADMIN" || $user->getRole() == "modo" || $user->getId() === $topic->getUserr()->getId()) && $user->getBan() == !1) {
            // on supprime les messages du topic PUIS le topic
            $postManager->delAllPostByTopic($id);
            $topicManager->delTopic($id);
        } 

        $this->redirectTo('topic','topicsByCategory');
    }

    // if($id) {
    //     return [
    //         "view" => VIEW_DIR. "forum/listTopics.php",
    //         "data" => 
    //         [
    //             "categorys" => $categoryManager->findAll(["categoryName", "DESC"]),
    //             "topics" => $topicManager->listTopicsByCategory($id)
    //         ]
    //         ];
    //     }


}
