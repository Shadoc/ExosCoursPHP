<?php

// Entete des messages d'erreur correspondant au script :
$prefixe = "<br>Controleur:erreur.ctrl.php:>";
debogage($prefixe);
debogage("<br/>");
//debogage(print_r($_GET));
debogage($prefixe."GET['err'] : ".$_GET['err']);


$fichierCSS = PATH_CSS . "administrateur.css";
$MenuNavigation = PATH_NAVIGATION . "public.menu.php";
$piedPage = PATH_VUES . "piedPage.vue.php";

$erreur = "";
if (isset($_GET['err'])){
    $code_erreur = $_GET['err'];
    switch ($code_erreur){
        case "1":
            debogage($prefixe."case 1 : code_erreur : ".$code_erreur);
            $msg_erreur = "Erreur dans la requete SQL";
            break;
        default :
            debogage($prefixe."case default : code_erreur : ".$code_erreur);
            $msg_erreur = "";
    }
}

$contenuCentral = "<center><h2>Une erreur s'est produite dans l'application<br/>".$msg_erreur."
    .<br/>Veullez-contacter votre référent informatique.<br/>
    Merci</h2></center>";

// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>
