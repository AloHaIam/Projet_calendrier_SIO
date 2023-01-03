<?php
if(isset($_SESSION["user"])) {
    echo "<div class='header-container'>";
}
else {
    echo "<div class='header-container big'>";
}
?>



<?php

$message = "";
$disppage= 0;

// si l'utilisateur est deja connecte, on le renvoi a l'accueil
if(isset($_SESSION["user"])) {
    header('Location:index.php');
    exit;
}

// si une requete est envoyee on la traite

if(isset($_POST['email']) && isset($_POST['name']) && isset($_POST['prenom']) && isset($_POST['phone']) && isset($_POST['pswd'])){
    $email = htmlentities($_POST['email']);
    $name = htmlentities($_POST['name']);
    $prenom = htmlentities($_POST['prenom']);
    $phone = htmlentities($_POST['phone']);
    $pswd = hash("sha512", $_POST['pswd']);
    if(isset($_POST['role'])){
        $role = 1;
    }
    else{
        $role = 0;
    }

    $nom_public = "$prenom $name";
    $date_creation = time();

    // check si les valeurs sont convenables
    if(strlen($name) > 1 && strlen($name) < 30 && strlen($prenom) > 1 && strlen($prenom) < 30 && strlen($_POST['pswd']) > 1 && strlen($_POST['pswd']) < 30) {


        // check si l'email est deja prise
        $emailreq = $connexion->prepare("SELECT * FROM users WHERE email=?");
        $emailreq->execute([$email]);
        $usermail = $emailreq->fetch();

        if ($usermail) {
            // l'adresse email existe deja
            $message = "Cette adresse e-mail est déjà prise.";
        } else {
            // sinon c'est bon

            // structure de la table. requete preparee
            $requete = "insert into users(nom,prenom,email,phone,passwd,role,nom_public,date_creation) values(:nom,:prenom,:email,:phone,:passwd,:role,:nom_public,:date_creation)";


            // structuration des parametres et envoi a la base
            $param = array(':nom' => $name, ':prenom' => $prenom, ':email' => $email, ':phone' => $phone, ':passwd' => $pswd, ':role' => $role, ':nom_public' => $nom_public, ':date_creation' => $date_creation);
            $req   = $connexion->prepare($requete);
            $req->execute($param);

            $message = "Bienvenue $name $prenom, vous êtes maintenant inscrit au service.<br>Vous pouvez vous connecter en appuyant sur le bouton ci dessous. <br><h5><a href='.'>Connexion</a></h5>";

            $disppage = 1;
        }

    }
    else {
        $message = "Veuillez vérifier la longueur du nom, du prénom ou de votre mot de passe (entre 1 et 30 caractères).";
    }

}

// sinon on affiche le form

else {
    $email = '';
    $name = '';
    $prenom = '';
    $phone = '';
    $pswd = '';
}

?>

<div class="body-content">
    <div class="login-page">
        <div class="form-block">
            <h4>Inscription</h4>
            <?php echo $message; ?>


            <?php
            if($disppage == 0) {
                echo "<form action='?action=inscription' method='post'>";
            }
            else {
                echo "<form action='?' class='invisible' method='post'>";
            }
            ?>

            <br>
            <br>
            <br>
            <br>
            <br>

            <br>
            <br>
            <br>
            <br>
            <br>

            <div class="form-input">
                <input type="email" placeholder="E-mail" name="email" id="email" required>
            </div>
            <div class="form-input">
                <input type="text" placeholder="Nom" name="name" id="name" required>
            </div>
            <div class="form-input">
                <input type="text" placeholder="Prénom" name="prenom" id="prenom" required>
            </div>
            <div class="form-input">
                <input type="password" placeholder="Mot de passe" name="pswd" id="pswd" required>
            </div>

            <div class="form-input">
                <button type="submit"><span class="material-icons">send</span></button>
            </div>
            </form>
        </div>
    </div>

</div>


<!-- Section Header -->



<link href="../../../public/css/style.css" rel="stylesheet">
