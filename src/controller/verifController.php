<?php

require_once "PDO/connectionPDO.php";
require_once "Constantes.php";
require_once "metier/Personne.php";
require_once "PDO/PersonneDB.php";

//controller qui vérifie l'authentification.
//l'appel est fait par jquery .

class verifController {

	public function __construct()
	{      
		session_start();
		error_reporting(E_ALL);
		//recuperation login et pwd du formulaire
		$login=$_POST['log'];
		$pwd=$_POST['pwd'];
		//connexion a la bdd

        $strConnection = Constantes::TYPE.':host='.Constantes::HOST.';dbname='.Constantes::BASE; 
        $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $db = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$accesPersBDD = new PersonneDB($db);
		$accesAdresseBDD = new AdresseDB($db);
		$auth=$accesPersBDD->authentification($login, $pwd);
		if($auth == false){
			echo "erreur de login ou de mot de passe!!";
		}

		else {
			//conversion du pdo en objet
			$obj=$accesPersBDD->selectionLogin($login);
			$nom=$obj->getLogin();
			$idpers=$obj->getId();
			//creation d'un token et stockage en dans la variable de session
				$token = uniqid(rand(), true);
				$_SESSION['token'] = $token;
				//heure de creation du token en timestamp
				$_SESSION['token_time'] = time();

				$_SESSION['id'] = $idpers;
				$_SESSION['nom'] = $obj->getNom();
				$_SESSION['prenom'] = $obj->getPrenom() ;
				$_SESSION['dateNaissance'] = $obj->getDatenaissance() ;
				$_SESSION['tel'] = $obj->getTelephone() ;
				$_SESSION['email'] = $obj->getEmail() ;
				$_SESSION['login'] = $login ;
				$_SESSION['mdp'] = $pwd ;

				try{ 

					$adr = $accesAdresseBDD->selectAdresseIdPers($idpers);

				}catch(Exception $e){
					$adr = new Adresse(9999, 9999, "", 9999, "", 9999);
				}
				$_SESSION['idAdresse'] = $adr->getId();
				$_SESSION['numAdresse'] = $adr->getNumero();
				$_SESSION['rueAdresse'] = $adr->getRue();
				$_SESSION['codeAdresse'] = $adr->getCodePostal();
				$_SESSION['villeAdresse'] = $adr->getVille();
				
		//ok renvoyé au javascript pour rediriger vers accueil.php
		echo "ok-$token";
		}
			
		}
}