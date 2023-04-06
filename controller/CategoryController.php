<?php

namespace Controller;

use App\Session;
use App\DAO;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;

class CategoryController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listCategorys.php",
            "data" => [
                "categorys" => $categoryManager->findAll(["categoryName", "DESC"])
            ]
        ];
    }

    public function listTopicsByCategory($id)
    {
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findAllTopics(["creationDate", "DESC"], $id);

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" =>
            [
                "topics" => $topics,
                "category" => $category
            ]
        ];
    }

    public function addCategory(){
        
        $categoryManager = new CategoryManager();

        if(isset($_POST['submit'])){
            $categoryName = filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($categoryName){
                $categoryManager->add(["categoryName" => $categoryName]);

                $this->redirectTo('category');
            }
        }
    }




    // public function addCategory()
    // {

    //     $CategoryManager = new CategoryManager();

    //     if (isset($_POST['submit'])) {

    //         $categoryName =  filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //         if ($categoryName) {

    //             $CategoryManager->add(["categoryName" => $categoryName]);

    //             $this->redirectTo('category');
    //         }
        // }
    // }
}
