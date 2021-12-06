<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Social media</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?= $urlGenerator->generate('index')?>">Home</a>
            </li>
            <?php if(!isset($_SESSION['iduser'])):?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $urlGenerator->generate('login')?>">Login/Register</a>
            </li>
            <?php endif ?>
            <?php if(isset($_SESSION['iduser'])):?>
            <li class="nav-item">
                <a class="nav-link" href="<?= $urlGenerator->generate('myaccount')?>">My account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= $urlGenerator->generate('logout')?>">Logout</a>
            </li>
            <?php endif ?>
        </ul>
        </div>
    </div>
  <!-- Navbar content -->
</nav>