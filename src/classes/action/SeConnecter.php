<?php

namespace teamiut\action;


use teamiut\auth\Auth as Auth;

/**
 * class SeConnecter
 * qui permet de se connecter au site
 */
class SeConnecter implements Action
{
    /**
     * methode execute qui permet de se connecter au site
     * @return string le rendu de la page
     */
    public function execute(): string
    {
        $header = new \teamiut\action\Header();
        $html = $header->execute();
        // header du site
        $html .= <<<END
            <!DOCTYPE html>
            <html lang="fr"> <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
            <title>Connexion</title>
            <link rel="stylesheet" href="src/css/styleLogin.css">
            </head> 
            <body class="text-center">
            END;

        // si la méthode est GET on affiche le formulaire de connexion
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $html .= <<<END
                <form method="post" action="?action=connexion">
                <div class="title"><h1>Connexion</h1></div>
                <p>Email :</p>
                <input type="email" name="email">
                <p>Password :</p>
                <input type="password" name="password" >
                <p>Vous ne possédez pas de compte <a id="createCompte" href="?action=inscription">Créer un compte</a></p>
                <p>Mot de passe oublié <a id="createCompte" href="?action=motDePasseOublie">Besoin d'aide ?</a></p>
                <button type="submit">Connexion</button>
                </form>
                END;

        } else if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
            // sinon on verifie les reponses et on se connecte si tout est bon
            if (empty($_POST['email']) || empty($_POST['password'])) {
                $html .= <<<END
                    <form method="post" action="?action=connexion">
                    <div class="title"><h1>Connexion</h1></div>
                    <p>Email :</p>
                    <input type="email" name="email">
                    <p>Password :</p>
                    <input type="password" name="password" >
                    <div class="error"><p>Veuillez remplir tous les champs !</p></div>
                    <p>Vous ne possédez pas de compte <a id="createCompte" href="?action=inscription">Créer un compte</a></p>
                    <p>Mot de passe oublié <a id="createCompte" href="?action=motDePasseOublie">Besoin d'aide ?</a></p>
                    <button id="disable" type="submit">Connexion</button></form>
                    END;
            } else {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $pass = $_POST['password'];
                $user = Auth::authentificate($email, $pass);
                if ($user != null) {
                    $_SESSION['user'] = serialize($user);
                    header("Location: ?action=lobby");
                    return '';
                } else if ($user == null) {
                    $html .= <<<END
                        <form method="post" action="?action=connexion">
                        <div class="title"><h1>Connexion</h1></div>
                        <p>Email :</p>
                        <input type="email" name="email">
                        <p>Password :</p>
                        <input type="password" name="password" >
                        <div class="error"><p>Email ou mot de passe incorrect !</p></div>
                        <p>Vous ne possédez pas de compte <a id="createCompte" href="?action=inscription">Créer un compte</a></p>
                        <p>Mot de passe oublié <a id="createCompte" href="?action=motDePasseOublie">Besoin d'aide ?</a></p>
                        <button id="disable" type="submit">Connexion</button></form>
                        END;
                }
            }

        }
        $html .= <<<END
            </body>
            </html>
END;

        return $html;

    }
}

