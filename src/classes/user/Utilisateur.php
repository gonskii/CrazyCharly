<?php

namespace teamiut\user;
use teamiut\db\ConnectionFactory;
use teamiut\video\episode\Serie;
use teamiut\video\Etat\EnCours;

class Utilisateur 
{
    private int $IDuser;
    private string $email;
    private string $password;
    private string $nom;
    private string $prenom;
    private int $role;



    /**
     * constructeur de la class Utilisateur qui prends en paramètre 
     * tout les attributs de la class
     */
    public function __construct(int $IDuser, string $email, string $password, string $nom, string $prenom, int $role)
    {
        $this->IDuser = $IDuser;
        $this->email = $email;
        $this->password = $password;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->role = $role;
    }


    /**
     * getter Magique
     */
    public function __get($name)
    {
        return $this->$name;
    }

    public function __toString()
    {
        return $this->nom . " " . $this->prenom;
    }

    public function getIdUser():int
    {
        return $this->IDuser;
    }
}