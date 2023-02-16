<?php

namespace teamiut\action;

use teamiut\action\Action as Action;

class Header implements Action
{
    public function execute(): string
    {
        // header du site
        $html = <<<END
            <!DOCTYPE html>
            <html lang="fr"> <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="src/css/accueil.css">
            <link href="https://fonts.cdnfonts.com/css/marine-sikona" rel="stylesheet">
            <title>Accueil</title>
            END;

        // si la méthode est GET on affiche le formulaire de connexion
        $html .= <<<END
        <body>
            <div id="headerUn">
                <a href="?action=menu">Menu</a>
                <a href="?action=informations">Informations</a>
                <a href="?action=faq">FAQ</a>
                <a class="logoHaut" href="https://www.instagram.com/courtcircuitvoltaire/?hl=fr"><img src="src/images/logo-instagram.png" alt="Logo instagram"></a>
                <a class="logoHaut" href="https://www.facebook.com/courtcircuitVoltaire/"><img src="src/images/facebook.png" alt="Logo facebook"></a>
            </div>
            <div id="headerDeux">
                <a href="" class="headerDeux">Accueil</a>
                <a href="" class="headerDeux">Le restaurant</a>
                <a href="" id="decalage" class="headerDeux">Evenement</a>
                <img id="logoHaut" src="src/images/logo-courcircuitbon.png" alt="Logo court Circuit">
                <a href="" class="headerDeux">Notre engagement</a>
                <a href="" class="headerDeux">Contact</a>
                <a id="seConnecter" class="headerDeux" href="?action=connexion">SE CONNECTER</a>
            </div>

            <div id="hautDePage">
                <h1 class="hautDePage">Bienvenu à</h1>
                <h1 class="sousTexteHautDePage">Court Circuit Nancy</h1>
                <h1 class="sousTexteHautDePage">Le local à vivre(s) !</h1>
        END;


        return $html;
    }
}