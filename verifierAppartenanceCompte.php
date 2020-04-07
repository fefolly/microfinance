<?php
    require 'lib/autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    //$personne = new PersonneManager_PDO($db);

    session_start();
            
         if(isset($_POST['verifier'] ) && $_POST['verifier'] == 'Verifier' )
	 {
	    try{
		
		if(!empty($_POST['numCompte']) )
		{
		    $id = $db->query("SELECT idPersonne FROM compte WHERE numCompte='{$_POST['numCompte']}' ")->fetchColumn();
		
		    $per = $db->query("SELECT nomPersonne FROM personne WHERE idPersonne='{$id}' ")->fetchColumn(); 
                //var_dump($per);
                  
		    $pre = $db->query("SELECT prenomPersonne FROM personne WHERE idPersonne='{$id}' ")->fetchColumn(); 
                //var_dump($pre);
                
                        echo "<script>alert('Le compte est au nom de ",$per," ",$pre,". ');</script>";
                
                }
                else
                    echo "<script>alert('Veuillez saisir le numeros du compte SVP');</script>";
		
		
		
	    } catch( Exception $e )
		{
		    die( 'Erreur : ' .$e->getMessage() );
		}
	    
	    
	 }
	 
	
	    
	    
	    
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Verifier appartenance de compte</title>
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
			    <input id="tags" type="text" name="numCompte" value="<?php if (isset($_POST['numCompte'])) echo $_POST['numCompte']; ?>" />
			    </div>
                        </td >
                    </tr>
                        
                 
                   
            </table>
        </center> 
            
        <center>
            <table>
                <tr>
                    <td><input type="submit" value="Verifier" name="verifier"/></td>
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