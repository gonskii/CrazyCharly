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
        $html = $html = <<<END
            <!DOCTYPE html>
            <html lang="fr">
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    $date = $evenement->date->toString();
                    $existe = true;
                    $html .= <<< END
                    <p>Nom : $evenement->nom</p>    
                    <p>Theme : $evenement->theme</p>
                    <p>Date : $date</p>
                    <p>Nombre de participant :  nombre de participant au maximum:  $evenement->nbParticipant</p>
                    <p>Description : $evenement->description</p> 
                    <p>Intervenant : $evenement->intervenant</p>
                    <p>Lieu : $evenement->lieu</p>
                    <img src="$evenement->image"> 
                    <form class="form" method="post" action="?action=evenement&idEvenement={$idEvenement}">
                        <button type="input"">S'inscrire à l'évènement</button>
                    </form>         
                    END;

                    if($_SERVER['REQUEST_METHOD']=="POST")
                    {
                        $bool = false;
                        if(Auth::verification())
                        {
                            $user = unserialize($_SESSION['user']);
                            $idUser = $user->IDuser;
                            $bol = Participe::verifierParticipation($idUser,$idEvenement);

                            if(!$bol)
                            {
                                $html .= <<< END
                                <p>Vous êtes inscris</p>
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
