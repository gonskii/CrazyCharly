<?php

namespace teamiut\auth;

use teamiut\db\ConnectionFactory;
use PDO;
use teamiut\user\Utilisateur;

/**
 * Class Auth
 * qui permet de s'occuper le l'authentification et de l'inscription sur le site
 */
class Auth
{

    /**
     * methode authentificate qui permet de s'authentifier sur le site
     * @param string $email l'email que l'utilisateur a entré
     * @param string $passwd2check le mot de passe que l'utilisateur a entré
     * @return Utilisateur|null l'utilisateur si il existe, null sinon
     */
    public static function authentificate(string $email, string $passwd2check): ?Utilisateur
    {
            // on récupere l'utilisateur dans la base de données grace a son email
            $db = ConnectionFactory::makeConnection();
            $query = $db->prepare("select * from User where email = ?;");
            $query->bindParam(1, $email);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);

            // si l'utilisateur n'existe pas on retourne null sinon on recupere ses informations
            // on verifie que le mot de passe entré correspond au mot de passe de l'utilisateur
            // si c'est le cas on retourne l'utilisateur
            if($row === false) {
                return null;
            }else {
                $id = $row['IDUser'];
                $hash = $row['password'];
                $role = (int)$row['role'];
                $nom = $row['nom'];
                $prenom = $row['prenom'];
                if (!password_verify($passwd2check, $hash)) return null;
            }
            $user = new Utilisateur($id,$email,$hash,$nom,$prenom,$role);
            //on remplis tout les tableaux:
            return $user;
    }

    /**
     * methode register qui permet d'inscrire un utilisateur sur le site
     * @param string $email l'email que l'utilisateur a entré
     * @param string $pass le mot de passe que l'utilisateur a entré
     * @param string $nom le nom que l'utilisateur a entré
     * @param string $prenom le prenom que l'utilisateur a entré
     * @param string $sexe le sexe que l'utilisateur a entré
     * @return int -1 si le mdp n'est pas assez long0 si l'utilisateur a bien été inscrit, 0 si l'utilisateur existe deja
     * 1 si l'inscription a reussi
     */
    public static function register(string $email, string $pass, string $nom, string $prenom): int
    {
        // on verifie que le mot de passe est assez long
        if (strlen($pass) < 10 || strlen($pass) > 40) return -1;

        // on encode le mot de passe
        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 12]);

        // on verifie que l'email est bien une adresse email
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            // on verifie que l'email n'est pas déjà utilisé
            $db = ConnectionFactory::makeConnection();
            $sql = "select count(email) from User where email = ?;";
            $query = $db->prepare($sql);
            $query->bindParam(1, $email);
            $query->execute();
            $result = $query->fetch();

            // si l'email n'est pas utilisé on ajoute l'utilisateur dans la base de données
            if($result[0] == 0)
            {
                $sql = "insert into User(email, password, nom, prenom, role) values (?, ?, ?, ?, 1);";
                $query = $db->prepare($sql);
                $query->bindParam(1, $email);
                $query->bindParam(2, $hash);
                $query->bindParam(3, $nom);
                $query->bindParam(4, $prenom);
                $query->execute();
                $query->closeCursor();
                return 1;
            }
            else
            {
                // sinon on retourne 0
                return 0;
            }
        }
        return 0;

    }

    /**
     * methode verification permet de verifier si un utilisateur est dans la session
     * @return bool true si l'utilisateur est dans la session, false sinon
     */
    public static function verification():bool
    {
        if(isset($_SESSION['user'])) return true;
        return false;
    }

    /**
     * methode possedeCOmpte qui permet de savoir si un utilisateur possede un compte
     * @param string $email l'email que l'utilisateur a entré
     * @return bool true si l'utilisateur possede un compte, false sinon
     */
    public static function possedeCompte(string $email): bool
    {
        // on récupere l'utilisateur dans la base de données grace a son email
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("select * from Utilisateur where email = ?;");
        $query->bindParam(1, $email);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        // on retourne true si l'utilisateur existe, false sinon
        return $row != false;
    }


    /**
     * methode changerMotDePasse qui permet de changer le mot de passe d'un utilisateur
     * @param string $pass le mot de passe que l'utilisateur a entré
     * @param string $token le token que l'utilisateur a entré
     * @return void ne retourne rien
     */
    public static function changerMotDePasse(string $pass, string $token) : void {

        // on encode le mot de passe
        $hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 12]);

        // on modifie le mot de passe dans la base de données
        $db = ConnectionFactory::makeConnection();
        $sql = "update Utilisateur set motDePasse = ? where token = ?;";
        $query = $db->prepare($sql);
        $query->bindParam(1, $hash);
        $query->bindParam(2, $token);
        $query->execute();
        $query->closeCursor();

    }

    /**
     * fonction verifToken qui permet de verifier si le token est encore valide
     * @param string $token le token que l'utilisateur a entré
     * @return bool true si le token est valide, false sinon
     */
    public static function verifierToken(string $token): bool
    {
        // on récupere l'utilisateur dans la base de données grace a son token
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("select expireToken from Utilisateur where token = ?;");
        $query->bindParam(1, $token);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        // on retourne true si le token est encore valide, false sinon
        return $row['expireToken'] >= date('Y-m-d H:i:s',time());
    }


    public static function getRank() : int
    {
        $user = unserialize($_SESSION['user']);
        return $user->__get('role');
    }

}