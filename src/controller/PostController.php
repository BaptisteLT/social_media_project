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


        if(isset($_POST['contenu']) && $_POST['contenu'] != '' && isset($_SESSION['iduser']))
        {
            //Faire la méthode pour créer le post (mais faire session login et register avant)
            $this->postRepository->createNewPost($_SESSION['iduser'],$_POST['contenu']);
            //Ajouter le post dynamiquement évidemment
            echo json_encode(['contenu'=>$_POST['contenu'],'username'=>$_SESSION['username']]);
        }
        else
        {
            echo json_encode(['erreur'=>'Contenu vide ou vous n\'êtes pas connecté']);
        }
    }

    public function likePostApi()
    {


        if(isset($_POST['id_post']) && $_POST['id_post'] != '' && isset($_SESSION['iduser']))
        {
            $id_post = intval($_POST['id_post']);
            $hasLikedTrueFalse=$this->postRepository->hasUserLikedPost($_SESSION['iduser'],$id_post);

            //Faire ci-dessous

            //On ajoute un like
            if($hasLikedTrueFalse == null)
            {
                $this->postRepository->likePost($_SESSION['iduser'],$id_post);
            }
            //On supprime le like
            else
            {
                $this->postRepository->deleteLikePost($_SESSION['iduser'],$id_post);
            }

            $newNbLikes = $this->postRepository->getNbLikesPost($_SESSION['iduser'],$id_post);

            echo json_encode(['nbLikes'=>$newNbLikes]);
        }
        else
        {
            echo json_encode(['erreur'=>'Vous n\'êtes pas connecté']);
        }
    }
}