<?php
require_once("lib/objectfiledb/ObjectFileDB.php");

class EndroitStorageFile implements EndroitStorage {

    public $db;

    public function __construct() {
         $this->db = new ObjectFileDB("/users/22012535/tmp/endroit.txt");
    }

    public function delete($id) {
        return $this->db->delete($id);
    }
    
    public function reinit() {

        $list = array(new Endroit('Caraïbes','499.99€',"25/07 - 02/08"), new Endroit('Hawaï','391.99€',"20/06 - 27/06"),
                        new Endroit('Indonésie','349.99€',"25/08 - 02/09") );

        for($i = 0; $i < sizeof($list); $i++) {
    
            $this->db->insert($list[$i]);
        }     
    }

    public function getDB() {
        return $this->db;
    }

    public function getId($endroit) {
        return  array_search($endroit, $this->db->fetchAll());
    }

    public function read($id) {

        return $this->db->fetch($id);
    }

    public function readAll() {
        return $this->db->fetchAll();
    }

    public function create(Endroit $e) {
        $this->db->insert($e);
    }

    public function update($id,Endroit $e) {
        $this->db->update($id,$e);
    }

}