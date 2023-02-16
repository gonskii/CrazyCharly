<?php

namespace teamiut\tables;

use teamiut\utilitaire\Date as Date;

class Evenement {
    private int $IDEvent;
    private string $nom;
    private Date $date;
    private int $nbParticipant;
    private string $description;
    private int $nbPlaceMax;
    private string $intervenant;
    private string $lieu;
    private string $image;

    public function __construct(int $IDEvent, string $nom, Date $date, int $nbParticipant, string $description, int $nbPlaceMax, string $intervenant, string $lieu, string $image) {
        $this->IDEvent = $IDEvent;
        $this->nom = $nom;
        $this->date = $date;
        $this->nbParticipant = $nbParticipant;
        $this->description = $description;
        $this->nbPlaceMax = $nbPlaceMax;
        $this->intervenant = $intervenant;
        $this->lieu = $lieu;
        $this->image = $image;
    }

    public function __get($name) {
        return $this->$name;
    }
}