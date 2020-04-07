<?php
    require 'lib/autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    
session_start();

$reponse = $db->query("SELECT * FROM pret WHERE etatPret='ATTENTE' ");
        
	
if(isset($_POST['autoriser']) && $_POST['autoriser'] == 'Autoriser' )
{
    $modif = "ENCOURS";
    try{

	//$str = "INSERT INTO personne VALUES ( '$modif')";
	$str ="UPDATE pret SET etatPret ='{$modif}' WHERE etatPret ='ATTENTE' AND idPret='VV-LME-P-0000003' ";
    
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
<title>Autoriser un Pret</title>
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
         $ponse = $db->query("SELECT idPret FROM pret WHERE etatPret='ATTENTE'");
         while($data = $ponse->fetch())
           echo '"'.$data['idPret'].'",';
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
<form action="#" method="post" >
    <p style="text-align: center">
        <center>
            <table>
                
                    <tr>
                        <td >
                           <div class="ui-widget">
			    <label for="tags">Numeros de compte: </label>
			    </div>
			 </td>
			 <td >
			    <div class="ui-widget">
			    <input id="tags" style="height: 32px; border-radius: 5px 5px 5px 5px" type="text" name="idPret" value="<?php if (isset($_POST['idPret'])) echo $_POST['idPret']; ?>" />
			    </div>
                        </td >
                    </tr>
                        
                 
                   
            </table>
        </center> 
            
        <center>
            <table>
                <tr>
                    <td><input type="submit" value="Autoriser" name="autoriser"/></td>
                </tr>
            </table>
        </center>
    </p>  
</form>



<center><h1 style="color:  #184c88 " >Liste des demandes de pret: </h1></center></br>
<table border=" 3px outset" style="border: medium">
            <tr bgcolor="#2780bc"><th style="border: medium">Numeros du pret</th><th style="border: medium">Objet du pret</th><th style="border: medium">Date de demande</th><th style="border: medium">Dur&eacute;e</th><th style="border: medium">Garanti</th><th style="border: medium">Montant de l'assurance</th><th style="border: medium">Montant demand&eacute</th><th style="border: medium">Periodicite</th><th style="border: medium">Taux</th><th style="border: medium">Type Assurance</th><th style="border: medium">Type de compte</th></tr>    
            <?php
		    $compte = 1;
					    while($donnees = $reponse->fetch())
					    { 
						if($donnees['typeCompte'] == "EL")
						{
						    $type = "EPARGNE";
						}
							     echo '<tr><td ">'.$donnees['idPret'].'</td><td >'.$donnees['objetPret'].'</td><td >'.$donnees['dateDemande'].'</td><td >'.$donnees['duree'].'</td><td >'.$donnees['garantiePret'].'</td><td >'.$donnees['mntAssurance'].'</td><td >'.$donnees['mntPretD'].'</td><td >'.$donnees['periodicite'].'</td><td >'.$donnees['taux'].'</td><td >'.$donnees['typeAssurance'].'</td><td >',$type,'</td></tr></br>'; 
					
					}
	    
?>
      </tr>
    </table>



</body>
</div>
</div>
</div>
</html>