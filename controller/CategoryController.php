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
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listCategorys.php",
            "data" => [
                "categorys" => $categoryManager->findAll(["CategoryName", "DESC"])
                // la méthode "findAll" est une méthode générique qui provient de l'AbstractController (dont hérite chaque controller de l'application)
            ]
        ];
    }

    public function listCategorys()
    {
        $categoryManager = new CategoryManager();
        return
            [
                "view" => VIEW_DIR . "forum/listCategorys.php",
                "data" => [
                    "category" => $categoryManager->findAll()
                ]
            ];
    }

    
    public function listTopicByCategory($id) //à faire
    {
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        return 
            [
                "view" => VIEW_DIR."forum/listPosts.php",
                "data" => [
                    "topic" => $topicManager->findOneById(),
                    "posts" => $postManager->listPostByTopic()
                    //Call to unknown method: Model\Managers\PostManager::listPostByTopic()
                ]
                ];
    }


    public function addCategory(){

        $CategoryManager = new CategoryManager();

        if (isset($_POST['submit'])) {

            $CategoryManager =  filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($categoryName) {

                $newCategory = $CategoryManager->add(["categoryName" => $categoryName]);
                $this->redirectTo('forum', 'listCategory', $newCategory);
        }
    }

    }
}