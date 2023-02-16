<?php

namespace teamiut\action;

use teamiut\action\Action as Action;
use teamiut\auth\Auth;

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
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
                <a href="?action=accueil" class="headerDeux">Accueil</a>
                <a href="?action=restaurant" class="headerDeux">Le restaurant</a>
                <a href="?action=afficherEvenements" id="decalage" class="headerDeux">Evenement</a>
                <img id="logoHaut" src="src/images/logo-courcircuitbon.png" alt="Logo court Circuit">
                <a href="" class="headerDeux">Notre engagement</a>
                <a href="" class="headerDeux">Contact</a>
        END;

        if(Auth::verification())
        {
            $html .= <<<END
                <a id="seConnecter" class="headerDeux" href="?action=deconnexion">Déconnexion</a>
            END;
        }
        else
        {
            $html .= <<<END
            <a id="seConnecter" class="headerDeux" href="?action=connexion">SE CONNECTER</a>
            END;
        }

            $html .= <<<END

            </div>

            <div id="hautDePage">


                <!-- ajouter une image en fond -->
                <div class="bg-img" style="background-image: url('src/images/Fond.png');  background-position: center;
            background-repeat: no-repeat;
            background-size: cover; height: 100vh;" alt="bison">
                <h1 class="hautDePage">Bienvenu à</h1>
                <h1 class="sousTexteHautDePage">Court Circuit Nancy</h1>
                <h1 class="sousTexteHautDePage2">Le local à vivre(s) !</h1>  
        END;


        return $html;
    }
}