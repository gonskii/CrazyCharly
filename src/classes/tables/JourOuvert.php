<?php

namespace teamiut\tables;

use teamiut\utilitaire\Date as Date;
use teamiut\db\ConnectionFactory as ConnectionFactory;

class JourOuvert {
    private int $IDJourOuvert;
    private Date $dateDeb;
    private Date $dateFin;
    private int $nbPersonnes;
    private int $nbres;

    public function __construct(int $IDJourOuvert, Date $dateDeb, Date $dateFin, int $nbPersonnes, int $nbres) {
        $this->IDJourOuvert = $IDJourOuvert;
        $this->dateDeb = $dateDeb;
        $this->dateFin = $dateFin;
        $this->nbPersonnes = $nbPersonnes;
        $this->nbres = $nbres;
    }

    public function __get($name) {
        return $this->$name;
    }

    public static function populateJourOuvert() {
        $db = ConnectionFactory::makeConnection();
        $sql = "SELECT * FROM JourOuvert";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $joursOuverts = array();
        foreach ($result as $row) {
            $joursOuverts[] = new JourOuvert($row['IDJourOuvert'], new Date($row['dateDeb']), new Date($row['dateFin']), $row['nbPersonnes'], $row['nbres']);
        }
        return $joursOuverts;
    }

    public function save() {
        $db = ConnectionFactory::makeConnection();
        $sql = "INSERT INTO JourOuvert (dateDeb, dateFin, nbPers, nbRes) VALUES (STR_TO_DATE(:dateDeb, '%Y-%c-%d %H:%i'), STR_TO_DATE(:dateFin, '%Y-%c-%d %H:%i'), :nbPers, :nbRes)";
        $stmt = $db->prepare($sql);
        $dateDeb = $this->dateDeb->toString();
        $dateFin = $this->dateFin->toString();
        $stmt->bindParam(':dateDeb', $dateDeb);
        $stmt->bindParam(':dateFin', $dateFin);
        $stmt->bindParam(':nbPers', $this->nbPersonnes);
        $stmt->bindParam(':nbRes', $this->nbres);
        $stmt->execute();
    }

}
