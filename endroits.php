<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */
require_once("Router.php");
require_once("/users/22012535/private/mysql_config.php");


/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */

$router = new Router();

/*Connexion au serveur, création d'une instance de PDO */
$dsn = 'mysql:host=' . MYSQL_HOST . ';port=' . MYSQL_PORT . ';dbname=' . MYSQL_DB . ';charset=utf8mb4';
$pdo = new PDO($dsn,MYSQL_USER,MYSQL_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*Appel de la fonction main du routeur avec une instance du PDO en argument*/ 
$router->main(new EndroitStorageMySQL($pdo));


?>