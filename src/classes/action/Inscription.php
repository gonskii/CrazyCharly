<?php

namespace teamiut\action;


use teamiut\auth\Auth;
use teamiut\dispatch\Dispatcher;


class Inscription implements Action
{
    public function execute(): string
    {
        $header = new Header();
        $html = $header->execute();

        $html .= '<!DOCTYPE html>';
        $html .= '<html lang="fr"> <head>';
        $html .= '<meta charset="UTF-8">';
        $html .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $html .= '<link rel="stylesheet" href="src/css/styleLogin.css">';
        $html .= '<title>Inscription</title>';

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {

            $html .= '<form class="form" method="post" action="?action=inscription">';
            $html .= '<div class="title"><h1>Inscription</h1></div>';
            $html .= '<p>Email</p><input class="input" type="email" name="email" >';
            $html .= '<p>Password</p><input type="password" name="password" >';
            $html .= '<p>Password confirmation</p><input class="input" type="password" name="password2" >';
            $html .= '<div class="name"><div class="part"><p>Nom</p><input type="text" name="nom"></div>';
            $html .= '<div class="part"><p>Prenom</p><input class="input" type="text" name="prenom"></div></div>';
            $html .= '<button type="submit" id="btnInsc">Inscription</button>';
            $html .= '</form>';

        } else if (($_SERVER['REQUEST_METHOD'] == 'POST')) {     
            if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['nom'])
            || empty($_POST['prenom'])) {
                $html .= '<form class="form" method="post" action="?action=inscription">';
                $html .= '<div class="title"><h1>Inscription</h1></div>';
                $html .= '<p>Email</p><input class="input" type="email" name="email" >';
                $html .= '<p>Password</p><input type="password" name="password" >';
                $html .= '<p>Password confirmation</p><input class="input" type="password" name="password2" >';
                $html .= '<div class="name"><div class="part"><p>Nom</p><input type="text" name="nom"></div>';
                $html .= '<div class="part"><p>Prenom</p><input class="input" type="text" name="prenom"></div></div>';
                $html .= '<div class="error"><p>Tous les champs doivent ??tre renseign??s !</p></div>';
                $html .= '<button id="disable" type="submit">Inscription</button>';
                $html .= '</form>';
            } else if ($_POST['password'] != $_POST['password2']) {
                $html .= '<form class="form" method="post" action="?action=inscription">';
                $html .= '<div class="title"><h1>Inscription</h1></div>';
                $html .= '<p>Email</p><input class="input" type="email" name="email" >';
                $html .= '<p>Password</p><input type="password" name="password" >';
                $html .= '<p>Password confirmation</p><input class="input" type="password" name="password2" >';
                $html .= '<div class="error"><p>Les mots de passes ne sont pas identiques !</p></div>';
                $html .= '<div class="name"><div class="part"><p>Nom</p><input type="text" name="nom"></div>';
                $html .= '<div class="part"><p>Prenom</p><input class="input" type="text" name="prenom"></div></div>';
                $html .= '<button type="submit" id=" ">Inscription</button>';
                $html .= '</form>';
            } else {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $pass =$_POST['password'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $res = Auth::register($email, $pass, $nom, $prenom);
                if ($res == 1) {
                    Auth::authentificate($email, $pass);
                    return '';
                } elseif ($res == -1) {
                    $html .= '<form class="form" method="post" action="?action=inscription">';
                    $html .= '<div class="title"><h1>Inscription</h1></div>';
                    $html .= '<p>Email</p><input class="input" type="email" name="email" >';
                    $html .= '<p>Password</p><input type="password" name="password" >';
                    $html .= '<p>Password confirmation</p><input class="input" type="password" name="password2" >';
                    $html .= '<div class="error"><p>Les mots de passes sont trop court !</p></div>';
                    $html .= '<div class="name"><div class="part"><p>Nom</p><input type="text" name="nom"></div>';
                    $html .= '<div class="part"><p>Prenom</p><input class="input" type="text" name="prenom"></div></div>';
                    $html .= '<button type="submit">Inscription</button>';
                    $html .= '</form>';
                }
                else{
                    $html .= '<form class="form" method="post" action="?action=inscription">';
                    $html .= '<div class="title"><h1>Inscription</h1></div>';
                    $html .= '<p>Email</p><input class="input" type="email" name="email" >';
                    $html .= '<p>Password</p><input type="password" name="password" >';
                    $html .= '<p>Password confirmation</p><input class="input" type="password" name="password2" >';
                    $html .= '<div class="error"><p>Une erreur vient de se produire</p></div>';
                    $html .= '<div class="name"><div class="part"><p>Nom</p><input type="text" name="nom"></div>';
                    $html .= '<div class="part"><p>Prenom</p><input class="input" type="text" name="prenom"></div></div>';
                    $html .= '<button type="submit">Inscription</button>';
                    $html .= '</form>';
                }
            }
        }
        $html .= '</body></html>';
        return $html;
    }
}