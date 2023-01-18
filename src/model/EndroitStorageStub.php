<?php
require_once("EndroitStorage.php");

class EndroitStorageStub implements EndroitStorage {

    public $endroitsTab;

    public function __construct() {

        $this->endroitsTab = array("caraibes" => new Endroit('Caraïbes','499.99€',"25/07 - 02/08"), "hawai" => new Endroit('Hawaï','391.99€',"20/06 - 27/06"),
                                    "indonesie" => new Endroit('Indonésie','349.99€',"25/08 - 02/09") );
    }

    public function read($id) {
        if(in_array($id,array_keys($this->endroitsTab))){
            return $this->endroitsTab[$id];
        }
        else { 
            return null;
        }
    }
    public function readAll() {
        return $this->endroitsTab;
    }

    public function create(Endroit $e) {
        $this->endroitsTab[$e->getName()] = $e;
    }

    public function update($id,Endroit $e) {
        $this->db->update($e->getId(),$e);
    }
}