<?php

namespace teamiut\tables;

use teamiut\utilitaire\Date as Date;
use teamiut\db\ConnectionFactory as ConnectionFactory;

class Evenement {
    private int $IDEvent;
    private string $nom;
    private string $theme;
    private Date $date;
    private int $nbParticipant;
    private string $description;
    private int $nbPlaceMax;
    private string $intervenant;
    private string $lieu;
    private string $image;

    public function __construct(int $IDEvent, string $nom, string $theme, Date $date, int $nbParticipant, string $description, int $nbPlaceMax, string $intervenant, string $lieu, string $image) {
        $this->IDEvent = $IDEvent;
        $this->nom = $nom;
        $this->theme = $theme;
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

    public static function getAllEvents() {
        $db = ConnectionFactory::makeConnection();
        $sql = "SELECT * FROM Evenement";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $events = array();
        foreach ($result as $row) {
            $events[] = new Evenement($row['IDEvent'], $row['Nom'], $row['theme'], new Date($row['date']), $row['NBParticipants'], $row['Description'], $row['NBPlaceMax'], $row['intervenant'], $row['Lieu'], $row['image']);
        }
        return $events;
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
        $sql = "INSERT INTO Evenement (Nom, theme, date, NBParticipants, Description, NBPlaceMax, intervenant, Lieu, image) VALUES (:nom, :theme, STR_TO_DATE(:date, '%Y-%c-%d %H:%i'), :nbParticipant, :description, :nbPlaceMax, :intervenant, :lieu, :image)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $this->nom);
        $stmt->bindParam(2, $this->theme);
        $date = $this->date->toString();
        $stmt->bindParam(3, $date);
        $zero = 0;
        $stmt->bindParam(4, $zero);
        $stmt->bindParam(5, $this->description);
        $stmt->bindParam(6, $this->nbPlaceMax);
        $stmt->bindParam(7, $this->intervenant);
        $stmt->bindParam(8, $this->lieu);
        $image = "images/event_1";
        $stmt->bindParam(9, $image);
        $stmt->execute();
    }
}