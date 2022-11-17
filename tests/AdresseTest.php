<?php
use PHPUnit\Framework\TestCase;
require_once  "src/metier/Adresse.php";
/**
 * classe de test pour l'objet Adresse
 */
class AdresseTest extends TestCase {

    /**
     * @var Adresse
     */
    protected $adresse;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() :void {
        $this->adresse = new Adresse(3,4,"rue de saint honoré",44000,"Nantes");
    }
    protected function tearDown() :void{
        $this->adresse = null;
    }
    public function testGetId() {
           $this->assertEquals("3",$this->adresse->getId());
    }

    public function testGetNumero() {
      $this->assertEquals("4",$this->adresse->getNumero());
    }
    public function testGetRue() {
   
        $this->assertEquals("rue de saint honoré",$this->adresse->getRue());
    }
    public function testGetCodePostal() {
       $this->assertEquals("44000",$this->adresse->getCodePostal());
    }

    /**
     * @covers Adresse::getVille
     */
    public function testGetVille() {
      $this->assertEquals("Nantes",$this->adresse->getVille());
    }

    /**
     * @covers Adresse::setId
     */
    public function testSetId() {
        // Remove the following lines when you implement this test.
        $this->adresse->setId("99");
          $this->assertEquals("99",$this->adresse->getId());
    }

    /**
     * @covers Adresse::setNumero
     */
    public function testSetNumero() {
       $this->adresse->setNumero("39");
        $this->assertEquals("39",$this->adresse->getNumero());
    }

    /**
     * @covers Adresse::setRue
     */
    public function testSetRue() {
        $this->adresse->setRue("rue de nantes");
       $this->assertEquals("rue de nantes",$this->adresse->getRue());
    }

    /**
     * @covers Adresse::setCodePostale
     */
    public function testSetCodePostal() {
        $this->adresse->setCodePostal(75000);
       $this->assertEquals(75000,$this->adresse->getCodePostal());
    }

    /**
     * @covers Adresse::setVille
     */
    public function testSetVille() {
        $this->adresse->setVille("Paris");
       $this->assertEquals("Paris",$this->adresse->getVille());
    }
    public function test__toString()
    {
        $this->assertEquals("[".$this->adresse->getId().",".$this->adresse->getNumero().",".$this->adresse->getRue().",".$this->adresse->getCodePostal().",".$this->adresse->getVille()."]", $this->adresse->__toString());
        echo $this->adresse;
    }

}
