<?php

class EndroitBuilder {

    const NAME_REF = "name";
    const PRICE_REF = "price";
    const DATE_REF = "date";
    
    private $data;
    private $error;

    public function __construct($data) {
        $this->data = $data;
        $this->error = null;
    }

    /*
    * Getters et setters pour les propriétés de la classe
    */

    public function getData() {
        return $this->data;
    }

    public function setData() {
        $this->data = null;
    }

    public function getError() {
        return $this->error;
    }


    /**
     * Méthode qui crée un nouvel objet endroit à partir d'un tableau donné
     */
    public function createEndroit() {
        return new Endroit($this->data[0], $this->data[1], $this->data[2]);
    }


    /**
     * Méthode qui crée un builder à partir d'un endroit donné
     */
	public static function buildFromEndroit(Endroit $endroit) {
		return new EndroitBuilder(array(
			0 => $endroit->getName(),
			1 => $endroit->getPrice(),
            2 => $endroit->getDate()
		));
	}


    /**
     * Méthode qui vérifie que les données saisies par l'utilisateur sont valides
     * (le nom n'est pas vide et le prix n'est pas négatif ni 0)
     */
    public function isValid($data) {

        if ($data[0] == "") {
            $this->error = "ERREUR: Le nom d'utilisateur est vide, veuillez le remplir afin de créer l'endroit.";

        }
        else if($data[1] < 0) {
            $this->error = "ERREUR: Le prix ne peut pas être négatif, veuillez entrer un prix valide.";
        }
    }


    /**
     * Une méthode qui met à jour les propriétés de la classe à partir d'un endroit donné en argument
     */
    public function updateEndroit(Endroit $e) {
		if (key_exists(self::NAME_REF, $this->data))
			$e->setName($this->data[0]);
		if (key_exists(self::PRICE_REF, $this->data))
			$e->setPrice($this->data[1]);
        if (key_exists(self::DATE_REF, $this->data))
			$e->setDate($this->data[2]);
	}
}