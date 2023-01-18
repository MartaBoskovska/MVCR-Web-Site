<?php

class Endroit {

    private $name;
    private $price;
    private $date;
    
    /*
    * Un endroit a un nom(name), un prix du voyage(price) et une date de départ(date)
    */
    public function __construct($name, $price, $date) {
        $this->name = $name;
        $this->price = $price;
        $this->date = $date;
    }


    /*
    * Getters pour les propriétés de la classe
    */
    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getDate() {
        return $this->date;
    }
}