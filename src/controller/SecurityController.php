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
            $hash = $this->userRepository->getUserPassword();
            $verifiedPassword = password_verify($_POST['password'], $hash);

            if($verifiedPassword===true)
            {
                $session['username'] = $_POST['username'];
                header("Location: http://$_SERVER[HTTP_HOST]/");
                exit;
            }
        }
        
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