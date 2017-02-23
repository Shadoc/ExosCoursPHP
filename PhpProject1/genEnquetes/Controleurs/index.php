<?php

/*
 * Auteur Laurent Cordier
 * Date de création : 30/04/2012
 * Date de dernière modification : 30/04/2012
 * 
 * Fonctionnalités : redirection vers les sous controleurs en fonction du 
 * GET de la page
 * 
 * Etat d'avancement : A terminé
 */


// Chargement des "librairies"

include_once "Parametrage/db.conf.php";
include_once "Parametrage/path.conf.php";
include_once "Parametrage/constantes.conf.php";
include_once "Parametrage/TimeZone.conf.php";

include_once "Outils/Debogage.php";
include_once "Log/event.log.php";
include_once "Securite/sql.sec.php";
include_once "Modeles/Managers/outils.mgr.php";
include_once "Modeles/Managers/SGBD.mgr.php";

include_once "Modeles/Classes/Ordonnancement.class.php";
include_once "Modeles/Managers/ordonnancement.mgr.php";

include_once "Modeles/Classes/Enquete.class.php";
include_once "Modeles/Managers/enquete.mgr.php";

include_once "Modeles/Classes/Bouton.class.php";
include_once "Modeles/Managers/bouton.mgr.php";

include_once "Modeles/Classes/Ordonnancement.class.php";
include_once "Modeles/Managers/ordonnancement.mgr.php";

include_once "Modeles/Classes/Utilisateur.class.php";
include_once "Modeles/Managers/utilisateur.mgr.php";

include_once "Modeles/Classes/Groupe.class.php";
include_once "Modeles/Managers/groupe.mgr.php";

$piedPage = PATH_VUES . "piedPage.vue.php";

// Entete des messages d'erreur correspondant au script :
$prefixe = "<br>Controleur:index.php:>";
//debogage($prefixe);
//debogage($prefixe . "GET : " . "<br/>");
//debogage(print_r($_GET));
//debogage($prefixe . "POST : " . "<br/>");
//debogage(print_r($_POST));




// Controleur du menu test
$test = "Controleurs/enquetes_creer_vierge.php";
$fichierCSSTest = PATH_CSS . "administrateur.css";
$MenuNavigationTest = PATH_NAVIGATION . "redacteur.menu.php";


// Sous contrôleur par défaut
$sousControleurPardefaut = "Controleurs/accueil.ctrl.php";
debogage($prefixe . "souscontroleur par defaut : " . $sousControleur . "<br/>");


// Parametrage des menus en fonction de l'authentification
// Si une session est ouverte alors j'utilise les informations 
// contenu dans la session
if (isset($_SESSION['fichierCSS']) && isset($_SESSION['MenuNavigation'])) {
    $fichierCSS = $_SESSION['fichierCSS'];
    $MenuNavigation = $_SESSION['MenuNavigation'];
    $varControleur =  $_SESSION['controleur'];
    
    echo '<br/>+++++++++++++++++++++++++++++++++++++++<br/>';
    echo $varControleur;
    echo '<br/>+++++++++++++++++++++++++++++++++++++++<br/>';
    
    switch ($varControleur) {
        case "administrateur":
            $sousControleurPardefaut = "Controleurs/accueil_administrateur.ctrl.php";
            break;
        case "redacteur":
            $sousControleurPardefaut = "Controleurs/acceuil_redacteur.ctrl.php";
            break;

        default:
            break;
    }
} else {
// sinon c'est public
    $fichierCSS = PATH_CSS . "public.css";
    $MenuNavigation = PATH_NAVIGATION . "public.menu.php";
}

// Si une page est choisi alors de redirige vers le sous controleur correspondant
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case "test":
            $sousControleur = $test;
            $fichierCSS = $fichierCSSTest;
            $MenuNavigation = $MenuNavigationTest;
            break;
        case "accueil":
            $sousControleur = "Controleurs/accueil.ctrl.php";
            //$sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "presentation":
            //$sousControleur = "Controleurs/presentation.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "contact":
            //$sousControleur = "Controleurs/contact.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "redacteur":
            //$sousControleur = "Controleurs/redacteur.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "administrateur":
            //$sousControleur = "Controleurs/administrateur.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "sondage":
            //$sousControleur = "Controleurs/sondage.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;

        // Connexion-Déconnexion        
        case "connexion":
            $fichierCSS = PATH_CSS . "public.css";
            $MenuNavigation = PATH_NAVIGATION . "public.menu.php";
            $sousControleur = "Controleurs/connexion.ctrl.php";
            //$sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "deconnexion":
            $sousControleur = "Controleurs/deconnexion.ctrl.php";
            //$sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "erreur":
            $sousControleur = "Controleurs/erreur.ctrl.php";
            break;

        // ----------------------------------------------------------------
        //                         Administrateur
        // ----------------------------------------------------------------
        // Gestion des utilisateurs
        case "utilisateurs_ajouter":
            //$sousControleur = "Controleurs/utilisateurs_ajouter.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "utilisateurs_modifier":
            //$sousControleur = "Controleurs/utilisateurs_modifier.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "utilisateurs_supprimer":
            //$sousControleur = "Controleurs/utilisateurs_supprimer.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "utilisateurs_lister":
            //$sousControleur = "Controleurs/utilisateurs_lister.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;

        // Gestion de groupe
        case "groupes_accueil":
            $sousControleur = "Controleurs/groupes_accueil.ctrl.php";
            break;
        case "groupes_ajouter":
            $sousControleur = "Controleurs/groupes_ajouter.ctrl.php";
            break;
        case "groupes_modifier":
            //$sousControleur = "Controleurs/groupes_modifier.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "groupes_supprimer":
            //$sousControleur = "Controleurs/groupes_supprimer.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "groupes_lister":
            //$sousControleur = "Controleurs/groupes_lister.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "groupes_rechercher":
            $sousControleur = "Controleurs/groupes_rechercher.ctrl.php";
            break;


        // Gestion des enquêtes
        case "enquetes_modifier":
            //$sousControleur = "Controleurs/enquetes_modifier.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "enquetes_supprimer":
            //$sousControleur = "Controleurs/enquetes_supprimer.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "enquetes_publier":
            //$sousControleur = "Controleurs/enquetes_publier.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "enquetes_lister":
            //$sousControleur = "Controleurs/enquetes_lister.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "enquetes_attribuer":
            //$sousControleur = "Controleurs/enquetes_attribuer.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;

        // Gestion des gabarits
        case "gabarits_ajouter":
            //$sousControleur = "Controleurs/gabarits_ajouter.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "gabarits_modifier":
            //$sousControleur = "Controleurs/gabarits_modifier.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "gabarits_supprimer":
            //$sousControleur = "Controleurs/gabarits_supprimer.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "gabarits_lister":
            //$sousControleur = "Controleurs/gabarits_lister.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "gabarits_publier":
            //$sousControleur = "Controleurs/gabarits_publier.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;


        // ----------------------------------------------------------------
        //                         Redacteur
        // ----------------------------------------------------------------
        // Gestion des enquetes en mode redacteur        
        case "gerer_modifier":
            //$sousControleur = "Controleurs/enquete_gerer_modifier.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "gerer_supprimer":
            //$sousControleur = "Controleurs/enquete_gerer_supprimer.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "gerer_lister":
            //$sousControleur = "Controleurs/enquete_gerer_lister.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "gerer_publier":
            //$sousControleur = "Controleurs/enquete_gerer_publier.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "gerer_visualiser":
            //$sousControleur = "Controleurs/enquete_gerer_visualiser.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;

        // Menu création enquetes en mode redacteur
        case "creer_vierge":
            //$sousControleur = "Controleurs/enquete_creer_vierge.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "creer_existant":
            //$sousControleur = "Controleurs/enquete_creer_existant.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "gerer_gabarit":
            //$sousControleur = "Controleurs/enquete_creer_gabarit.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;

        // Exploiter les données en mode redacteur        
        case "exploiter_rep_par_rep":
            //$sousControleur = "Controleurs/exploiter_rep_par_rep.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "exloiter_prep_graphique":
            //$sousControleur = "Controleurs/exploiter_prep_graphique.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;
        case "exloiter_Exporter":
            //$sousControleur = "Controleurs/exploiter_Exporter.ctrl.php";
            $sousControleur = "Controleurs/enConstruction.ctrl.php";
            break;


        // Si une page est appelée alors qu'elle n'a pas de sous contrôleur, 
        // elle passe la main au sous controleur accueil.
        default:
            $sousControleur = $sousControleurPardefaut;
    }
}
// S'il n'y a pss de page choisi
else {
    $sousControleur = $sousControleurPardefaut;
}

debogage($prefixe . 'SousControleur apres filtrage : ' . $sousControleur);
include $sousControleur;
?>
