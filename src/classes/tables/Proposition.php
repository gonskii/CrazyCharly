<?php

namespace teamiut\tables;

use teamiut\db\ConnectionFactory as ConnectionFactory;

class Proposition {
    private int $IDProposition;
    private int $IDUser;
    private string $description;

    public function __construct(int $IDProposition, int $IDUser, string $description) {
        $this->IDProposition = $IDProposition;
        $this->IDUser = $IDUser;
        $this->description = $description;
    }

    public function __get($name) {
        return $this->$name;
    }

    public function save() {
        $db = ConnectionFactory::makeConnection();
        $sql = "INSERT INTO Proposition (IDProposition, IDUser, description) VALUES (:IDProposition, :IDUser, :description)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':IDProposition', $this->IDProposition);
        $stmt->bindParam(':IDUser', $this->IDUser);
        $stmt->bindParam(':description', $this->description);
        $stmt->execute();
    }

}