<?php
    use App\controller\PostController;
    $postController = new PostController;
    $postController->deletePost(intval($_GET['id']),$_GET['csrf']);
?>
