<?php
namespace App\Entity;

class User{
    private $username;
    private $password;

    public function __contruct($username,$password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return bool
     */
    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }
}
