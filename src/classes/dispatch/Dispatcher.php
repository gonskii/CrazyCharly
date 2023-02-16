<?php

namespace teamiut\dispatch;

use teamiut\action\Accueil;
use teamiut\action\Deconnexion;
use teamiut\action\Lobby;
use teamiut\action\SeConnecter;
use teamiut\action\Inscription;
use teamiut\action\MotDePasseOublie;
use teamiut\action\ChangementMotDePasse;


use teamiut\action\ActivationCompte;


use teamiut\Auth\Auth;

/**
 * Class Dispatcher
 * qui permet de dispatcher les requetes vers les actions correspondantes
 */
class Dispatcher
{

    /**
     * constructeur vide de la classe Dispatcher
     */
    public function __construct(){}

    /**
     * fonction dispatch qui permet de dispatcher les requetes vers les actions correspondantes
     * @return string le rendu de la page
     */
    public function dispatch(): string
    {
        // on récupère les données dans la requetes
        $action = (isset($_GET['action'])) ? $_GET['action'] : null;
        $idSerie = (isset($_GET['idSerie'])) ? $_GET['idSerie'] : null;
        $numEp = (isset($_GET['numEp'])) ? $_GET['numEp'] : null;


        $html = '';
        switch ($action) {
            case 'inscription':
                if(!Auth::verification()) {
                    $inscription = new Inscription();
                    $html = $inscription->execute();
                }
                else
                {
                    $lobby = new Lobby();
                    $html = $lobby->execute();
                }
                break;

            case 'lobby':
                if(!Auth::verification()) {
                    $connexion = new SeConnecter();
                    $html = $connexion->execute();
                }
                else
                {
                    $lobby = new Lobby();
                    $html = $lobby->execute();
                }
                break;


            case 'activation':
                $act = new ActivationCompte();
                $html = $act->execute();
                break;

            case 'profile':
                if(!Auth::verification())
                {
                    $connexion = new SeConnecter();
                    $html = $connexion->execute();
                }
                break;

            case 'connexion':
                $connexion = new SeConnecter();
                $html = $connexion->execute();
                break;

            case 'deconnexion':
                $deconnexion = new Deconnexion();
                $html = $deconnexion->execute();
                break;

            case 'motDePasseOublie':
                $mdp = new MotDePasseOublie();
                $html = $mdp->execute();
                break;

            case 'changementMotDePasse':
                $mdp = new ChangementMotDePasse();
                $html = $mdp->execute();
                break;

            default:
                if(Auth::verification())
                {
                    $lobby = new Lobby();
                    $html = $lobby->execute();
                }
                else
                {
                    $connexion = new Accueil();
                    $html = $connexion->execute();
                }
                break;

        }
        return $html;
    }
}