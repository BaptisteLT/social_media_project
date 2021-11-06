<?php

    use App\controller\IndexController;
    $indexController = new IndexController;
    $vars = $indexController->index();
    $posts=$vars['posts'];
?>

<!DOCTYPE html>
<html>
<head>
<?php include 'head.php' ?>
<link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- faire l'ajax -->
            <form id="new_post_form">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Contenu: </label>
                    <textarea name="contenu" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-4 ml-auto">Créer</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="justify-content-center">
            <div class="row">
                <div style="width:100%;">
                    <div class="d-flex flex-column align-items-end">
                        <button id="new_post" class="btn btn-primary mt-4 ml-auto">Créer un post</button>
                    </div>
                    <?php foreach($posts as $post) : ?>
                    <div class="col-12 ">
                        <div class="card mt-3 mb-3" style="width: 100%;">
                            <div class="card-body">
                                <p>Auteur: <?= $post->getCreatedBy()->getUsername() ?></p>
                                <p class="card-text">Message: <?= $post->getComment() ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

<script>

    document.getElementById('new_post_form').addEventListener("submit", function(e){
        e.preventDefault();
        //Faire l'ajax ici avec formdata
        var formData = new FormData(e.target);

        //LA

        modal.style.display = "none";

    });









    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("new_post");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
    modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
</script>

</html>