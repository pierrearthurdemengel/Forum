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
        $user = new User();
        
        if (isset($_SESSION["user"])) {
            
            if (isset($_POST['submit'])) {
                
                $addTopic = filter_input(INPUT_POST, "addTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // $text = filter_input(INPUT_POST, "addPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user_id = Session::getUser()->getId();
                

                if ($addTopic && $user_id && $topicManager->getBan() == !1) {


                    $idLastTopic = $addTopic->add([
                        "topicName" => $addTopic, 
                        "category_id" => $id, 
                        "user_id" => $user_id
                    ]);

                    // $postManager->add([
                    //     "text" => $text, 
                    //     "topic_id" => $idLastTopic, 
                    //     "user_id" => $user]);

                    $this->redirectTo("topic", "listTopicsByCategory", $idLastTopic);
                }

                Session::addFlash("error", "Champ vide");
                $this->redirectTo("sujet", "listTopicsByCategory", $id);
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





    public function addPost($id)
    {

        $topicManager = new TopicManager();
        $userManager = new UserManager();


        if (isset($_POST['submit'])) {
            
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $user = Session::getUser()->getId();

            if ($text && $user && $userManager->getBan() == !1) {

                $topicManager->add(["topic_id" => $id, "user_id" => $user, "text" => $text]);

                $this->redirectTo('forum', 'listPosts', $id);
            }
        }
    }




    public function delAllPostAndTopic($id)    //Boite suppression
    {
        $postManager = new PostManager();
        $topicManager = new TopicManager();

        $topic = $topicManager->findOneById($id);
        $catId = $topic->getCategory()->getId();
        $posts = $postManager->findPostByTopic($id); //recupère tous les posts

        foreach ($posts as $post) {
            $postManager->delPost($post->getId());
        }
        $topicManager->delete($id);
        $this->redirectTo('topic', 'listTopicsByCategory', $catId);
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
