<?php
require_once "src/Constantes.php";
require_once "src/metier/Adresse.php";

/**
 *
 *Classe permettant d'acceder en bdd pour inserer supprimer modifier
 * selectionner l'objet Adresse
 * @author pascal Lamy
 *
 */
class AdresseDB
{
    private $db; // Instance de PDO
    public $last_id;

    public function __construct($db)
    {
        $this->db = $db;
    }
    /**
     *
     * fonction d'Insertion de l'objet Adresse en base de donnee
     * @param Adresse $a
     * @param int $idp id personne
     */
    public function ajout(Adresse $a,int $idp)
    {
        $q = $this->db->prepare('INSERT INTO adresse(numero,rue,codepostal,ville,id_personne) values(:num,:rue,:cp,:v,:idp)');

        $q->bindValue(':num', $a->getNumero());
        $q->bindValue(':rue', $a->getRue());
        $q->bindValue(':cp', $a->getCodePostal());
        $q->bindValue(':v', $a->getVille());
        $q->bindValue(':idp', $idp);
        $q->execute();
        $this->last_id = $this->db->lastInsertId();
        $q->closeCursor();
        $q = null;
    }
    /**
     *
     * fonction de Suppression de l'objet Adresse
     * @param Adresse $a
     */
    public function suppression(Adresse $a)
    {
        $q = $this->db->prepare('delete from adresse where id_adresse=:ident');
        $q->bindValue(':ident', $a->getId());
        $res = $q->execute();

        $q->closeCursor();
        $q = null;
        return $res;
    }
/**
 * Fonction de modification d'une adresse
 * @param Adresse $a
 * @throws Exception
 */
    public function update(Adresse $a):void
    {
        try {
            $q = $this->db->prepare('UPDATE adresse set numero=:n,rue=:r,codepostal=:c,ville=:v where id_adresse=:i');
            $q->bindValue(':i', $a->getId());
            $q->bindValue(':n', $a->getNumero());
            $q->bindValue(':r', $a->getRue());
            $q->bindValue(':c', $a->getCodePostal());
            $q->bindValue(':v', $a->getVille());
            $q->execute();
            $q->closeCursor();
            $q = null;
        } catch (Exception $e) {
            throw new Exception(Constantes::EXCEPTION_DB_PERS_UP);

        }
    }
    /**
     *
     * Fonction qui retourne toutes les adresses
     * @throws Exception
     */
    public function selectAll(): array
    {

        $query = 'SELECT  id_adresse,numero,rue,codepostal,ville,id_personne FROM adresse';
        $q = $this->db->prepare($query);
        $q->execute();

        $arrAll = $q->fetchAll(PDO::FETCH_ASSOC);

        //si pas dadresse , on leve une exception
        if (empty($arrAll)) {
            throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);
        }

        $result = $arrAll;
        //Clore la requ�te pr�par�e
        $q->closeCursor();
        $q = null;
        //retour du resultat
        return $result;
    }
    /**
     *
     * Fonction qui retourne l'adresse en fonction de son id
     * @throws Exception
     * @param $id
     */
    public function selectAdresse($id): Adresse
    {
        $query = 'SELECT id_adresse,numero,rue,codepostal,ville,id_personne FROM adresse  WHERE id_adresse= :id ';
        $q = $this->db->prepare($query);

        $q->bindValue(':id', $id);

        $q->execute();

        $arrAll = $q->fetch(PDO::FETCH_ASSOC);
        //si pas d'e personne'adresse , on leve une exception

        if (empty($arrAll)) {
            throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);

        }

        $result = $arrAll;

        $q->closeCursor();
        $q = null;
        //conversion du resultat de la requete en objet adresse
        $res = $this->convertPdoAdr($result);
        //retour du resultat
        return $res;
    }
    /**
     *
     * Fonction qui convertie un PDO Adresse en objet Adresse
     * @param $pdoAdr
     * @throws Exception
     */

    public function convertPdoAdr($pdoAdr):Adresse
    {
        if (empty($pdoAdr)) {
            throw new Exception(Constantes::EXCEPTION_DB_ADR_CONVERT);
        }
        //conversion du pdo en objet
        try {
            $obj = (object) $pdoAdr;
            $i = (int) $obj->id_adresse;
            $n = (int) $obj->numero;
            //conversion de l'objet en objet adresse
            $adr = new Adresse($i, $n, $obj->rue,  $obj->codepostal, $obj->ville,$obj->id_personne);
            //affectation de l'id pers
            return $adr;
        } catch (Exception $e) {
            throw new Exception(Constantes::EXCEPTION_DB_ADR_CONVERT);

        }
    }

    public function selectAdresseIdPers($id_pers): Adresse
    {
        try {
            $query = 'SELECT id_adresse,numero,rue,codepostal,ville,id_personne FROM adresse  WHERE id_personne= :id ';
            $q = $this->db->prepare($query);
            $q->bindValue(':id', $id_pers);
            $q->execute();
            $arrAll = $q->fetch(PDO::FETCH_ASSOC);
            
            //si pas d'e personne'adresse , on leve une exception

            if ($arrAll == null) {
                throw new Exception(Constantes::EXCEPTION_DB_ADR_UP);
            }
            $q->closeCursor();
            $q = null;
            //conversion du resultat de la requete en objet adresse
            $res = $this->convertPdoAdr($arrAll);
            //retour du resultat
            return $res;
        } catch (Exception $e) {
            throw new Exception(Constantes::EXCEPTION_DB_PERS_UP);

        }
    }

}
