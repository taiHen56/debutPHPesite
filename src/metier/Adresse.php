<?php
/**
 * 
 * Classe permettant de definir une adresse
 * @author Pascal Lamy
 *
 */
class Adresse {
	
	private int $id_adresse;
	private int $numero;
	private ?string $rue;
	private ?int $codePostal;
	private ?string $ville;
    private int $id_personne;
	
	function __construct(int $id_adresse, int $numero,string $rue,int $codePostal,string $ville,int $id_personne) {
            $this->id_adresse = $id_adresse;
            $this->numero = $numero;
            $this->rue = $rue;
            $this->codePostal = $codePostal;
            $this->ville = $ville;
            $this->id_personne=$id_personne;

        }

        function getId() {
            return $this->id_adresse;
        }

        function getNumero() {
            return $this->numero;
        }

        function getRue() {
            return $this->rue;
        }

        function getCodePostal() {
            return $this->codePostal;
        }

        function getVille() {
            return $this->ville;
        }

        function setId($id_adresse) {
            $this->id_adresse = $id_adresse;
        }

        function setNumero($numero) {
            $this->numero = $numero;
        }

        function setRue($rue) {
            $this->rue = $rue;
        }

        function setCodePostal($codePostal) {
            $this->codePostal = $codePostal;
        }

        function setVille($ville) {
            $this->ville = $ville;
        }

	/**
	 *
	 * renvoie sous forme de chaine de caracteres l'objet adresse en appelant echo ou print
	 */

	public function __toString(){
		return '[' .$this->getId().','
		.$this->getNumero().','
		.$this->getRue().','
		.$this->getCodePostal().','
         .$this->getVille().','
         .$this->getId_personne().']';

}

    /**
    * @return int
    */
    public function getId_personne(): int {
    	return $this->id_personne;
    }

    /**
    * @param int $id_personne
    */
    public function setId_personne(int $id_personne): void {
    	$this->id_personne = $id_personne;
    }
}