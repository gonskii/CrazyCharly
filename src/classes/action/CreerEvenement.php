<?php

namespace teamiut\action;

use teamiut\db\ConnectionFactory;
use teamiut\tables\Evenement;


class CreerEvenement implements Action
{
    function execute(): string
    {

        $header = new Header();
        $html = $header->execute();

        $html .= <<<END
            <!DOCTYPE html>
            <html lang="fr"> <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Accueil</title>
        END;

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $html .= <<<END
            <body>
                <form class="formulaireCreation" method="POST" action="?action=creerEvenement">
                <label for="nom">Nom</label> <input type="text"  name="nom" id="nom" value=""/><br />
                <label for="theme">Theme</label> <input type="text"  name="theme" id="theme" value=""/><br />
                <label for="jour">Jour de l'évenement</label> <input type="date"  name="jour" id="jour" value=""/><br />
                <label for="heure">Heure de l'évenement</label> <input type="time"  name="heure" id="heure" value=""/><br />
                <label for="description ">Description</label> <input type="text"  name="description" id="description" value=""/><br />
                <label for="nbplace">Nombres Places max</label> <input type="number"  name="nbplace" id="nbplace" value=""/><br />
                <label for="intervenants">Intervenants</label> <input type="text"  name="intervenants" id="intervenants" value=""/><br />
                <label for="lieu">Lieu</label> <input type="text"  name="lieu" id="lieu" value=""/><br />

                <input type="submit" name="Envoyer" value="Envoyer" /> </form>
        </body>
        END;
        } else if (($_SERVER['REQUEST_METHOD'] == 'POST'))
        {
            $nom = $_POST['nom'];
            $theme = $_POST['theme'];
            $jour = $_POST['jour'];
            $heure = $_POST['heure'];
            $description = $_POST['description'];
            $nbplace = filter_var($_POST['nbplace'], FILTER_SANITIZE_NUMBER_INT);
            $intervenants = $_POST['intervenants'];
            $lieu = $_POST['lieu'];

            $event = new Evenement(-1,$nom, $theme, $jour, $heure, $description, $nbplace, $intervenants, null , $lieu);
            $event->save();
            $html .= <<<END
                <body> <p>Evenement crée !</p></body>
            END;
        }

        return $html;

    }
}