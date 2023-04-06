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
                "data" => [         //crée le(s) tableau(x) avec la data dont j'ai beosin
                    "topic" => $topicManager->findOneById($id),
                    "posts" => $postManager->findPostByTopic($id)
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
                $topicName = filter_input(INPUT_POST, "topicName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($topicManager) {
                    $idLastTopic = $topicManager->add(["topicName" => $topicName, "category_id" => $id]);
                    $postManager->add(["topic_id" => $idLastTopic, "text" => $text]);
                    $this->redirectTo("topic", $idLastTopic);
                }
            }
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

    
