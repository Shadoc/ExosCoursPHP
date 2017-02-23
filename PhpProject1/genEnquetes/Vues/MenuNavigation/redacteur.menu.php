<?php

print"
        <ul id='menuDeroulant'>
            <li>
                <a href='#'>Gérer</a>
                <ul class='sousMenu'>
                    <li><a href='index.php?page=gerer_modifier.ctrl.php'>Modifier</a></li>
                    <li><a href='index.php?page=gerer_supprimer.ctrl.php'>Supprimer</a></li>
                    <li><a href='index.php?page=gerer_lister.ctrl.php'>Lister</a></li>
                    <li><a href='index.php?page=gerer_publier.ctrl.php'>Publier</a></li>
                    <li><a href='index.php?page=gerer_visualiser.ctrl.php'>Visualiser</a></li>
                </ul>
            </li>   
            <li>
                <a href='#'>Créer à partir de...</a>
                <ul class='sousMenu'>
                    <li><a href='index.php?page=creer_vierge.ctrl.php'>Vierge</a></li>
                    <li><a href='index.php?page=creer_existant.ctrl.php'>Existant</a></li>
                    <li><a href='index.php?page=creer_gabarit.ctrl.php'>Gabarit</a></li>
                </ul>
            </li>
            <li>
                <a href='#'>Exploiter les données</a>
                <ul class='sousMenu'>
                    <li><a href='index.php?page=exloiter_rep_par_rep.ctrl.php'>Aff. réponse par réponse</a></li>
                    <li><a href='index.php?page=exloiter_prep_graphique.ctrl.php'>Préparer graphiques</a></li>
                    <li><a href='index.php?page=exloiter_Exporter.ctrl.php'>Exporter</a></li>
                </ul>
            </li>
            <li>
                <a href='index.php?page=deconnexion'>Déconnexion</a>
            </li>
        </ul>
        ";
?>
