<?php 
    namespace Model\Entities;

    use App\Entity;

final class Post extends Entity{
    private $id;
    private $text;
    private $datePost;
    private $user;
    private $topic;

    public function __construct($data){
        $this->hydrate($data);
    }

        /**
         * Get the value of id_user
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id_user
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }



                        /**
         * Get the value of text
         */ 
        public function getText()
        {
                return $this->text;
        }

        /**
         * Set the value of text
         *
         * @return  self
         */ 
        public function setText($text)
        {
                $this->text = $text;

                return $this;
        }

                                /**
         * Get the value of datePost
         */ 
        public function getDatePost()
        {
                return $this->datePost;
        }

        /**
         * Set the value of datePost
         *
         * @return  self
         */ 
        public function setDatePost($datePost)
        {
                $this->datePost = $datePost;

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
         * Get the value of topic_id
         */ 
        public function getTopic()
        {
                return $this->topic;
        }

        /**
         * Set the value of topic_id
         *
         * @return  self
         */ 
        public function setTopic($topic)
        {
                $this->topic = $topic;

                return $this;
        }
}
?>