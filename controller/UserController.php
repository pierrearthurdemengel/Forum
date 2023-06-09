<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\PostManager;
use Model\Managers\TopicManager;
use Model\Managers\CategoryManager;


class UserController extends AbstractController implements ControllerInterface
{

    public function index()
    {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "categorys" => $categoryManager->findAll(["categoryName", "DESC"]),
                "topics" => $topicManager->findAll(["topicName", "DESC"])
            ]
        ];
    }

    public function detailUser($id)
    {

        $userManager = new UserManager();
        $postManager = new PostManager();

        return [
            "view" => VIEW_DIR . "forum/detailUser.php",
            "data" => [
                "user" => $userManager->findOneById($id),
                "messages" => $postManager->listPostsByUser($id)
            ]
        ];
    }

    public function modifyUser($id)
    {

        $userManager = new UserManager();

        return [
            "view" => VIEW_DIR . "forum/modifyUser.php",
            "data" => [
                "user" => $userManager->findOneById($id)
            ]
        ];
    }

    public function listUsers()
    {
        $userManager = new UserManager();
    
        return [
            "view" => VIEW_DIR . "forum/listUsers.php",
            "data" => [
                "users" => $userManager->findAll(["pseudo", "DESC"])
            ]
        ];
    }
    

    public function ban($id)
    {
        $userManager = new UserManager();
        $currentUser = Session::getUser();

        if ($currentUser->getRole() == 'ROLE_ADMIN') {
            
            $userManager->ban($id);
            
        }
        $this->redirectTo("user", "listUsers");
    }
}