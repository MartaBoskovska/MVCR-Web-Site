<?php

require_once("view/View.php");
require_once("control/Controller.php");
require_once("model/EndroitBuilder.php");
require_once("model/EndroitStorageMySQL.php");
require_once("model/EndroitStorage.php");



class Router {

    public function main($endroitStorageFile) {

        session_start();
        
        if(key_exists('feedback',$_SESSION)) {
            /*Création de la vue avec le feedback existants*/
            $view = new View($this,  $_SESSION['feedback']);
        }
        else {
            /*Création de la vue si il n'y a pas encore feedback dans la session*/
            $view = new View($this, '');
        }

        $controller = new Controller($endroitStorageFile,$view);

        if(key_exists('PATH_INFO',$_SERVER)) {
           
            $data = explode("/",$_SERVER['PATH_INFO']); // Le PATH-INFO est séparé dans un tableau à l'aide du délimiteur '/'
            if(sizeof($data) == 2) {
                /*
                *Le premier SWITCH CASE lorsque mon URL ne contient que l'action et non un identifiant
                *Les cases sont toutes les actions possibles dans l'URL
                */
                switch($data[1]) {
                    case "nouveau":
                        $view->makeEndroitCreationPage($controller->newEndroit([]));
                        break;
                    case "sauverNouveau":
                        $controller->saveNewEndroit(array($_POST["name"],$_POST["price"], $_POST["date"]));
                        break;
                    case "liste":
                        $controller->showList();
                        break;
                    case "aPropos":
                        $controller->showAPropos();
                        break;
                    default:
                        $controller->showInformation($data[1]);
                    }
            }
            else {
                $action = $data[1];
                $id =  $data[sizeof($data)-1];
                /*
                *Le deuxieme SWITCH CASE lorsque mon URL contient UN action et un identifiant
                */
                switch($action) {
                    case "supprimerDemande":
                        $controller->deletionConfirmation($id);
                        break;
                    case "supprimer":
                        $controller->endroitDeletion($id);
                        break;
                    case "modifier":
                        $controller->endroitModification($id);
                        break;
                    case "update":
                        $controller->saveEndroitModifications($id, array($_POST["name"],$_POST["price"], $_POST["date"]));
                        break;
                }
            }
            unset($_SESSION['feedback']);
        }
        else {
            $controller->showList();
        }
    }

    /*
    * Les méthodes qui renvoient les urls de toutes les différentes pages de mon site
    */
    public function getEndroitModificationURL($id) {
        return $_SERVER['SCRIPT_NAME'] . "/modifier/{$id}";
    }

    public function getEndroitUpdateURL($id) {
        return $_SERVER['SCRIPT_NAME'] . "/update/{$id}";
    }

    public function getEndroitPageURL($id) {
        return $_SERVER['SCRIPT_NAME'] . "/{$id}";
    }

    public function getEndroitCreationURL() {
        return $_SERVER['SCRIPT_NAME']. "/nouveau"; 
    }

    public function getEndroitSaveURL() {
        return $_SERVER['SCRIPT_NAME'] . "/sauverNouveau";
    }

    public function getPageAccueilURL() {
        return $_SERVER['SCRIPT_NAME'] . "/liste";
    }

    public function getEndroitDeletionURL($id) {
        return $_SERVER['SCRIPT_NAME'] . "/supprimer/{$id}";
    }

    public function getEndroitAskDeletionURL($id) {
        return $_SERVER['SCRIPT_NAME'] . "/supprimerDemande/{$id}";
    }

    public function getPageAProposURL() {
        return $_SERVER['SCRIPT_NAME'] . "/aPropos";
    }

    /*
    * Cette méthode redirige vers l'URL passée en argument
    */
    public function POSTredirect($url, $feedback) {
        
        $_SESSION['feedback'] = $feedback;
        header("Location: " . $url, true, 303);  
        die;
    }
    
}

