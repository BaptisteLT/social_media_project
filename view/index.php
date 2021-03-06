<?php

    use App\controller\IndexController;
    $indexController = new IndexController;
    $vars = $indexController->index();
    $posts=$vars['posts'];
    $nbPosts = $vars['nbPosts'];
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
                <?php if(isset($_SESSION['iduser'])):?>
                    <div class="d-flex flex-column align-items-end">
                        <button id="new_post" class="btn btn-primary mt-4 ml-auto">Créer un post</button>
                    </div>
                <?php endif ?>
                <p>Nos <?= $nbPosts ?> post<?= $nbPosts >= 1 ? 's' : '' ?> les plus récents</p>
                <div id="card-container" style="width:100%;">
                    <?php foreach($posts as $post) : ?>
                        <div class="col-12" id="<?=$post->getId()?>">
                            <div class="card mt-3 mb-3" style="width: 100%;">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-end">
                                        <?php if(isset($_SESSION['iduser']) && $_SESSION['iduser'] == $post->getCreatedBy()->getId()):?>
                                            <a href="<?= $urlGenerator->generate('deletePost')?>?id=<?=$post->getId()?>&csrf=<?= $_SESSION['token'] ?>" class="btn ml-auto" id="delete-<?= $post->getId()?>">❌</a>
                                        <?php endif ?>
                                    </div>
                                    <p>Auteur: <?= $post->getCreatedBy()->getUsername() ?></p>
                                    <p class="card-text">Message: <?= $post->getComment() ?></p>
                                    <?php if(isset($_SESSION['iduser'])):?>
                                        <button class="btn btn-success" id="like-<?= $post->getId()?>">J'aime <?=$post->getNbLikes()?></button>
                                    <?php endif ?>
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

    $(document).on('click', '.btn-success', function(e) {

        let id_post = e.target.id.slice(5);
        var formData = new FormData(); // Formulaire vide à cet instant
        formData.append('id_post',id_post);
        console.log(formData);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?= $urlGenerator->generate('likePostApi')?>?csrf=<?= $_SESSION['token']?>",
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                data = JSON.parse(data);
                //Si erreur
                if(typeof data['erreur'] !== 'undefined') {
                    alert(data['erreur']);
                }
                //Autrement ok on modifie le DOM
                else
                {
                    $("#output").text(data);
                    console.log("SUCCESS : ", data);
                    
                    //On met à jour le nombre de likes
                    button = document.getElementById('like-'+data['id']);
                    button.innerHTML = "J'aime " + data['nbLikes'];

                }
            },
            error: function (e) {
                console.log("ERROR : ", e);
            }
        });
    });













    /*Lors d'un nouveau post on appelle cet ajax*/
    document.getElementById('new_post_form').addEventListener("submit", function(e){
        e.preventDefault();
        //On désactive le bouton pour éviter les doubles clics
        $("#btnSubmit").prop("disabled", true);
        //Faire l'ajax ici avec formdata
        var formData = new FormData(e.target);

        modal.style.display = "none";

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "<?= $urlGenerator->generate('createPostApi')?>?csrf=<?= $_SESSION['token']?>",
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                data = JSON.parse(data);
                //Si erreur
                if(typeof data['erreur'] !== 'undefined') {
                    alert(data['erreur']);
                }
                //Autrement on modifie le DOM
                else
                {
                    $("#output").text(data);
                    console.log("SUCCESS : ", data);
                    /*On réactive le bouton*/
                    $("#btnSubmit").prop("disabled", false);

                    /*On crée la div principale*/
                    mainDiv = document.createElement('div');
                    mainDiv.classList.add('col-12');

                    /*On crée la carte*/
                    card = document.createElement('div');
                    card.classList.add('card', 'mt-3', 'mb-3');
                    card.style.width = '100%';

                    /*On crée la div du contenu de la carte*/
                    cardBody = document.createElement('div');
                    cardBody.classList.add('card-body');




                    divCroix = document.createElement('div');
                    divCroix.classList.add('d-flex','flex-column','align-items-end');
                    /*On ajoute la croix de suppression*/
                    croix = document.createElement('a');
                    croix.setAttribute("href", "<?= $urlGenerator->generate('deletePost')?>?id="+data['id']+"&csrf=<?= $_SESSION['token'] ?>");
                    croix.classList.add('btn','ml-auto');
                    croix.id='delete-'+data['id'];
                    croix.innerHTML = '❌';

                    divCroix.append(croix);

                    
                    /*On ajoute l'auteur*/
                    auteur = document.createElement('p');
                    auteur.innerHTML='Auteur: '+data['username'];

                    /*On ajoute le message*/
                    message = document.createElement('p');
                    message.innerHTML='Message: '+data['contenu'];
                    message.classList.add('card-text');

                    btn = document.createElement("BUTTON");
                    btn.innerHTML = "J'aime 0";
                    btn.classList.add('btn','btn-success');
                    btn.id = "like-"+data['id'];

                    //On met la croix, l'auteur, le message et le bouton au contenu de la card
                    cardBody.append(divCroix);
                    cardBody.append(auteur);
                    cardBody.append(message);
                    cardBody.append(btn);

                    //On ajoute le contenu de la carte à la carte
                    card.append(cardBody);
                    mainDiv.append(card);

                    /*On append au début de la div principale*/
                    document.getElementById('card-container').prepend(mainDiv);
                }
            },
            error: function (e) {
                $("#output").text(e.responseText);
                console.log("ERROR : ", e);
                $("#btnSubmit").prop("disabled", false);
            }
        });

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