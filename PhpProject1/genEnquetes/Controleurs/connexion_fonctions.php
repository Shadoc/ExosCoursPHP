<?php

function verifiLogPass($login, $passwd) {
    $retour = false;

    $userMgr = new utilisateurMgr;
    $user = new Utilisateur;
 
    $user->setLOGIN_UTIL($login);
    $user->setPASS_UTIL($passwd);

    // Je vérifie l'authentification
    $user = $userMgr->verifLogPass($user);

    // Si j'ai un retour null alors ne n'ait pas de correspondance
    if ($user == null) {
        formulaireConnexion("ErrPassword");
        // Sinon 
    } else {
        

        $retour = $user;
    }
    return $retour;
}

/**
 * Retourne le groupe auquel un utilisateur appartient.
 * @param Utilisateur $user
 * @return \Utilisateur 
 */
function retourneGroupe(Utilisateur $user) {

    $userMgr = new utilisateurMgr;
    $groupe = $userMgr->utilisateurInGroupe($user);
    return $groupe;
}

?>
