<?php
namespace App\controller;

use Exception;
use App\Model\PostRepository;


class PostController
{

    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository;
    }

    public function createPostApi()
    {

        try{

            if(isset($_POST['contenu']) && $_POST['contenu'] != '')
            {
                //Faire la méthode pour créer le post (mais faire session login et register avant)
                $this->postRepository->createNewPost($_SESSION['userid'],$_POST['contenu']);

                //Ajouter le post dynamiquement évidemment
                return [
                    'contenu'=>$_POST['contenu']
                ];
            }
        }
        catch (Exception $e)
        {
            throw new Exception($e);
        }

    }
}