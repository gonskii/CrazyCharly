<?php

namespace teamiut\action;


use teamiut\action\Header as Header;
use teamiut\action\Action as Action;
use teamiut\tables\Reservation as Reservation;
use teamiut\utilitaire\Date as Date;

class FaireReservation implements Action
{

    public function execute(): string
    {

        //get all reservations.css of user
        $iduser = unserialize($_SESSION['user'])->IDuser;
        $reservations = Reservation::getReservationByUser($iduser);

        $header = new Header();
        $html = $header->execute();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $html .= <<<END
                <form method="post" action="?action=faireReservation">
                <div class="greenText"><h1>Réservation</h1></div>
                <label for="jour" class="greenText">Jour de la réservation :</label><br>
                <input type="date"  name="jour" id="jour" value=""/><br />
                <label for="heure" class="greenText">Heure de la réservation :</label><br>
                <input type="time"  name="heure" id="heure" value=""/><br />
                <p class="greenText">Nombre de personnes :</p>
                <input type="number" name="nbpers"><br>
                <button type="submit">Réserver</button>
                </form>
                END;

        } else {
            $jour = filter_var($_POST['jour'], FILTER_SANITIZE_STRING);
            $heure = filter_var($_POST['heure'], FILTER_SANITIZE_STRING);
            $nbPers = filter_var($_POST['nbpers'], FILTER_SANITIZE_NUMBER_INT);
            $iduser = unserialize($_SESSION['user'])->IDuser;
            $reservation = new Reservation($iduser, 1, $nbPers, new Date($jour." ".$heure));
            $reservation->save();
            $html .= "<p class='greenText'>réservation enregistré !</p>";
        }
        return $html;
    }
}