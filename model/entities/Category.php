<?php 

// Chaque Entity va hériter de la classe Entity (dans le dossier App) et 
// toutes les Entities auront exactement le même constructeur qui implémente la méthode "hydrate" (de cette même classe Entity)
final class Category extends Entity{
    private $id;
    private $categoryName;
    private $dateCreation;
    private $user;

    public function __construct($data){
        $this->hydrate($data);
    }

        /**
         * Get the value of id_category
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id_category
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

                /**
         * Get the value of categoryName
         */ 
        public function getCategoryName()
        {
                return $this->categoryName;
        }

        /**
         * Set the value of categoryName
         *
         * @return  self
         */ 
        public function setCategoryName($categoryName)
        {
                $this->categoryName = $categoryName;

                return $this;
        }

                        /**
         * Get the value of dateCreation
         */ 
        public function getDateCreation()
        {
                return $this->dateCreation;
        }

        /**
         * Set the value of dateCreation
         *
         * @return  self
         */ 
        public function setDateCreation($dateCreation)
        {
                $this->dateCreation = $dateCreation;

                return $this;
        }

                                        /**
         * Get the value of user_id
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user_id
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }
}
?>