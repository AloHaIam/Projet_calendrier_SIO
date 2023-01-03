<?php
if(isset($_SESSION["user"])) {
    echo "<div class='header-container'>";
}
else {
    echo "<div class='header-container big'>";
}
?>

<nav>
    <?php

    ### on ajuste le texte si un utilisateur est connecte ou non
    if(isset($_SESSION["user"])) {
        $fullnameheader = $_SESSION['fullname'];
        echo "<p>$system_siteTitle • Bienvenue $fullnameheader</p>";
    }
    else {
    }
    ?>

    <ul>
        <?php
        ### on ajuste les fonctions si un utilisateur est connecte ou non
        if(isset($_SESSION["user"])) {
            echo "<li><a href='?action=logout'>Déconnexion</a></li>";
        }
        else {
            echo "<li><a href='inscription.php'>Inscription</a></li>";
        }
        ?>

        <li>
            <a href="?action=apropos">A propos</a>
        </li>
    </ul>
</nav>
<header>
    <?php
    if(!isset($_SESSION["user"])) {
    }
    ?>
</header>

</div>



<link href="../../../public/css/style.css" rel="stylesheet">




