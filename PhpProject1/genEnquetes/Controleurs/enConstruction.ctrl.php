<?php

$fichierCSS = PATH_CSS . "public.css";
$MenuNavigation = PATH_NAVIGATION . "public.menu.php";
$piedPage = PATH_VUES . "piedPage.vue.php";

$contenuCentral = "
    <center>
    <h2>Page en constrution.<br/></h2>
    <form>
        <input type='button' value='Retour' onclick='history.go(-1)'>
    </form>
    </center>";

// Affichage de la vue
include PATH_VUES . "template.vue.php";
?>
