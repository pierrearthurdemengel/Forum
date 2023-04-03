<?php
    namespace App;

    abstract class AbstractController{

        public function index(){}
        
        public function redirectTo($ctrl = null, $action = null, $id = null){

            if($ctrl != "home"){
                $url = $ctrl ? "?ctrl=". $ctrl : "";
                $url.= $action ? "&action=".$action : "";
                $url.= $id ? "&id=".$id : "";
                $url.= ".html";
            }
            // si vous souhaitez faire une redirection vers : index.php?ctrl=forum&action=listCategories
            // Il vous suffira de faire : $this->redirectTo("forum", "listCategories");
            // ou
            // index.php?ctrl=forum&action=listTopics&id=1
            // $this->redirectTo("forum","listTopics", $id);
$this->redirectTo("forum", "listCategories");
            else $url = "/";
            header("Location: $url");
            die();

        }

        public function restrictTo($role){
            
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                $this->redirectTo("security", "login");
            }
            return;
        }

    }