<?php
require_once("EndroitStorage.php");


/*
* La classe EndroitStorageMySQL gère toutes les requêtes SQL 
* et la communication avec la base de données
*/

class EndroitStorageMySQL implements EndroitStorage{

    public $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    /*
    * Cette méthode lit et retourne depuis la base de données l'endroit qui a l'id donné en argument
    */
    public function read($id) {
        $requete = "SELECT name,price,date FROM ENDROITS WHERE id='{$id}';";
        $stmt = $this->pdo->query($requete);
        $endroit = $stmt->fetch();
        return new Endroit($endroit[0],$endroit[1],$endroit[2]);
    }


    /*
    * Renvoie une liste de tous les objets de la table ENDROITS dans la base de données
    */
    public function readAll() {

        $requete = "SELECT * FROM ENDROITS;";
        $stmt = $this->pdo->query($requete);
        $data = $stmt->fetchAll();

        $endroits = array();
        foreach($data as $d) {
            $endroit= new Endroit($d[1],$d[2],$d[3]);
            $endroits[$d[0]] = $endroit;
        }
        return $endroits;
    }


    /*
    * Cette méthode est chargée de créer un nouvel endroit dans la base de données
    * Les informations provenant des utilisateurs n'étant pas sécurisées,
    * j'utilise des requêtes préparées pour protéger le site des injections SQL
    */
    public function create(Endroit $e) {
        $db = $this->getAllIds();
        $id = $this->generate_id($db);
        $requete = "INSERT INTO ENDROITS(id, name, price, date) VALUES (:id,:name,:price,:date)";
        $stmt = $this->pdo->prepare($requete);

        $data = array(
            ':id' => $id,
            ':name' => $e->getName(),
            ':price' => $e->getPrice(),
            ':date' => $e->getDate(),
          );
        $stmt->execute($data);
    }


    /*
    * Cette méthode est chargée  de la mise à jour d'un endroit modifié 
    * Les informations provenant des utilisateurs n'étant pas sécurisées,
    * donc cette méthode utilise des requêtes préparées pour protéger le site des injections SQL
    */
    public function update($id,Endroit $e) {

        $requete = "UPDATE ENDROITS SET name=:name, price=:price ,date=:date WHERE id=:id";
        
        $stmt = $this->pdo->prepare($requete);

        $data = array(
            ':id' => $id,
            ':name' => $e->getName(),
            ':price' => $e->getPrice(),
            ':date' => $e->getDate(),
          );

        $stmt->execute($data);
    }


    /* 
     * Supprime l'objet d'identifiant $id de la base.
     */
    public function delete($id) {
        $requete = "DELETE FROM ENDROITS WHERE id='{$id}';";
        return  $this->pdo->query($requete);
    }


    /*
    * Renvoie l'identifiant du endroit donné en argument
    */
    public function getId($endroit) {
        $requete = "SELECT id FROM ENDROITS WHERE name='" . $endroit->getName() . "';";
        return  $this->pdo->query($requete)->fetch()[0];
    }


    /* 
    * Génère un nouvel identifiant aléatoire qui n'existe pas
    * encore dans la BD donnée en paramètre. 
    */
    static private function generate_id($db) {
        do {
            $id = bin2hex(openssl_random_pseudo_bytes(8));
        } while (is_numeric($id[0]) || key_exists($id, $db));

        return $id;
    }


    /*
    * Renvoie une liste de tous les identifiants dans la base de données
    */
    public function getAllIds() {

        $requete = "SELECT id FROM ENDROITS ;";
        $db = $this->pdo->query($requete)->fetchAll();
        $db_array = array();

        foreach($db as $d) {
            $db_array[$d['id']] = ($d['id']);
        }
        return $db_array;
    }

    
}