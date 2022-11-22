<?php

use function PHPUnit\Framework\equalTo;

require_once "Constantes.php";
require_once "metier/Personne.php";
require_once "metier/Adresse.php";

require_once "AdresseDB.php";
/**
 * 
*Classe permettant d'acceder en bdd pour inserer supprimer
 * selectionner des objets Personne
 * @author pascal Lamy
 *
 */
class PersonneDB
{
	private $db; // Instance de PDO
	private AdresseDB $adrDB;
	
	public function __construct($db)
	{
		$this->db=$db;
		$this->adrDB = new AdresseDB($db);
	}
	/**
	 * 
	 * fonction d'Insertion de l'objet Personne en base de donnee
	 * @param Personne $p
	 */
	public function ajout(Personne $p):void
	{
		$q = $this->db->prepare('INSERT INTO personne(id_personne,nom,prenom,datenaissance,telephone,email,login,pwd) values(:id,:nom,:prenom,:datenaissance,:telephone,:email,:login,:pwd)');
	
		$q->bindValue(':id',$this->db->lastInsertID()+1);
		$q->bindValue(':nom',$p->getNom());
		$q->bindValue(':prenom',$p->getPrenom());
		$q->bindValue(':datenaissance',$p->getDatenaissance()->format('Y-m-d'));
		$q->bindValue(':telephone',$p->getTelephone());
		$q->bindValue(':email',$p->getEmail());
		$q->bindValue(':login',$p->getLogin());
		$q->bindValue(':pwd',$p->getPwd());

		$this->adrDB->ajout($p->getAdresse(),$this->db->lastInsertID());
		$q->execute();	
		$q->closeCursor();
		$q = NULL;
	}
    /**
     * 
     * fonction de Suppression de l'objet Personne
     * @param Personne $p
     */
	public function suppression(Personne $p):void{
		 	$q = $this->db->prepare('delete from personne where nom=:n and prenom=:p and datenaissance=:d');
	$q->bindValue(':n',$p->getNom(),PDO::PARAM_STR);
	$q->bindValue(':p',$p->getPrenom(),PDO::PARAM_STR);
	$q->bindValue(':d',$p->getDatenaissance()->format('Y-m-d'));		
		$q->execute();	
		$q->closeCursor();
		$q = NULL;
	}
	/**
	 * 
	 * Fonction de selection en fonction du nom
	 * @param $nom
	 */
	public function selectionNom($nom){
		$query = 'SELECT id_personne, nom, prenom, datenaissance, telephone, email,login,pwd FROM personne  WHERE nom like :nom ';
		$q = $this->db->prepare($query);

	$q->bindValue(':nom',$nom);
			$q->execute();
		$arrAll = $q->fetch(PDO::FETCH_ASSOC);
		//si pas de personne , on leve une exception
		

		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_PERSONNE); 
		
		}
				
		$q->closeCursor();
		$q = NULL;
		//conversion du resultat de la requete en objet personne
	 	$res= $this->convertPdoPers($arrAll);
		//retour du resultat
		return $res;
	}
/**
	 * 
	 * Fonction de selection en fonction de l'id
	 * @param $nom
	 */
	public function selectionId($id){

		$query = 'SELECT id,nom,prenom,datenaissance,telephone,email,login,pwd FROM personne  WHERE id= :id ';
		$q = $this->db->prepare($query);

	
		$q->bindValue(':id',$id);
	
		$q->execute();
		
		$arrAll = $q->fetch(PDO::FETCH_ASSOC);
		//si pas de personne , on leve une exception

		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_PERSONNE); 
		
		}
		
		$q->closeCursor();
		$q = NULL;
		//conversion du resultat de la requete en objet personne
		$res= $this->convertPdoPers($arrAll);
		//retour du resultat
		return $res;
	}

	public function selectionLogin($log){
		
		$query = 'SELECT id_personne,nom,prenom,datenaissance,telephone,email,login,pwd FROM personne  WHERE login= :login ';
		$q = $this->db->prepare($query);

	
		$q->bindValue(':login',$log);
	
		$q->execute();
		
		$arrAll = $q->fetch(PDO::FETCH_ASSOC);
		//si pas de personne , on leve une exception

		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_PERSONNE); 
		
		}
		
		$q->closeCursor();
		$q = NULL;
		//conversion du resultat de la requete en objet personne
		$res= $this->convertPdoPers($arrAll);
		//retour du resultat
		return $res;
	}

	/**
	 * 
	 * Fonction qui retourne toutes les personnes
	 * @throws Exception
	 */
	public function selectAll():array
	{
		$query = 'SELECT nom,prenom,datenaissance,telephone,email,login,pwd FROM personne';
		$q = $this->db->prepare($query);
		$q->execute();
		
		$arrAll = $q->fetchAll(PDO::FETCH_ASSOC);
		
		//si pas de personnes , on leve une exception
		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_PERSONNE);
		}
		
				
		//Clore la requete préparée
		$q->closeCursor();
		$q = NULL;
		//retour du resultat
		return $arrAll;
	}
/**
	 * 
	 * Fonction qui convertie un PDO Personne en objet Personne
	 * @param $pdoPers
	 * @throws Exception
	 */
	public function convertPdoPers($pdoPers): Personne{
	if(empty($pdoPers)){
		throw new Exception(Constantes::EXCEPTION_DB_CONVERT_PERS);
	}
	//conversion du pdo en objet
	$obj=(object)$pdoPers;
	//conversion de l'objet en objet personne
	//conversion date naissance en datetime
	$dt =date_create ($obj->datenaissance);
	$adresse=new Adresse(99,32, "rue Jean moulin", 44000, "Nantes",4);
	
	$pers=new Personne($obj->nom,$obj->prenom,$dt,$obj->telephone, $obj->email,$obj->login,$obj->pwd,$adresse);
	//affectation de l'id pers
	$pers->setId($obj->id_personne);
	 	return $pers;	 
	}
	/**
	 * 
	 * Fonction de modification d'une personne
	 * @param Personne $r
	 * @throws Exception
	 */
	public function update(Personne $p): void
	{
		try {
		$q = $this->db->prepare('UPDATE personne set nom=:n,prenom=:p,datenaissance=:d,telephone=:t,email=:e,login=:l,pwd=:pass where id=:i');
		$q->bindValue(':i', $p->getId());	
		$q->bindValue(':n', $p->getNom());	
		$q->bindValue(':p', $p->getPrenom());	
		$q->bindValue(':d', $p->getDatenaissance()->format('Y-m-d'));	
		$q->bindValue(':t', $p->getTelephone());	
		$q->bindValue(':e', $p->getEmail());
		$q->bindValue(':l', $p->getLogin());
		$q->bindValue(':pass', $p->getPwd());
		$q->execute();	
		$q->closeCursor();
		$q = NULL;
		}
		catch(Exception $e){
			throw new Exception(Constantes::EXCEPTION_DB_PERS_UP); 
			
		}
	}

	public function authentification(string $login,string $pwd): bool
	{
		$q = $this->db->prepare('SELECT pwd FROM personne WHERE login = :l');
		$q->bindValue(':l',$login);
		$q->execute();

		$result = $q->fetch();
		
		//si pas de personnes , on leve une exception
		if(empty($result)){
			throw new Exception(Constantes::EXCEPTION_DB_PERSONNE);
		}

		
		$mdp = $result['pwd'];
	

		$q->closeCursor();
		$q = NULL;

		if($mdp==$pwd){
			return true;
		}else{
			return false;
		}
		

	}


}