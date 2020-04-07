<?php
    require 'lib/autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    //$personne = new PersonneManager_PDO($db);


if(isset($_POST['valider']) )
{
    
    
    
    
    try{
	//recuper le deriner idPret de la base
	$iden = $db->query('SELECT * FROM pret ORDER BY idPret DESC LIMIT 1 ')->fetchColumn();
	
	
	//Fonction pour l'identifiant
    //Tout ceci sera mis en fonction
    $nouveau = "0000000";
    
    
    //récupération de la partie chiffre 
    $i = 0;
    $a = (strlen($iden)-7);
    //$a = 9;
    while ($i <= 6)
    {
        $nouveau[$i] = $iden[$a];
        $i++;
        $a++;
        echo' </br>';
    }
   
    $nouveau++; //incrémentation de la partie chiffre
 
    $nouveau = (string) $nouveau; //conversion en string
    $t = strlen($nouveau)-1;
    $o = strlen($iden)-1;
    
    if($t > 6)
    {
        echo"Le nombre d'enregistrement prévu est atteint. </br>";
        echo"Veillez à contacter le developpeur. Merci </br>";
    }
    
    //modification de l'id
    while($t >= 0)
    {
        $iden[$o] = $nouveau[$t];
        $o--;
        $t--;
    }
	
	$str = "INSERT INTO pret VALUES ('$iden', '".mysql_escape_string($_POST['numComptePret'])."',  '".mysql_escape_string($_POST['login'])."', NOW(), '".mysql_escape_string($_POST['mntPretD'])."',
                                '".mysql_escape_string($_POST['etatPret'])."', '".mysql_escape_string($_POST['taux'])."', '".mysql_escape_string($_POST['fraisdossier'])."', '".mysql_escape_string($_POST['duree'])."',NOW(),
                                '".mysql_escape_string($_POST['commentaire'])."', '".mysql_escape_string($_POST['mntPretD'])."', '".mysql_escape_string($_POST['typeCompte'])."', '".mysql_escape_string($_POST['garantiePret'])."', '".mysql_escape_string($_POST['typeAssurance'])."', '".mysql_escape_string($_POST['mntAssurance'])."', '".mysql_escape_string($_POST['objetPret'])."', 'null', '".mysql_escape_string($_POST['periodicite'])."' )";
	
	$rep = $db->exec($str);
	
    }catch( Exception $e)
	{
	    die('Erreur : ' .$e->getMessage() );
	}
}
    
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<title></title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
var availableTags = [
<?php


try
    {
         $reponse = $db->query("SELECT numCompte FROM compte ");
         while($donnees = $reponse->fetch())
           echo '"'.$donnees['numCompte'].'",';
         }
        catch(Exception $e){
          die('Erreur : ' .$e->getMessage());
     }

?>
""
];
$( "#tags" ).autocomplete({
source: availableTags
});
});
</script>
</head>
<body>
<script src="cal.js"></script>

<!--Calculer la constante et le sortir en meme temps pour le client: rembcste!-->
<div class="container">
      <div class="row">
         <header style="height: 100px" class="span12"></header>
         <div class="span2">
            <ul class="nav nav-list">
               <li class="nav-header">Liste personne</li>
                <li class="active"><a href="personnePhysique.php">Physique</a></li>
                <li class="active"><a href="personneMorale.php">Morale</a></li>
                <li class="active"><a href="personneInterne.php">Interne</a></li>
                <li class="nav-header">Liste operation</li>
                <li class="active"><a href="depot.php">D&eacute;pot</a></li>
                <li class="active"><a href="retrait.php">Retrait</a></li>
		<li class="nav-header">Liste pret</li>
                <li class="active"><a href="pret.php">Pret</a></li>
               <li class="active"><a href="verifierAppartenanceCompte.php">Verifier appartenance</a></li>
               <li class="active"><a href="verifierComptePret.php">Verifier compte</a></li>
               <li class="active"><a href="autoriserPret.php">Autoriser</a></li>
            </ul>
         </div>
         <div class="span10">
<form action="pret.php" method="post" >
    <p style="text-align: center">
        <center>
            <table>
		   
		    
		<tr>
                    <td><strong>Etat du pret : </strong></td>
                     <td>
			<select name="etatPret">
			    <option value="ATTENTE">ATTENTE</option>
			    <option value="ENCOURS">ENCOURS</option>
			    <option value="FIN">FIN</option>
			</select>
		     </td>
                </tr>
                
		<tr>
                        <td><strong>Nombre de payement : </strong></td>
                        <td><input type="text" name="duree" value="<?php if (isset($pret)) echo $pret->duree(); ?>" /></td>
                </tr>
	    
		<tr>
                    <td><strong>Periodicite : </strong></td>
                     <td>
			<select name="periodicite">
			    <option value="1">MENSUELLE</option>
			    <option value="3">TRIMESTRIELLE</option>
			    <option value="6">SEMESTRIELLE</option>
			</select>
		     </td>
                </tr>	
		        
                    <tr>
                        <td><strong>Frais de dossier : </strong></td>
                        <td><input type="file" name="fraisdossier" value="<?php if (isset($pret)) echo $pret->fraisdossier(); ?>" /></td>
                    </tr>
                        
                <?php if (isset($erreurs) && in_array(PRET::EMAILRSV_INVALIDE, $erreurs)) echo 'Email est invalide.<br />'; ?>
                    <tr>
                        <td><strong>Garantie: </strong></td>
                        <td><input type="text" name="garantiePret" value="<?php if (isset($pret)) echo $pret->garantiePret(); ?>" /></td>
                    </tr>
                   
                <?php if (isset($erreurs) && in_array(Reservation::NUMCARTE_INVALIDE, $erreurs)) echo 'Le numeros de carte est invalide.<br />'; ?>
                    <tr>
                        <td><strong>Login : </strong></td>
                        <td><input type="text" name="login" value="<?php if (isset($pret)) echo $pret->login(); ?>" /> </td><!--a recupere apres!-->
                    </tr>
                        
                <?php if (isset($erreurs) && in_array(Reservation::INFORSV_INVALIDE, $erreurs)) echo 'Information est invalide.<br />'; ?>
                    <tr>
                        <td><strong>Montant de l assurance</strong></td>
                        <td><input type="text" name="mntAssurance" value="<?php if (isset($pret)) echo $pret->mntAssurance(); ?>" /></td>
                    </tr>
                    
                    <tr>
                        <td><strong>Montant à emprunter : </strong></td>
                        <td><input type="text" name="mntPretD" value="<?php if (isset($pret)) echo $pret->mntPretD(); ?>" /></td> <!--mntPretF aussi!-->
                    </tr>
                    
                    <tr>
                        <td><strong>Objet du pret : </strong></td>
                        <td><input type="text" name="objetPret" value="<?php if (isset($pret)) echo $pret->numComptePret(); ?>" />
                    </tr>
                    
                    <tr>
                        <td >
                           <div >
			    <label for="tags"><strong>Numeros de compte: </strong></label>
			    </div>
			 </td>
			 <td >
			    <div >
			    <input id="tags" type="text" name="numComptePret" value="<?php if (isset($_POST['numCompte'])) echo $_POST['numCompte']; ?>" />
			    </div>
                        </td >
                    </tr>
                    
                    <tr>
                        <td><strong>Taux : </strong></td>
                        <td><input type="text" name="taux" value="<?php if (isset($pret)) echo $pret->taux(); ?>" />
                    </tr>
                    
                    <tr>
                        <td><strong>Type Assurance : </strong></td>
                        <td><input type="text" name="typeAssurance" value="<?php if (isset($pret)) echo $pret->typeAssurance(); ?>" />
                    </tr>
                    
                    <tr>
                        <td><strong>Type de compte : </strong></td>
                        <td>
			    <select name="typeCompte">
                                <?php
                                    try
                                    {
                                        $reponse = $db->query("SELECT idTypeCompte, libTypeCompte FROM type_compte");
                                        while($donnees = $reponse->fetch())
                                            echo '<option name="typeCompte" value="'.$donnees['idTypeCompte'].'">'.$donnees['libTypeCompte'].'</option>';
                                    }
                                    catch(Exception $e){
                                            die('Erreur : ' .$e->getMessage());
                                    }
                                ?>
                            </select>
			</td>
                    </tr>
		    <?php if (isset($erreurs) && in_array(Reservation::NOMRSV_INVALIDE, $erreurs)) echo 'Le nom est invalide.<br />'; ?>
                    <tr>
                        <td><strong>Commentaire : </strong></td>
                        <td><textarea name="commentaire" ></textarea></td>
                    </tr>
            </table>
        </center> 
            
        <center>
            <table>
                <tr>
                    <td><input type="submit" value="Valider le pret" name="valider"/></td>
                </tr>
            </table>
        </center>
    </p>  
</form>
</div>
</div>
</div>
</body>
</html>