<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;

class CategoryController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listCategorys.php",
            "data" => [
                "categorys" => $categoryManager->findAll(["categoryName", "DESC"])
                // la méthode "findAll" est une méthode générique qui provient de l'AbstractController (dont hérite chaque controller de l'application)
            ]
        ];
    }


    public function addCategory()
    {

        $CategoryManager = new CategoryManager();

        if (isset($_POST['submit'])) {

            $categoryName =  filter_input(INPUT_POST, "categoryName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($categoryName) {

                $CategoryManager->add(["categoryName" => $categoryName]);

                $this->redirectTo('category');
            }
        }
    }
}
