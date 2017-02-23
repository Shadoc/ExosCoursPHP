<?php

$fichierCSS = PATH_CSS . "administrateur.css";
$MenuNavigation = PATH_NAVIGATION . "administrateur.menu.php";
$piedPage = PATH_VUES . "piedPage.vue.php";


$objUtilisateur = new Utilisateur();


$msg = "";
$msg .= "<center><h2>Gestion des boutons</h2></center>" . PHP_EOL;

$contenuCentral = $msg;



// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>
