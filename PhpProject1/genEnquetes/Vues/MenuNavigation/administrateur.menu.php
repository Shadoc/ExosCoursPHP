<?php
 
print"
            <ul id='menuDeroulant'>
            <li>
                <a href='#'>Utilisateurs</a>
                <ul class='sousMenu'>
                    <li><a href='index.php?page=utilisateurs_ajouter'>Ajouter</a></li>
                    <li><a href='index.php?page=utilisateurs_modifier'>Modifier</a></li>                    
                    <li><a href='index.php?page=utilisateurs_supprimer'>Supprimer</a></li>
                    <li><a href='index.php?page=utilisateurs_lister'>Lister</a></li>
                </ul>
            </li>
            <li>
                <a href='index.php?page=groupes_accueil'>Groupes</a>
                <ul class='sousMenu'>
                    <li><a href='index.php?page=groupes_ajouter'>Ajouter</a></li>
                    <li><a href='index.php?page=groupes_modifier'>Modifier</a></li>                    
                    <li><a href='index.php?page=groupes_supprimer'>Supprimer</a></li>
                    <li><a href='index.php?page=groupes_lister'>Lister</a></li>
                    <li><a href='index.php?page=groupes_rechercher'>Rechercher</a></li>
                </ul>
            </li>
            <li>
                <a href='#'>Enquêtes</a>
                <ul class='sousMenu'>
                    <li><a href='index.php?page=enquetes_supprimer'>Supprimer</a></li>
                    <li><a href='index.php?page=enquetes_modifier'>Modifier</a></li>
                    <li><a href='index.php?page=enquetes_publier'>Publier</a></li>
                    <li><a href='index.php?page=enquetes_lister'>Lister</a></li>
                    <li><a href='index.php?page=enquetes_attribuer'>Attribuer</a></li>
                </ul>
            </li>   
            <li>
                <a href='#'>Gabarits</a>
                <ul class='sousMenu'>
                    <li><a href='index.php?page=gabarits_ajouter'>Ajouter</a></li>
                    <li><a href='index.php?page=gabarits_modifier'>Modifier</a></li>
                    <li><a href='index.php?page=gabarits_supprimer'>Supprimer</a></li>
                    <li><a href='index.php?page=gabarits_publier'>Publier</a></li>
                    <li><a href='index.php?page=gabarits_lister'>Lister</a></li>
                </ul>
            </li>
            <li>
                <a href='#'>Données</a>
                <ul class='sousMenu'>
                    <li><a href='index.php?page=exploiter_rep_par_rep'>Aff. réponse par réponse</a></li>
                    <li><a href='index.php?page=exploiter_prep_graphique'>Préparer graphiques</a></li>
                    <li><a href='index.php?page=exploiter_Exporter'>Exporter</a></li>
                </ul>
            </li>
            <li>
                <a href='index.php?page=deconnexion'>Déconnexion</a>
            </li>
        </ul>
        ";
?>
