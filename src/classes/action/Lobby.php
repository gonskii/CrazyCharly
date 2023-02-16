<?php

namespace teamiut\action;




class Lobby implements Action
{
    public function execute(): string
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $html = "";
        }
        else{
        $html = <<<END
            <!DOCTYPE html>
            <html lang="fr"> <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>teamiut</title>
            </head><body>

            <header>
                <div class="headerLeft">
                    <a>teamiut</a>
                </div>
               
                <div class="headerRight">
                    <a onclick="profilePage()"><i  class="fa-solid fa-user"></i></a>
                </div>
            </header>
            END;


        //$html .= $listeSerieRender->render();
        $html .= "<div class=\"content\">";
        //TODO
        $html .= "</div>";

        $html .= "<div class=\"content-profile\">";
        $html .= '<div class="profile">';
        $html .= '<a onclick="hideProfilePage()"><i class="fa-solid fa-xmark"></i></a>';
        $html .= '<a>Email : ' . unserialize($_SESSION['user'])->email . '</a><br>';
        $html .= '<a>Nom : ' . unserialize($_SESSION['user'])->nom . '</a><br>';
        $html .= '<a>Prenom : ' . unserialize($_SESSION['user'])->prenom . '</a><br>';

        // bouton de déconnexion
        $html .= '<a class="btn-deconnexion" href="?action=deconnexion"><i class="fa-solid fa-arrow-right-from-bracket"></i>  Déconnexion</a>';
        $html .= '</div></div>';

        $html .= '</body></html>';

    }
        return $html;
    }
}