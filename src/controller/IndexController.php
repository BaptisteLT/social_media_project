<?php
namespace App\controller;

use App\Model\PostRepository;


class IndexController
{

    private $postRepository;

    public function __construct()
    {
        $this->postRepository = new PostRepository;
    }

    public function index()
    {
        //On crée un csrf token pour éviter les supressions de posts non désirées.
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        
        $posts = $this->postRepository->findAllPosts();

        return [
            'posts'=>$posts,
            'nbPosts' =>count($posts) 
        ];
    }
}