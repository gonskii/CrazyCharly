<?php

namespace teamiut\tables;

use teamiut\utilitaire\Date as Date;
use teamiut\db\ConnectionFactory as ConnectionFactory;

class Evenement {
    private string $nom;
    private Date $date;
    private int $nbParticipant;
    private string $description;
    private int $nbPlaceMax;
    private string $intervenant;
    private string $lieu;
    private string $image;

    public function __construct(string $nom, Date $date, int $nbParticipant, string $description, int $nbPlaceMax, string $intervenant, string $lieu, string $image) {
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

    public static function getEventByID(int $IDEvent) {
        $db = ConnectionFactory::getConnection();
        $sql = "SELECT * FROM Evenement WHERE IDEvent = :IDEvent";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':IDEvent', $IDEvent);
        $stmt->execute();
        $result = $stmt->fetch();
        return new Evenement($result['IDEvent'], $result['nom'], new Date($result['date']), $result['nbParticipant'], $result['description'], $result['nbPlaceMax'], $result['intervenant'], $result['lieu'], $result['image']);
    }

    public function save() {
        $db = ConnectionFactory::makeConnection();
        $sql = "INSERT INTO Evenement (nom, date, NBParticipants, description, nbPlaceMax, intervenant, lieu, image) VALUES (:nom, STR_TO_DATE(:date, '%Y-%c-%d %H:%i'), :nbParticipant, :description, :nbPlaceMax, :intervenant, :lieu, :image)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nom', $this->nom);
        $date = $this->date->toString();
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':nbParticipant', $this->nbParticipant);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':nbPlaceMax', $this->nbPlaceMax);
        $stmt->bindParam(':intervenant', $this->intervenant);
        $stmt->bindParam(':lieu', $this->lieu);
        $stmt->bindParam(':image', $this->image);
        $stmt->execute();
    }
}