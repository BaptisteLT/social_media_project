<?php
namespace App\controller;

use App\model\UserRepository;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Generator\UrlGenerator;

class SecurityController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function login()
    {
        if(isset($_POST['username']) && isset($_POST['password'])
        && $_POST['username'] !='' && $_POST['password'] != '')
        {   
            //Retourne true si le mot de passe est vérifié, sinon false
            $passwordVerified = $this->userRepository->getUser($_POST['username']);
            if($this->userRepository->getUser($_POST['username'])[0] != null)
            {
                $passwordVerified = $passwordVerified[0]->verifyPassword($_POST['password']);
            }
            else
            {
                $errorMessage = 'Mauvais identifiant ou mot de passe';
                return ['error_message'=>$errorMessage];
            }
            
            //Si le mot de passe est vérifié alors on lui crée sa session
            if($passwordVerified===true)
            {
                $iduser=$this->userRepository->getUser($_POST['username'])[0]->getId();
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['iduser'] = $iduser;
                //Puis on le redirige à l'accueil
                header("Location: http://$_SERVER[HTTP_HOST]/");
                exit;
            }
        }
        
    }

    public function logout()
    {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
        session_destroy();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function register()
    {
        if(isset($_POST['password_confirm']) && isset($_POST['password']) && isset($_POST['username']) &&($_POST['password'] === $_POST['password_confirm']))
        {
            if(strlen($_POST['password']) >= 7)
            {
                if($this->userRepository->verifyUserExists($_POST['username']) === false)
                {
                    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
                    $this->userRepository->createUser($hashedPassword,$_POST['username']);
                    
                    header("Location: http://$_SERVER[HTTP_HOST]/login");
                    exit;
                }
                else
                {
                    $errorMessage = 'User already exists';
                    return ['error_message'=>$errorMessage];
                }

            }
            else
            {
                $errorMessage = 'Password should be longer or equal to 7 characters.';
                return ['error_message'=>$errorMessage];
            }
        }
        else
        {
            $errorMessage = 'Username or password empty, or passwords don\'t match.';
            return ['error_message'=>$errorMessage];
        }

    }
}