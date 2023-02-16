<?php

namespace teamiut\action;

use classes\auth\Auth;

class Accueil implements Action
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
            <title>Accueil</title>
            END;

        // si la méthode est GET on affiche le formulaire de connexion
        $html .= <<<END
            <label for="start">Start date:</label>

            <input type="date" id="start" name="trip-start"
            value="2018-07-22"
            min="2018-01-01" max="2018-12-31">
        END;


        return $html;
    }
}