<?php
require_once("model/Endroit.php");
require_once("model/EndroitBuilder.php");


class Controller {

    private $endroitStorage;
    private $view;
 

    public function __construct($endroitStorage,$view) {

        $this->endroitStorage = $endroitStorage;
        $this->view = $view;
    }


    /*
    * Cette méthode appelle la méthode correspondante en vue pour la création de la page d'un lieu 
    * La page affichera l'endroit correspondant de l'id passé en argument
    */
    public function showInformation($id) {

        if(in_array($id,array_keys($this->endroitStorage->readAll()))){
            $this->view->makeEndroitPage($this->endroitStorage->read($id),$id);
        }
        else { 
            $this->view->makeUnknownEndroitPage();
        }
    }

    

    /*
    * Cette méthode appelle la méthode correspondante en vue pour l'affichage de la page d'accueil 
    * La page d'accueil contient la liste avec tous les endroits
    */
    public function showList() {
        $this->view->makeListPage($this->endroitStorage->readAll());      
    }


    /*
    * La méthode qui gère la sauvegarde d'un endroit qui vient d'être créé
    */
    public function saveNewEndroit(array $data) { 

        $builder = new EndroitBuilder($data);
        $builder->isValid($builder->getData());

        if($builder->getError() != null) {

            /* S'il y a une erreur, la création du endroit ne se poursuivra pas */
            $_SESSION['currentNewEndroit'] = $builder;
            $this->view->displayAnimalCreationFailure();
        }
        else {

            $endroit = $builder->createEndroit();
            $this->endroitStorage->create($endroit);
            $this->view->displayEndroitCreationSuccess($this->endroitStorage->getId($endroit));
            $this->view->makeDebugPage($data);
        }
    }


    /*
    * La méthode qui gère la création d'un nouvel endroit
    */
    public function newEndroit($data) {

        if(key_exists('currentNewEndroit',$_SESSION) && $_SESSION['currentNewEndroit'] != null) {
            return $_SESSION['currentNewEndroit'];
        }else {
            return new EndroitBuilder($data);
        }    
    }


    /*
    * Cette méthode appelle la méthode correspondante en vue d'affichage
    * de la page qui demande confirmation pour supprimer un endroit
    */
    public function deletionConfirmation($id) {
        $this->view->makeEndroitAskDeletion($id);
    }


    /*
    * La méthode qui gère la suppression d'un endroit
    */
    public function endroitDeletion($id) {
        if($this->endroitStorage->read($id) != null) {
            $this->endroitStorage->delete($id);
            $this->view-> displayEndroitSupressionSuccess($id);
        }
        else {
            $this->view-> displayEndroitSupressionFailure();
        }
    }


    /*
    * La méthode qui gère la modification d'un endroit
    */
    public function endroitModification($id) {
        if(!key_exists('currentEndroitModifie', $_SESSION) || $_SESSION['currentEndroitModifie'] == null) {
            $e = $this->endroitStorage->read($id);
            if ($e === null) {
                $this->view->makeUnknownEndroitPage();
            } else {
            
            $builder = EndroitBuilder::buildFromEndroit($e);	
            $this->view->makeEndroitModificationPage($id, $builder);
            }
        }
        else {
            $this->view->makeEndroitModificationPage($id, $_SESSION['currentEndroitModifie']);
        }
        
    }


    /*
    * La méthode qui enregistre les modifications apportées à un endroit
    */
    public function saveEndroitModifications($id, $data) {
		
		$endroit = $this->endroitStorage->read($id);
		if ($endroit === null) {
			
			$this->view->makeUnknownEndroitPage();

		} else {
            
			$builder = new EndroitBuilder($data);
            
			$builder->isValid($data);
			if ($builder->getError() == null) {
				
				$builder->updateEndroit($endroit);
                $nouveauEndroit = $builder->createEndroit();
                $this->endroitStorage->update($id,$nouveauEndroit);
                $this->view->displayEndroitModificationSuccess($id);
		
			} else {
                $_SESSION['currentEndroitModifie'] = $builder;
                $this->view->displayEndroitModificationFailure($id);
			}
		}
	}

    public function showAPropos() {
        $this->view->makePageAPropos();
    }
}