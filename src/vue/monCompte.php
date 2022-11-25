<?php
include_once "vue/Vue.php";
require_once "metier/Personne.php";
require_once "PDO/PersonneDB.php";

class monCompte extends Vue {
	
function affiche(){

include "header.html";
include "menu.php";

echo '<div class="covered-img">';
echo '<div class="container">';
        echo '<form>';
        echo'<div class="form-group">';
        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="nomCase"> Nom </label>';
        echo '<input type="text" id="nomCase" class="form-control" placeholder="'.$_SESSION['nom'].'"></div>';

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="prenomCase"> Prenom </label>';
        echo '<input type="text" id="prenomCase" class="form-control" placeholder="'.$_SESSION['prenom'].'"></div>';


        /**
         * @TODO Datepicker machin
         */

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="nomCase"> Nom </label>';
        echo '<input type="text" id="nomCase" class="form-control" placeholder="'.$_SESSION['nom'].'"></div>';

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="nomCase"> Nom </label>';
        echo '<input type="text" id="nomCase" class="form-control" placeholder="'.$_SESSION['nom'].'"></div>';

        echo '</form>';

echo '</div>';
echo '</div>';

include "footer.html";
 }
}