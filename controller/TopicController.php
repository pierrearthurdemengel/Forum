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

    public function listTopicsByCategory($id)
    {
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findAllTopics(["creationDate", "DESC"], $id);
        

        return
            [
                "view" => VIEW_DIR . "forum/listTopics.php",
                "data" => 
                [
                    "topics" => $topics,
                    "category" => $category
                ]
            ];
        }

        public function addTopic($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            
            if(isset($_POST['submit'])) {
                
                $topicName = filter_input(INPUT_POST, "addTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user_id = 1;
                $text = filter_input(INPUT_POST, "addPost", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if($topicName) {
                    $idLastTopic = $topicManager->add(["topicName" => $topicName, "category_id" => $id, "user_id" => $user_id]);
                    
                    $postManager->add(["text" => $text, "topic_id" => $idLastTopic, "user_id" => $user_id]);
                    
                    $this->redirectTo("topic", "listTopicsByCategory", $id);
                }
            }
        }

        public function addPost($id){
            // $postManager = new PostManager();
    
            
            if(isset($_POST['submit'])) {
                $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $user_id = 1;
    
                if($text) {
                    // $postManager->add(["text" => $text, "topic_id" => $id]);
                    $this->redirectTo('forum', 'listPosts', $id);
                }
            }   
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

   


    // public function addTopic($id){ //à finir
    //     $PostManager = new PostManager();

    //     if(isset($_POST['submit'])) {
    //         $text = 
    //     }
    // }
    }

    
