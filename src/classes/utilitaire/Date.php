<?php

namespace teamiut\utilitaire;

/**
 * class Date
 * permet de gerer les dates
 */
class Date
{
    private int $minutes;
    private int $heures;
    private int $jour;
    private int $mois;
    private int $annee;

    /**
     * constructeur de la class Date qui prends en paramètre
     * tout les attributs de la class Date et les initialises
     */
    public function __construct(string $date)
    {
        $res = explode("-", $date);
        $this->annee = intval($res[0]);
        $this->mois = intval($res[1]);

        $res2 = explode(" ", $res[2]);
        $this->jour = intval($res2[0]);

        $res3 = explode(":", $res2[1]);
        $this->heures = intval($res3[0]);
        $this->minutes = intval($res3[1]);
    }

    /**
     * getter Magique de la classe Date
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * methode toString qui permet d'afficher la date
     * @return string la date sous forme de string
     */
    public function toString() : string {
        return $this->annee . "-" . $this->mois . "-" . $this->jour . " " . $this->heures . ":" . $this->minutes;
    }

    public static function comparerDate(Date $d1, Date $d2):int
    {
        if($d1->annee > $d2->annee) {
            return 1;
        } else if($d1->annee < $d2->annee) {
            return -1;
        } else {
            if($d1->mois > $d2->mois) {
                return 1;
            } else if($d1->mois < $d2->mois) {
                return -1;
            } else {
                if($d1->jour > $d2->jour) {
                    return 1;
                } else if($d1->jour < $d2->jour) {
                    return -1;
                } else {
                    if($d1->heures > $d2->heures) {
                        return 1;
                    } else if($d1->heures < $d2->heures) {
                        return -1;
                    } else {
                        if($d1->minutes > $d2->minutes) {
                            return 1;
                        } else if($d1->minutes < $d2->minutes) {
                            return -1;
                        } else {
                            return 0;
                        }
                    }
                }
            }
        }
    }


}