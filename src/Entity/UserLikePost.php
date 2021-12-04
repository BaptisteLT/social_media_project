<?php
namespace App\Entity;

class UserLikePost{
    private $idUser;
    private $idPost;
    private $id;

    const TABLE_NAME = 'userlikepost';

    public function __contruct($idUser,$idPost)
    {
        $this->idUser = $idUser;
        $this->idPost = $idPost;
    }
    

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of idPost
     */ 
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * Set the value of idPost
     *
     * @return  self
     */ 
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

}
