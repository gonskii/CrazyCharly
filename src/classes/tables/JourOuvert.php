<?php

namespace teamiut\tables;

use teamiut\utilitaire\Date as Date;

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
        $db = ConnectionFactory::getConnection();
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

}
