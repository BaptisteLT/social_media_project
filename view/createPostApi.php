<?php
    use App\controller\PostController;
    $postController = new PostController;
    $postController->createPostApi($_GET['csrf']);
?>
