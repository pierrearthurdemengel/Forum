<?php

namespace Controller;

use App\Session;
use App\DAO;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

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

    public function addCategory()
    {

        $categoryManager = new CategoryManager();

        if (isset($_POST['submit'])) {

            $categoryName = filter_input(INPUT_POST, "addCategory", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $user = Session::getUser();

            // echo "test";die; ne recupère pas $categoryName
            if ($categoryName && $user && $user->getRole() == "ROLE_ADMIN") {

                $categoryManager->add(["categoryName" => $categoryName]);

                $this->redirectTo('category');
            }

            else{
                echo "Demandez à un admin pour ajouter une nouvelle catégorie";
            }
        }
    }

    public function delCategory()
    {

        $categoryManager = new CategoryManager();

        if (isset($_POST['submit'])) {

            $id_category = filter_input(INPUT_POST, "delCategory", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($id_category) {
                $categoryManager->delete(["id_category" => $id_category]);

                $this->redirectTo('category');
            }
        }
    }

    public function delAllTopicsByCategory($id)
    {
        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();

        $topics = $topicManager->findTopicByCategory($id);



        foreach ($topics as $topic) {

            $posts = $postManager->findPostByTopic($topic->getId());

            if ($posts) {

                foreach ($posts as $post) {
                    $postManager->delPost($post->getId());
                }
            }
            $topicManager->delTopic($topic->getId());
        }


        $categoryManager->delete($id);
        $this->redirectTo('category', 'listCategory');
    }
}
