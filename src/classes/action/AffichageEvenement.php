<?php
declare(strict_types=1);

namespace teamiut\action;
use teamiut\action\Action;
use teamiut\auth\Auth;
use teamiut\tables\Evenement;
use teamiut\tables\Participe;

class AffichageEvenement
{
    public function execute($idEvenement): string
    {
        $header = new Header();
        $html = $header->execute();
        $html .= <<<END
            <!DOCTYPE html>
            <html lang="fr">
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="src/css/affichageEvenement.css">
            <title>Court-circuit</title>
            </head><body>
            END;


        $listeEvenements = Evenement::getAllEvents();
        $existe = false;

        if(isset($idEvenement)&&!empty($idEvenement))
        {
            foreach ($listeEvenements as $evenement)
            {
                if($evenement->IDEvent == $idEvenement)
                {
                    $date = str_replace("-", "/", $evenement->date->toString());
                    $date = str_replace(" ", " à ", $date);
                    $date = str_replace(":", "h", $date);
                    $minutes = explode("h", $date);

                    if ($minutes[1] == "0") {
                        $date = $minutes[0] . "h" . "00";
                    }
                    if (substr($minutes[0], -3) == "0") {
                        $date = substr($minutes[0], 0, -1) . "h" . $minutes[1];
                    }
                    $existe = true;
                    $html .= <<< END
                    <div class="container">
                    <div class="left"><img src="$evenement->image"></div>
                    <div class="right">
                    <p>Nom : $evenement->nom</p>    
                    <p>Theme : $evenement->theme</p>
                    <p>Date : $date</p>
                    <p>Nombre de participant : $evenement->nbParticipant</p>
                    <p>nombre de participant au maximum : $evenement->nbPlaceMax</p>
                    <p>Description : $evenement->description</p> 
                    <p>Intervenant : $evenement->intervenant</p>
                    <p>Lieu : $evenement->lieu</p>
                    <form class="form" method="post" action="?action=evenement&idEvenement={$idEvenement}">
                        <button type="input">S'inscrire à l'évènement</button>
                    </form>         
                    </div>
                    </div>
                    END;

                    if($_SERVER['REQUEST_METHOD']=="POST")
                    {
                        $bool = false;
                        if(Auth::verification())
                        {
                            $user = unserialize($_SESSION['user']);
                            $idUser = $user->IDuser;
                            $bool = Participe::verifierParticipation($idUser,$idEvenement);

                            if(!$bool)
                            {
                                $html .= <<< END
                                <p>Vous êtes inscris !</p>
                                END;
                            }
                        }
                        else
                        {
                            header("Location: ?action=connexion");
                        }
                    }

                }
            }
            if(!$existe)
            {
                $html .= <<< END
                <div class="error">
                    <p>L'évènement n'existe pas</p>
                </div>
                END;
            }
        }
        else
        {
            $html .= <<< END
            <div class="error">
                <p>L'évènement n'existe pas</p>
            </div>
            END;

        }
        return $html;
    }
}
