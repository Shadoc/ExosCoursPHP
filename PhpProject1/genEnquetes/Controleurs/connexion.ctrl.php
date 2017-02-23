<?php

//echo "<pre>------------------------------------------------</br>";
//var_dump($_POST);
//var_dump($_REQUEST);
// -----------------------------------------------------------------------------
//                          Fonctions
// -----------------------------------------------------------------------------
include_once 'connexion_formulaires.php';
include_once 'connexion_fonctions.php';

// -----------------------------------------------------------------------------
//                   Initialisation des variables
// -----------------------------------------------------------------------------
$msg = "";


// -----------------------------------------------------------------------------
//                          Programme principal
// -----------------------------------------------------------------------------
// Affichage du formulaire
// Si j'ai un un mot de passe et pas de password
if (isset($_POST['connLogin']) && isset($_POST['connPassword'])) {
    $login = $_POST['connLogin'];
    $passwd = $_POST['connPassword'];
    // si le login est vide
    if (empty($login)) {
        // Informer l'utilisateur et réafficher le formulaire
        $msg .= formulaireConnexion("NoLogin");
        // Affectation du hmtl au conteneur central 
        $contenuCentral = $msg;
        // Affichage de la vue
        include PATH_VUES . "template.vue.php";

        // sinon s'il n'y a pas de mot de passe
    } elseif (empty($passwd)) {
        // Informer l'utilisateur et réafficher le formulaire
        $msg .= formulaireConnexion("NoPassword");
        // Affectation du hmtl au conteneur central 
        $contenuCentral = $msg;
        // Affichage de la vue
        include PATH_VUES . "template.vue.php";
    }
    // Si j'ai récupéré un login et un mot de passe
    // je vérifie que la correspondance existe dans la base
    elseif (verifiLogPass($login, $passwd) != null) {
        //si oui alors je récupère l'utilisateur
        $user = new Utilisateur();
        $user = verifiLogPass($login, $passwd);

        // je recupere le groupe d'appartenance de l'utilisateur
        $groupe = retourneGroupe($user);

        // Et je stocke 
        $_SESSION['groupe'] = $groupe;

        switch ($groupe) {
            case "administrateur":
                $_SESSION['MenuNavigation'] = PATH_NAVIGATION . "administrateur.menu.php";
                // l'utilisation du  CSS administrateur
                $_SESSION['fichierCSS'] = PATH_CSS . "administrateur.css";
                // Le controleur par defaut sera adminstrateur
                $_SESSION['controleur'] = "administrateur";
                break;
            case "redacteur":
                $_SESSION['MenuNavigation'] = PATH_NAVIGATION . "redacteur.menu.php";
                // l'utilisation du  CSS administrateur
                $_SESSION['fichierCSS'] = PATH_CSS . "redacteur.css";
                // Le controleur par defaut sera redacteur
                $_SESSION['controleur'] = "redacteur";
                break;
            default:
                break;
        }
        $_GET = null;
        include 'index.php';
    }
} else {
    $msg .= formulaireConnexion();
    // Affectation du hmtl au conteneur central 
    $contenuCentral = $msg;
// Affichage de la vue
    include PATH_VUES . "template.vue.php";
}
?>
