<?php

require_once "PDO/connectionPDO.php";
require_once "Constantes.php";
require_once "metier/Personne.php";
require_once "metier/Adresse.php";
require_once "PDO/PersonneDB.php";
require_once "PDO/AdresseDB.php";


//controller qui vérifie l'authentification.
//l'appel est fait par jquery .

class validerMonCompteController {

	public function __construct()
	{

		$idPers = $_SESSION['id'];
		$nom = $_POST['nom'] ?? $_SESSION['nom'];
		$prenom = $_POST['prenom'] ?? $_SESSION['prenom'];
		$date = $_POST['date'] ?? $_SESSION['dateNaissance'];
		$tel = $_POST['tel'] ?? $_SESSION['tel'];
		$email = $_POST['email'] ?? $_SESSION['email'];
		$log = $_SESSION['login'];
		$pwd = $_POST['pwd'] ?? $_SESSION['pwd'];

		$idAdre = $_SESSION['idAdresse'];
		$num = $_POST['num'] ?? $_SESSION['numAdresse'];
		$rue = $_POST['rue'] ?? $_SESSION['rueAdresse'];
		$code = $_POST['code'] ?? $_SESSION['codeAdresse'];
		$ville = $_POST['ville'] ?? $_SESSION['villeAdresse'];

		$adresse = new Adresse($idAdre, $num, $rue, $code, $ville, $idPers);
		$personne = new Personne($nom, $prenom, $date, $tel, $email, $log, $pwd, $adresse);

		$strConnection = Constantes::TYPE.':host='.Constantes::HOST.';dbname='.Constantes::BASE; 
        $arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $db = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam); //Ligne 3; Instancie la connexion
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$accesPersBDD = new PersonneDB($db);
		$accesAdresseBDD = new AdresseDB($db);

		


	}
}