<?php

namespace teamiut\action;


use teamiut\action\Header as Header;
use teamiut\action\Action as Action;
use teamiut\tables\Reservation as Reservation;
use teamiut\utilitaire\Date as Date;

class Restaurant implements Action
{

    public function execute(): string
    {

        //get all reservations.css of user
        $iduser = unserialize($_SESSION['user'])->IDuser;
        $reservations = Reservation::getReservationByUser($iduser);

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
        <link rel="stylesheet" href="src/css/reservations.css">
        <title>Restauration</title>
        END;

        $html .= <<<END
        </head><body>
        <h3>Vos réservations à venir : </h3>
        <ul>
        END;


        foreach ($reservations as $reservation) {
            $currentDate = new Date(date("Y-m-d H:i"));
            if (Date::comparerDate($reservation->date, $currentDate) > 0) {
                $date = str_replace("-", "/", $reservation->date->toString());
                $date = str_replace(" ", " à ", $date);
                $date = str_replace(":", "h", $date);
                $minutes = explode("h", $date);

                if ($minutes[1] == "0") {
                    $date = $minutes[0] . "h" . "00";
                }
                if (substr($minutes[0], -3) == "0") {
                    $date = substr($minutes[0], 0, -1) . "h" . $minutes[1];
                }

                $html .= "<div class='reservation'><li>" . $date . " pour " . $reservation->NBPersonnes . " personnes</li></div>";
            }
        }

        $html .= "</body></ul>";


        return $html;
    }
}