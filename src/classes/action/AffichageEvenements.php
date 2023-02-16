<?php

namespace teamiut\action;


use teamiut\action\Header as Header;
use teamiut\action\Action as Action;
use teamiut\auth\Auth;
use teamiut\tables\Evenement as Evenement;
use teamiut\utilitaire\Date;

class AffichageEvenements implements Action
{

    public function execute(): string
    {
        //get all events
        $events = Evenement::getAllEvents();

        $header = new Header();
        $html = $header->execute();


        //display all events in a as a 3 columns grid
        $html .= <<<END
        <!DOCTYPE html>
        <html lang="fr"> <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">   
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
        crossorigin="anonymous" />
        <link rel="stylesheet" href="src/css/affichageEvenements.css">
        <title>Evénements</title>
        END;


        if(Auth::verification() && Auth::getRank() == 100)
        {
            $html .= <<<END
                <a href="?action=cree_evenement">Créer un évenement</a>
            END;

        }


        //loop on each event
        $html.= "<div class=container>";
        $html.= "<div class=row>";
        $dateJour = date("Y-m-d H:i");
        $dateJ = new Date($dateJour);

        foreach ($events as $event) {
            $dateEvent = $event->__get('date');
            if(Date::comparerDate($dateEvent, $dateJ) >= 0)
            {
                $html .=
                    "<div class='col-md-4' id='image_event'><a href=index.php?action=evenement&idEvenement=" . $event->IDEvent . "><img src=" . $event->image . "></a></div>";
            }
        }
        $html.= "</div>";
        $html.= "</div>";



        return $html;
    }
}