<?php
    require 'lib/autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    $personne = new PersonneManager_PDO($db);

    session_start();
    
    if (isset($_POST['retour']))
    {
	header('Location:personnePhysique.php');
        exit();
    }
    
    if(isset($_POST['enregistrer']))
    {
        try
        {
                
	    // on recherche si les memes informations existent deja
	    $reponse = $db->query("SELECT count(*) FROM personne WHERE nomPersonne='{$_SESSION['nom']}'
                                    and prenomPersonne='{$_SESSION['prenom']}' ")->fetchColumn();
            //var_dump($reponse);
	    if ($reponse == 0)
            {
                //$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
                
		$iden = $db->query('SELECT * FROM personne ORDER BY idPersonne DESC LIMIT 1 ')->fetchColumn();
		    //var_dump($iden);
		$iden1 = $db->query('SELECT * FROM compte ORDER BY numCompte DESC LIMIT 1 ')->fetchColumn();   
		    
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
                if( isset($_SESSION['moral']))
                {
                $j= 'M';
                $iden[3] = $j;
                }
                else
                {
                 $j= 'P';
                $iden[3] = $j;
               // echo $iden;
                }
            
                //echo $iden,'</br>'; 
                
                // pour compte
                $nono = "0000000";
                
                
                //récupération de la partie chiffre 
                $e = 0;
                $a = (strlen($iden1)-7);
                //$a = 9;
                while ($e <= 6)
                {
                    $nono[$i] = $iden1[$a];
                    $e++;
                    $a++;
                    //echo' </br>';
                }
           
                $nono++; //incrémentation de la partie chiffre
             
                $nono = (string) $nono; //conversion en string
                $t = strlen($nono)-1;
                $o = strlen($iden1)-1;
                
                if($t > 6)
                {
                    echo"Le nombre d'enregistrement prévu est atteint. </br>";
                    echo"Veillez à contacter le developpeur. Merci </br>";
                }
            
                //modification de l'id
                while($t >= 0)
                {
                    $iden1[$o] = $nono[$t];
                    $o--;
                    $t--;
                }
                //echo $iden1;
            
                // il va falloir mettre en plus les includes et si possible ajouter bootstrap 
        
                //if( isset($_SESSION['moral']))
                //{
		    /*$_SESSION['premier'] = $_POST['premier'];
		    $_SESSION['part'] = $_POST['part'];
		    $_SESSION['frais'] = $_POST['frais'];
		    $solde = $_SESSION['premier']-($_SESSION['part'] + $_SESSION['frais']);
		    $_SESSION['solde'] = $solde;*/
                    //echo $_SESSION['moral'];
                    //$str = 'INSERT INTO personne';
                    /*$str = "INSERT INTO personne VALUES ( '$iden', '".mysql_escape_string($_SESSION['raison'])."', '".mysql_escape_string($_SESSION['sigle'])."', '".mysql_escape_string($_SESSION['date'])."', 'null',
                                    '".mysql_escape_string($_SESSION['adresse'])."', '".mysql_escape_string($_SESSION['part'])."', 'null', 'null', '".mysql_escape_string($_SESSION['frais'])."',
                                    'null', 'null', 'null', 'null', 'null', 'null', NOW(), 'null', 'null', '".mysql_escape_string($_SESSION['pays'])."', 'null' )";
                                    
                    $rep = $db->exec($str);
                        
                    //$str = 'INSERT INTO personne';
                    $str = "INSERT INTO compte VALUES ( '$iden1', '$iden', '".mysql_escape_string($_POST['type'])."', 'null', NOW(),
                            '$solde', '".mysql_escape_string($_POST['premier'])."' )";
                                    
                    $rep = $db->exec($str);
                }   else
                    {*/
                        $_SESSION['premier'] = $_POST['premier'];
			$_SESSION['part'] = $_POST['part'];
			$_SESSION['frais'] = $_POST['frais'];
			$solde = $_SESSION['premier']-($_SESSION['part'] + $_SESSION['frais']);    
                        //$str = 'INSERT INTO personne';
                        $str1 = "INSERT INTO personne VALUES ( '$iden', '".mysql_escape_string($_SESSION['nom'])."', '".mysql_escape_string($_SESSION['prenom'])."', '".mysql_escape_string($_SESSION['date'])."', '".mysql_escape_string($_SESSION['sexe'])."',
                                '".mysql_escape_string($_SESSION['adresse'])."', '".mysql_escape_string($_SESSION['part'])."', '".mysql_escape_string($_SESSION['photo'])."', '".mysql_escape_string($_SESSION['fonction'])."', '".mysql_escape_string($_SESSION['frais'])."',
                                '".mysql_escape_string($_SESSION['signature'])."', '".mysql_escape_string($_SESSION['piece'])."', '".mysql_escape_string($_SESSION['mere'])."', '".mysql_escape_string($_SESSION['reference'])."', '".mysql_escape_string($_SESSION['responsable'])."', '".mysql_escape_string($_SESSION['adrResp'])."', NOW(), '".mysql_escape_string($_SESSION['detail'])."',
				'".mysql_escape_string($_SESSION['autPiece'])."', '".mysql_escape_string($_SESSION['pays'])."', '".mysql_escape_string($_SESSION['categorie'])."' )";
                                    
                        $rep1 = $db->exec($str1);
                        
                        $str2 = "INSERT INTO compte VALUES ( '$iden1', '$iden', '".mysql_escape_string($_POST['type'])."', 'null', NOW(),
                                '$solde', '".mysql_escape_string($_POST['premier'])."' )";
                                    
                        $rep2 = $db->exec($str2);
                    //} 
            }
                    echo '<center><strong style="color:#0e63fc ">Enrégistrement r&eacute;ussi !</strong></center>';
                    echo '<br><br>';
		    $_SESSION['iden'] = $iden;
		    /*$i = (int) $iden;
		    $p = $personne->getUnique($iden);
		    var_dump ($p);
		    echo '<img src="'.$p->photoPersonne().'" width=90px height=90px>';*/
                ?>
		
		<?php
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
                <form class="form-horizontal" action="compte.php" method="post" enctype="multipart/form-data">
		    <div class="row">
			<div class="span5">
			    <?php
				if(isset($_SESSION['iden']))
				{
				    $i = (int) $_SESSION['iden'];
				    $p = $personne->getUnique($_SESSION['iden']);
				    //var_dump ($p);
				    echo '<img src="'.$p->photoPersonne().'" width=90px height=90px>';
				}
			    ?>
			</div>
			<div class="span5">
			    <?php
				if(isset($_SESSION['iden']))
				{
				    $i = (int) $_SESSION['iden'];
				    $p = $personne->getUnique($_SESSION['iden']);
				    //var_dump ($p);
				    echo '<img src="'.$p->signature().'" width=90px height=90px>';
				}
			    ?>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Type de compte</label>
				<div class="controls">
				    <select name="type">
					<?php
					    try
					    {
						$reponse = $db->query("SELECT idTypeCompte, libTypeCompte FROM type_compte");
						while($donnees = $reponse->fetch())
						    echo '<option value="'.$donnees['idTypeCompte'].'">'.$donnees['libTypeCompte'].'</option>';
					    }
					    catch(Exception $e){
						    die('Erreur : ' .$e->getMessage());
					    }
					?>
				    </select>
				</div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Numero de compte</label>
				<div class="controls">
				    <input type="text" name="numero" readOnly="readOnly">
				</div>
			    </div>
			</div>
		    </div>
                    <div class="row">
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Nom</label>
			       <div class="controls">
				  <input type="text" name="nom" placeholder="" value="<?php echo $_SESSION['nom']; ?>" readOnly>
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Prenoms</label>
			       <div class="controls">
				  <input type="text" name="prenom" placeholder="" value="<?php echo $_SESSION['prenom']; ?>" readOnly>
			       </div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Frais adh&eacute;sion</label>
				<div class="controls">
				    <input type="text" name="frais" value="1000" readonly placeholder="">
				</div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Part Sociale</label>
			       <div class="controls">
				  <input type="text" name="part" value="1000" readonly placeholder="">
			       </div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Premier versement</label>
			       <div class="controls">
				  <input type="text" name="premier" placeholder="">
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Solde du compte</label>
			       <div class="controls">
				  <input type="text" name="solde" placeholder=""
					 value="<?php
						    if (isset($_POST['premier']))
						    {
							$_SESSION['premier'] = $_POST['premier'];
							$_SESSION['part'] = $_POST['part'];
							$_SESSION['frais'] = $_POST['frais'];
							$solde = $_SESSION['premier']-($_SESSION['part'] + $_SESSION['frais']);
							echo $solde;
						    }
						?>" readOnly>
						    
			       </div>
			    </div>
			</div>
		    </div>
		    <div class="control-group">
                       <label class="control-label" for="">Reference</label>
                       <div class="controls">
                          <input type="text" name="ref" placeholder="">
                       </div>
                    </div>
                    <div class="controls"><br/>
                     <button class="btn btn-primary" type="submit" name="retour">Retour</button>
                     <button class="btn btn-primary pull-right" type="submit" value="" name="enregistrer">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
