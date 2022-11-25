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
        echo '<div id="messagee"></div>';
        echo '<form class="compteForm" action="index.php?action=valider" id="monForm">';
        echo'<div class="form-group">';
        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="nomCase"> Nom </label>';
        echo '<input name="nom" type="text" id="nomCase" class="form-control" placeholder="'.$_SESSION['nom'].'"></div>';

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="prenomCase"> Prenom </label>';
        echo '<input name="prenom" type="text" id="prenomCase" class="form-control" placeholder="'.$_SESSION['prenom'].'"></div>';


        echo " <div class='form-row'>";
        echo "<label for='datenaiss'>Date de Naissance</label>";
        echo '<input name="date" id="datepicker" type="text" class="form-control" name="datenaiss"  value="'.$_SESSION['dateNaissance']->format('d/m/Y').'"placeholder="Entrer votre date de naissance" required>';
        echo '</div>';

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="telCase"> Télephone </label>';
        echo '<input name="tel" type="text" id="telCase" class="form-control" placeholder="'.$_SESSION['tel'].'"></div>';

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="emailCase"> Email </label>';
        echo '<input name="email" type="text" id="emailCase" class="form-control" placeholder="'.$_SESSION['email'].'"></div>';

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="loginCase"> login </label>';
        echo '<input name="log" type="text" readonly id="loginCase" class="form-control" placeholder="'.$_SESSION['login'].'"></div>';

        echo "<div class='form-row'>";
        echo "<label for='pwd'>Mot de passe</label>";
        echo '<div id="msg"></div>'; echo '<div id="msg2"></div>';
        echo '<input id="pwd" type="password" class="form-control" name="pwd"   placeholder="Entrer votre nouveau mot de passe" required>';
        echo '<input id="pwd2" type="password" class="form-control" name="pwd2"   placeholder="Confirmer votre nouveau mot de passe"required >';
        echo '</div>';

         //Partie Adresse

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="numCase"> Numero Adresse </label>';
        echo '<input name="num" type="text" id="numCase" class="form-control" placeholder="'.$_SESSION['numAdresse'].'"></div>';

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="rueCase"> Rue Adresse </label>';
        echo '<input name="rue" type="text" id="rueCase" class="form-control" placeholder="'.$_SESSION['rueAdresse'].'"></div>';

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="codeCase"> Code Postal </label>';
        echo '<input name="code" type="text" id="codeCase" class="form-control" placeholder="'.$_SESSION['codeAdresse'].'"></div>';

        echo'<div class="form-row">';
        echo '<label class="col-md-3" for="villeCase"> Ville </label>';
        echo '<input name="ville" type="text" id="villeCase" class="form-control" placeholder="'.$_SESSION['villeAdresse'].'"></div>';
                echo '<br>';
        echo '<button class="btn btn-primary" type="submit" onclick="return validate();">Valider</button>';   
        echo '</form>';

echo '</div>';
echo '</div>';

include "footer.html";
 }
}