<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Entities\Topic;
    use Model\Entities\User;
    use Model\Forum\infoTopic;
    
    class TopicController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])
                    // la méthode "findAll" est une méthode générique qui provient de l'AbstractController (dont hérite chaque controller de l'application)
                ]
            ];
        }

        public function infoTopic($id){
            $topicManager = new TopicManager();
            return [
                "view" => VIEW_DIR."forum/infoTopic.php",
                "data" => [
                    "topic" => $topicManager->findOneById($id)
                ]
            ];
        }

        public function listTopicByCategory($id){
            $topicManager = new TopicManager();
            
            return 
            [
             "view" => VIEW_DIR . "forum/listTopics.php",
             "data" => ["topics" => $topicManager->findTopicByCategory($id)]   
            ];
          }
        
          public function listPostByTopic($id){
            $topicManager = new PostManager();
            
            return 
            [
             "view" => VIEW_DIR . "forum/listPosts.php",
             "data" => ["post" => $topicManager->findTopicByCategory($id)]   
            ];
          }
        


        

    }