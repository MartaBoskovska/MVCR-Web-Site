<?php

/*
* Une interface qui contient et réunit toutes les méthodes utilisées
* pour obtenir, mettre à jour et insérer quelque chose dans la base de données
*/

interface EndroitStorage {

    public function read($id);

    public function readAll();

    public function create(Endroit $e);

    public function update($id,Endroit $e);
}