<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $topicName;
        private $creationDate;
        private $closed;
        private $user;
        private $category;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
         /**
         * Get the value of id_topic
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id_topic
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTopicName()
        {
                return $this->topicName;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTopicName($topicName)
        {
                $this->topicName = $topicName;

                return $this;
        }


        /**
         * Get and set the value of creationdate
         */ 
        public function getCreationDate(){
            $formattedDate = $this->creationDate->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setCreationDate($date){
            $this->creationDate = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of closed
         */ 
        public function getClosed()
        {
                return $this->closed;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        public function setClosed($closed)
        {
                $this->closed = $closed;

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

                /**
         * Get the value of category_id
         */ 
        public function getCategory()
        {
                return $this->category;
        }

        /**
         * Set the value of category_id
         *
         * @return  self
         */ 
        public function setCategory($category)
        {
                $this->category = $category;

                return $this;
        }
    }
