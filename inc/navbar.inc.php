<nav id="main-nav">
    <div class="row">
        <div class="container">

            <div class="logo">
                <a href="accueil.php" title="Retour à l'accueil"><h3>DevSkills</h3></a>
            </div>

            <div class="responsive"><i data-icon="m" class="ion-navicon-round"></i></div>

            <ul class="nav-menu list-unstyled">
                <li><a href="faq.php">FAQ</a></li>
                <?php if(!($_SESSION['logged'])){ ?>
                    <li><a href="index.php">Se connecter</a></li>
                    <li><a href="inscription.php">S'inscrire</a></li>
                <?php }
                if($_SESSION['logged']){ ?>
                    <li><a href="monCompte.php">Bonjour <?php echo $_SESSION['nom']; ?></a></li>
                    <?php if($_SESSION['admin']){ ?>
                        <li><a href="admin.php">Admin</a></li>
                    <?php } ?>
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a href="abonnement.php">Abonnements</a></li>
                    <li><a href="logout.php">Se déconnecter</a></li>
                <?php } ?>
            </ul>

        </div>
    </div>
</nav>
