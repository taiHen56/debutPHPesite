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

		$adresse = new Adresse($idAdre,$num,$rue)
		$personne = new Personne($nom, $prenom, $date, $tel, $email, $login, $pwd);



	}
}