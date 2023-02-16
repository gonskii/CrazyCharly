<?php
declare(strict_types=1);
namespace teamiut\action;

use teamiut\tables\Proposition;

class PropositionEvenement implements Action
{
    /**
     * class PropositionEvenement
     * permet d'activer le compte d'un utilisateur
     */
    public function execute(): string
    {
        $html = <<<END
            <!DOCTYPE html>
            <html lang="fr">
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Proposition événement</title>
            </head><body>
            END;

        if($_SERVER['REQUEST_METHOD']==="GET")
        {
            $html .= <<< END
                <form class="form" method="post" action="?action=proposition_evenement">
                    <br><input type="texte" name="nomEvenement" placeholder="Nom de l'évenement"> <br>
                    <br><input type = "number" name="numberMax" placeholder="Nombre de place au maximum"> <br>
                    <br><input type="texte" name="description" placeholder="Description"> <br>
                    <button type="submit">Valider</button>
                </form>
                </body></html>
            END;
        }
        else if($_SERVER['REQUEST_METHOD']==="POST")
        {
            if (empty($_POST['nomEvenement']) || empty($_POST['numberMax']) || empty($_POST['description'])) {
                $html .= <<< END
                <form class="form" method="post" action="?action=proposition_evenement">
                    <br><input type="texte" name="nomEvenement" placeholder="Nom de l'évenement"> <br>
                    <br><input type = "number" name="numberMax" placeholder="Nombre de place au maximum"> <br>
                    <br><input type="texte" name="description" placeholder="Description"> <br>
                    <button type="submit">Valider</button>
                </form>
                </body></html>
            END;
            }
            elseif($_POST['numberMax']>60)
            {
                $html .= <<< END
                <form class="form" method="post" action="?action=proposition_evenement">
                    <br><input type="texte" name="nomEvenement" placeholder="Nom de l'évenement"> <br>
                    <br><input type = "number" name="numberMax" placeholder="Nombre de place au maximum"> <br>
                    <br><input type="texte" name="description" placeholder="Description"> <br>
                    <button type="submit">Valider</button>
                    <div class="error"><p>Un événement peut accepter au maximum 60 personnes</p></div>
                </form>
                </body></html>
            END;
            }
            else
            {
                $nom = filter_var($_POST['nomEvenement'], FILTER_SANITIZE_STRING);
                $nbMax = (int)filter_var($_POST['numberMax'],FILTER_SANITIZE_NUMBER_INT);
                $description = filter_var($_POST['description'],FILTER_SANITIZE_STRING);
                $user = unserialize($_SESSION['user']);
                $proposition = new Proposition($user->IDuser,$description,$nom,$nbMax);
                $proposition->save();
                $html .= "Votre proposition à été envoyé avec succès !";
            }
        }
        return $html;
    }
}