<?php
class monCompteController
{

    public function __construct()
    {
        
        session_start();
        error_reporting(0);
        require_once "controller/Controller.php";
        require_once "vue/monCompte.php";

        if(Controller::auth()){
            $v=new monCompte();
            $v->affiche();

        }else {
            
            header('Location: index.php?error=login');

        }



    }


}