<?php

namespace teamiut\tables;

use teamiut\db\ConnectionFactory as ConnectionFactory;

class Proposition {
    private int $IDUser;
    private string $description;
    private string $nom;
    private int $nbPlaceMax;

    public function __construct(int $IDUser, string $description, string $nom, int $nbPlaceMax   ) {
        $this->IDUser = $IDUser;
        $this->description = $description;
        $this->nom = $nom;
        $this->nbPlaceMax = $nbPlaceMax;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function save() {
        $db = ConnectionFactory::makeConnection();
        $sql = "INSERT INTO Proposition (IDUser, description, nom, nbPlacesMax) VALUES (:IDUser, :description, :nom, :nbPlaceMax)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':IDUser', $this->IDUser);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':nbPlaceMax', $this->nbPlaceMax);
        $stmt->execute();
    }

}