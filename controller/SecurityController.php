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

        return [
            "view" => VIEW_DIR . "security/login.php",
        ];
    }



    // Inscription
    public function register()
    {

        $userManager = new UserManager();

        if (isset($_POST['submitRegister'])) {

            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password1 = filter_input(INPUT_POST, "password1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $error = null;

            // Si les filtres passent
            // if ($pseudo && $email && $password1 && $password2 && $password1 == $password2) {
            // var_dump("ok");die;
            // ajouter les infos utilisateur dans bdd

            //     $userManager->add(["pseudo" => $pseudo, "email" => $email, "password" => password_hash($password1, PASSWORD_DEFAULT)]);
            //     $this->redirectTo('security', 'register');
            // }

            // on verifie le mail
            if ($email) {
                if ($userManager->checkUserByEmail($email)) {
                    $error = "Le mail est déjà utilisé";
                }
            }

            // verification pseudo
            if ($pseudo) {
                if ($userManager->checkPseudo($pseudo)) {
                    if ($error) {
                        $error .= "<br>Pseudo déjà prit";
                    } else {
                        $error = "Le pseudo existe déjà";
                    }
                }
            }

            // comparation des passwords
            if (isset($password1) && isset($password2)) {
                if ($password1 == null || $password1 == '' || $password2 == null || $password2 == '') {
                    $password = null;
                    if ($error) {
                        $error .= "<br>Les mots de passes ne correspondent pas";
                    } else {
                        $error = "Les mots de passes ne correspondent pas";
                    }
                } else if ($password1 == $password2) {
                    // si ils sont identique on crée le mdp hasher
                    $password = password_hash($password1, PASSWORD_DEFAULT);
                } else {
                    $password = null;

                    if ($error) {
                        $error .= "<br>Les mots de passes ne correspondent pas";
                    } else {
                        $error = "Les mots de passes ne correspondent pas";
                    }
                }
            }

            if ($error) {
                Session::addFlash("error", $error);
                $this->redirectTo("security", "register");
            } else if ($pseudo && $email && $password) {
                // on créer le nouvel utilisateur et on récupère son ID
                $newUser = $userManager->add(["pseudo" => $pseudo, "email" => $email, "password" => $password]);

                $this->redirectTo("user", "detailUser", $newUser);
            }
        } else {
            return [
                "view" => VIEW_DIR . "security/register.php",
            ];
        }
    }

    // Connection

    public function login()
    {

        $userManager = new UserManager();

        if (isset($_POST['submitLogin'])) {

            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // if(Session::getTokenCSRF() != $_POST['csrfToken']) {
            //     $this->logout();
            // }

            $error = null;

            // Si les filtres passent
            if ($email && $password) {
                // retrouver le mdp de l'utilisateur par son mail
                $dbPass = $userManager->findOneByEmail($email);
                // si le mdp correspond
                if ($dbPass) {
                    // récupération du mdp
                    $hash = $dbPass->getPassword();
                    if (password_verify($password, $hash)) {
                        // retrouver l'utilisateur par son mail
                        $user = $userManager->findOneByEmail($email);
                        // comparaison du hash de la bdd et le mdp renseigné
                        if (password_verify($password, $hash)) {
                            // si l'utilisateur n'est pas banni
                            if ($user->getStatus()) {
                                // Mise de l'utilisateur en session
                                Session::setUser($user);
                                $this->redirectTo("user", "detailUser", $user->getId());
                                // initialisation d'un token pour toute la session user
                                $log = "Connection réussie !";
                                return [
                                    "view" => VIEW_DIR . "view/listCategorys.php",
                                    "data" => []
                                ];
                            }
                        }
                    }
                }
            }
        }


        return [
            "view" => VIEW_DIR . "security/login.php",
            "data" => []
        ];
    }

    public function logout()
    {
        session_destroy();
        $this->redirectTo("topic", "index");
    }


    // exemple format = index.php?ctrl=forum&action=listTopics Cette URL veut dire qu'on va appeler la méthode listTopics du ForumController

    // Si je veux appeler la méthode login du SecurityController, mon URL sera de la forme :    // index.php?ctrl=security&action=login
}
    // Les controllers se contentent de réceptionner la requête demandée par le client, interrogent le manager adéquat et envoient les informations à la vue
