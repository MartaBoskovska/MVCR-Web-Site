<?php

class View {

    private $name;
    private $price;
    private $date;
    protected $router;
    protected $feedback;
    protected $list;
    protected $title;

    public function __construct($router, $feedback) {
        $this->router = $router;
        $this->feedback = $feedback; 
    }

    /*
    * Setters pour les propriétés de la classe
    */
    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setFeedback($feedback) {
        $this->feedback = $feedback;
    }
    
    public function makeTestPage() {
        $this->name = "ddggs";
        $this->price = 146;
        $this->date = "20/02/2001";
        include "squelette.php";
    }

    public function makeEndroitPage($endroit,$id) {
        
        $this->name = $endroit->getName();
        $this->price = $endroit->getPrice();
        $this->date = $endroit->getDate();
        $this->id = $id;
        $this->title = $endroit->getName();
        include "squelette.php";
    }

    public function makeUnknownEndroitPage() {
        echo "Endroit inconnu.";
    }

    public function makeListPage($endroitsTab) {
        
        $this->list = array_keys($endroitsTab);
        $this->title = "Page d'accueil";
        include "squeletteAccueil.php";
    }

    public function makeDebugPage($variable) {
        $this->title = 'Debug';
        $this->content = '<pre>'.htmlspecialchars(var_export($variable, true)).'</pre>';
    }

    /*
    * Méthode qui gère la page de création.
    */
    public function makeEndroitCreationPage($builder) {

        $name = "";
        $price = "";
        $date = "";
  
        $data = $builder->getData();
        $error = $builder->getError();
        
        /*
        * S'il y avait une erreur dans le formulaire,
        * cela récupère les anciennes valeurs et remplit le formulaire avec elles. 
        */
        if($data != null){
            $name = $data[0];
            $price = $data[1];
            $date = $data[2];
        }
        
        
        $this->title = "Création d'un nouveau endroit";
        $url = $this->router->getEndroitSaveURL();
        include "squeletteCreation.php";
    }


    public function makeEndroitAskDeletion($id) {
        $this->id = $id;
        include "squeletteConfirmation.php";
    }


    public function makePageAPropos() {
        $this->title = "A propos";
        include "squelettePropos.php";
    }


    public function makeEndroitModificationPage($id,$builder) {

        $name = "";
        $price = "";
        $date = "";

        $data = $builder->getData();
        $error = $builder->getError();
        
        if($data != null){
            $name = $data[0];
            $price = $data[1];
            $date = $data[2];
        }


        $this->title = "Modification d'un lieu";
        $url = $this->router->getEndroitUpdateURL($id);
        include "squeletteCreation.php";
    }


    /**
     * Des méthodes qui gèrent le feedback et la redirection lors d'un succès ou d'un échec.
     */
    
    public function displayEndroitCreationSuccess($id) {
        $this->feedback = "Vous avez cree un nouvelle endroit avec succes.";
        $this->router->POSTredirect($this->router->getEndroitPageURL($id), $this->feedback);
        $_SESSION['currentNewEndroit'] = null;

    }


    public function displayEndroitCreationFailure() {
        $this->feedback = "Vous avez un erreur  lors de la création de votre endroit.";
        $this->router->POSTredirect($this->router->getEndroitCreationURL(), $this->feedback);
    }


    public function displayEndroitModificationSuccess($id) {
        $this->feedback = "Vous avez modifie l'endroit avec success.";
        $this->router->POSTredirect($this->router->getEndroitPageURL($id), $this->feedback);
        $_SESSION['currentNewModifie'] = null;
    }


    public function displayEndroitModificationFailure($id) {
        $this->feedback = "Vous avez un erreur lors de la création de votre endroit.";
        $this->router->POSTredirect($this->router->getEndroitModificationURL($id), $this->feedback);
    }
    

    public function displayEndroitSupressionSuccess($id) {
        $this->feedback = "L'endroit a été supprimé avec succès";
        $this->router->POSTredirect($this->router->getPageAccueilURL(), $this->feedback);
    }


    public function displayEndroitSuppresionFailure() {
        $this->feedback = "Vous avez un erreur lors de la suppression de votre endroit(l'id n'existe pas).";
        $this->router->POSTredirect($this->router->getPageAccueilURL(), $this->feedback);
    }



}


