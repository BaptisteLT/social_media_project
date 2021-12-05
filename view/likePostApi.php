<?php
    use App\controller\PostController;
    $postController = new PostController;
    $postController->likePostApi($_GET['csrf']);
?>
