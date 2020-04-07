<?php
    require 'lib/autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    //$personne = new PersonneManager_PDO($db);

    session_start();
    
    
    if(isset($_POST['enregistrer']) && $_POST['enregistrer'] == 'Enregistrer')
    {
        try
        {
                
	    // on recherche si les memes informations existent deja
	    $_SESSION['login'] = $_POST['login'];
            $_SESSION['num'] = $_POST['num'];
            $_SESSION['montant'] = $_POST['montant'];
                
            $rep = $db->query("SELECT idPersonne FROM personne WHERE nomPersonne =  '{$_SESSION['login']}' ")->fetch();
            $reponse = $db->query("SELECT count(*) FROM personne WHERE nomPersonne='{$_SESSION['login']}' ")->fetchColumn();
            $reponse1 = $db->query("SELECT count(*) FROM compte,personne WHERE personne.idPersonne = compte.idPersonne
				    AND personne.idPersonne = '{$rep['idPersonne']}' AND compte.numCompte='{$_SESSION['num']}' ")->fetchColumn();
            
            if ($reponse1 == 1)
            {
	        $iden = $db->query('SELECT * FROM retrait ORDER BY idRetrait DESC LIMIT 1 ')->fetchColumn();
	
		$repMontant = $db->query("SELECT mntDepot FROM compte,depot,personne WHERE personne.idPersonne = compte.idPersonne
                                         AND personne.nomPersonne = depot.login AND personne.nomPersonne = '{$_SESSION['login']}'
                                         AND compte.numCompte='{$_SESSION['num']}' ")->fetch();
		var_dump ($repMontant);
                $restMontant = $repMontant['mntDepot'] - $_SESSION['montant'];
                echo $restMontant;
		//Fonction pour l'identifiant
		//Tout ceci peut etre mis en fonction
		    //$id = "CLTI-iai-0048248"; //l'id du derniere enregistrement
		    //echo "l'id recu est: ", $id;
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
		    
		     $j= 'P';
		    $iden[3] = $j;
                        
		    $str = " INSERT INTO retrait VALUES ( '$iden', '".mysql_escape_string($_POST['login'])."', '".mysql_escape_string($_POST['num'])."', NOW(),
                            '".mysql_escape_string($_SESSION['montant'])."', '".mysql_escape_string($_POST['commentaire'])."', '".mysql_escape_string($_POST['indication'])."' )";
    
    		    $rep = $db->exec($str);
                    
                    $str1 = $db->query("SELECT idDepot FROM compte,depot,personne WHERE personne.idPersonne = compte.idPersonne AND personne.nomPersonne = depot.login
                                        AND personne.nomPersonne = '{$_SESSION['login']}' AND compte.numCompte='{$_SESSION['num']}' ")->fetch();
                    var_dump($str1['idDepot']);
                    $str2 = $db->exec("UPDATE depot,personne,compte SET mntDepot = '{$restMontant}' WHERE idDepot = '{$str1['idDepot']}'
                                        AND personne.nomPersonne = depot.login AND personne.nomPersonne = '{$_SESSION['login']}' AND compte.numCompte='{$_SESSION['num']}' ");
                
                    //$rep2 = $db->exec($str2);
                    
                    //echo '<strong style="color:#0e63fc ">Enrégistrement r&eacute;ussi !</strong>';
                    //echo '<br><br>';
            }
            elseif ($reponse1 == 0)
            {
                echo 'error';
            }
                 
        }   catch( Exception $e )
            {
                die( 'Erreur : ' .$e->getMessage() );
	    }
        
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css.css" rel="stylesheet" type="text/css">
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
	    <form class="form-horizontal" action="retrait.php" method="post" >
		<div class="row">
		    <div class="span5">
			<div class="control-group">
			    <label class="control-label" for="">Login</label>
			    <div class="controls">
				<input type="text" placeholder="" name="login">
			    </div>
			</div>
		    </div>
		    <div class="span5">
			<div class="control-group">
			    <label class="control-label" for="">Num&eacute;ro compte</label>
			    <div class="controls">
				<input type="text" placeholder="" name="num">
			    </div>
			</div>
		    </div>
		</div>
		<div class="row">
		    <div class="span5">
			<div class="control-group">
			    <label class="control-label" for="">Date retrait</label>
			    <div class="controls">
				<input type="text" placeholder="" name="date">
			    </div>
			</div>
		    </div>
		    <div class="span5">
			<div class="control-group">
			    <label class="control-label" for="">Montant retrait</label>
			    <div class="controls">
				<input type="text" placeholder="" name="montant">
			    </div>
			</div>
		    </div>
		</div>
		<div class="row">
		    <div class="span5">
			<div class="control-group">
			    <label class="control-label" for="">Commentaire</label>
			    <div class="controls">
				<textarea rows="3" name="commentaire" style="max-height: 90px; max-width: 210px; min-height: 90px; min-width: 210px"></textarea>
			    </div>
			</div>
		    </div>
		    <div class="span5">
			<div class="control-group">
			    <label class="control-label" for="">Indication</label>
			    <div class="controls">
				<input type="text" placeholder="" name="indication">
			    </div>
			</div>
		    </div>
		</div>
		    <button class="btn btn-primary pull-right" type="submit" name="enregistrer"/>Enregistrer</button>
	    </form>
	</div>
    </div>
</body>
</html>