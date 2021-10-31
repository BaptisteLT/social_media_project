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
        $posts = $this->postRepository->findAllPosts();
        var_dump($posts);die;
    }
}