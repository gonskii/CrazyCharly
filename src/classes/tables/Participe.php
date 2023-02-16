<?php

namespace teamiut\tables;
use teamiut\db\ConnectionFactory as ConnectionFactory;

class Participe {
    private array $participe;

    public function __construct()
    {
        $this->participe = array();
    }

    public function ajouterParticipation($IDEvent, $IDUser) {
        $this->participe[] = array($IDEvent, $IDUser);
    }

    public function getParticipe() {
        return $this->participe;
    }

    //to string
    public function __toString() {
        $str = "";
        foreach ($this->participe as $participation) {
            $str .= $participation[0] . " " . $participation[1] . "<br>";
        }
        return $str;
    }


    public function populateParticipe() {
        $conn = ConnectionFactory::makeConnection();
        $sql = "SELECT * FROM Participe";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            $this->ajouterParticipation($row['IDEvent'], $row['IDUser']);
        }
    }

    // get all users (IDUser) of an event
    public function getUsersOfEvent($IDEvent) {
        $conn = ConnectionFactory::makeConnection();
        $sql = "SELECT * FROM Participe WHERE IDEvent = :IDEvent";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDEvent', $IDEvent);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $users = array();
        foreach ($result as $row) {
            $users[] = $row['IDUser'];
        }
        return $users;
    }


    // get all events (IDEvent) of a user
    public function getEventsOfUser($IDUser) {
        $conn = ConnectionFactory::makeConnection();
        $sql = "SELECT * FROM Participe WHERE IDUser = :IDUser";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDUser', $IDUser);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $events = array();
        foreach ($result as $row) {
            $events[] = $row['IDEvent'];
        }
        return $events;
    }

}
