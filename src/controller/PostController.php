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

    public function createPostApi($csrfToken)
    {
        /* PROTECTION CSRF */
        if (!$csrfToken || $csrfToken !== $_SESSION['token']) {
            echo json_encode('Suppression probablement non désirée car le token CSRF n\'existe pas ou ne correspond pas, vous pouvez avoir cliqué sur un lien malveillant');
        }

        if(isset($_POST['contenu']) && $_POST['contenu'] != '' && isset($_SESSION['iduser']))
        {
            //Faire la méthode pour créer le post (mais faire session login et register avant)
            $this->postRepository->createNewPost($_SESSION['iduser'],$_POST['contenu']);
            //Ajouter le post dynamiquement évidemment
            echo json_encode(['id'=>$this->postRepository->getLastInsertedId(),'contenu'=>htmlspecialchars($_POST['contenu']),'username'=>$_SESSION['username']]);
        }
        else
        {
            echo json_encode(['erreur'=>'Contenu vide ou vous n\'êtes pas connecté']);
        }
    }

    
    public function deletePost($id, $csrfToken)
    {
        
        /* PROTECTION CSRF */
        if (!$csrfToken || $csrfToken !== $_SESSION['token']) {
            die('Suppression probablement non désirée car le token CSRF n\'existe pas ou ne correspond pas, vous pouvez avoir cliqué sur un lien malveillant');
        }

        $post = $this->postRepository->getSinglePost($id);
        if(isset($post) && $post->getCreatedBy() == $_SESSION['iduser'])
        {
            $this->postRepository->deletePost($id);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
        else
        {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

    }

    public function likePostApi($csrfToken)
    {
        /* PROTECTION CSRF */
        if (!$csrfToken || $csrfToken !== $_SESSION['token']) {
            echo json_encode('Suppression probablement non désirée car le token CSRF n\'existe pas ou ne correspond pas, vous pouvez avoir cliqué sur un lien malveillant');
        }

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

            $post = $this->postRepository->getSinglePost($id_post);

            echo json_encode(['nbLikes'=>$post->getNbLikes(),'id'=>$post->getId()]);
        }
        else
        {
            echo json_encode(['erreur'=>'Vous n\'êtes pas connecté ou problème dans la requête.']);
        }
    }
}