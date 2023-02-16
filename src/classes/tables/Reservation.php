<?php

namespace teamiut\tables;

use teamiut\utilitaire\Date as Date;
use teamiut\db\ConnectionFactory as ConnectionFactory;

class Reservation {
    private int $IDUser;
    private int $IDJourOuvert;
    private int $NBPersonnes;
    private Date $date;

    public function __construct(int $IDUser, int $IDJourOuvert, int $NBPersonnes, Date $date) {
        $this->IDUser = $IDUser;
        $this->IDJourOuvert = $IDJourOuvert;
        $this->NBPersonnes = $NBPersonnes;
        $this->date = $date;
    }

    public function __get($name) {
        return $this->$name;
    }

    public static function getReservationByUser(int $IDUser) {
        $db = ConnectionFactory::makeConnection();
        $sql = "SELECT * FROM Reservation WHERE IDUser = :IDUser";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':IDUser', $IDUser);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $reservations = array();
        foreach ($result as $row) {
            $reservations[] = new Reservation($row['IDUser'], $row['IDJourOuvert'], $row['nbPersonnes'], new Date($row['date']));
        }
        return $reservations;
    }

    public function save() {
        $db = ConnectionFactory::makeConnection();
        $sql = "INSERT INTO Reservation (IDUser, IDJourOuvert, NBPersonnes, date) VALUES (:IDUser, :IDJourOuvert, :NBPersonnes, STR_TO_DATE(:date, '%Y-%c-%d %H:%i'))";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':IDUser', $this->IDUser);
        $stmt->bindParam(':IDJourOuvert', $this->IDJourOuvert);
        $stmt->bindParam(':NBPersonnes', $this->NBPersonnes);
        $date = $this->date->toString();
        $stmt->bindParam(':date', $date);
        $stmt->execute();
    }



}
