<?php
// définit une classe ForumController qui étend AbstractController et implémente ControllerInterface. La classe a une seule méthode publique nommée index(). Cette méthode crée une instance de TopicManager, récupère tous les sujets enregistrés en base de données, puis renvoie un tableau contenant le chemin vers la vue listTopics.php et un tableau de données comprenant tous les sujets triés par date de création décroissante.
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;
use Model\Managers\UserManager;
use Model\Entities\Topic;
use Model\Entities\User;
use App\Manager;
use App\DAO;


class SecurityController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        $securityController = new SecurityController();
        return [
            "view" => VIEW_DIR . "forum/login.php",
            "data" => [
                "user" => $securityController->findAll(["pseudo", "DESC"])
            ]
        ];
    }



    // exemple format = index.php?ctrl=forum&action=listTopics Cette URL veut dire qu'on va appeler la méthode listTopics du ForumController

    // Si je veux appeler la méthode login du SecurityController, mon URL sera de la forme :    // index.php?ctrl=security&action=login
}
    // Les controllers se contentent de réceptionner la requête demandée par le client, interrogent le manager adéquat et envoient les informations à la vue