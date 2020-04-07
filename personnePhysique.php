<?php
    require 'lib/autoload.inc.php';
    $db = DBFactory::getMysqlConnexionWithPDO();
    //$personne = new PersonneManager_PDO($db);
    if(isset($_SESSION['retour'])) $r = $_SESSION['retour'];
    if (isset($_POST['naiss']))
    {
        $timeD = " 00:00:00";
	$timeF = " 23:59:59";
    
	$D = addslashes($_POST['naiss']);
    
	$datexD=explode("/",$D);
    
	$jrD=$datexD[0];
	$moisD=$datexD[1];
	$anneD=$datexD[2];
    
	if(strlen($jrD)==1)$jrD='0'.$jrD;
	if(strlen($moisD)==1)$moisD='0'.$moisD;
    
	$D =$jrD.$moisD.$anneD;
    
	$dateD=formatJjmmaaaaTOaaaammjj($D).$timeD;
    }

    if (isset($_POST['suivant']))
    {
	/*$ListeExtension = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg');
        $ListeExtensionIE = array('jpg' => 'image/pjpeg', 'jpeg'=>'image/pjpeg');
        if(isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
	{
                            if($_FILES['photo']['error'] <=0)
			    {
                                if($_FILES['photo']['size'] <= 2097152)
				{
                                    $photo = $_FILES['photo']['name'];
                                    $ExtensionPresumee = explode('.',$photo);
                                    $ExtensionPresumee = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);
                                    if($ExtensionPresumee == 'jpg' || $ExtensionPresumee == 'jpeg')
				    {
                                        $photo = getimagesize($_FILES['photo']['tmp_name']);
                                        $NomImageExploitable;
                                        //taille 90*90
                                        if($photo['mime'] == $ListeExtension[$ExtensionPresumee] || $photo['mime'] == $ListeExtensionIE[$ExtensionPresumee])
					{
                                            $ImageChoisie = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
                                            $TailleImageChoisie = getimagesize($_FILES['photo']['tmp_name']);
                                            $NouvelleLargeur = 90;
                                            $NouvelleHauteur = 90;
                                            
                                            $NouvelleImage = imagecreatetruecolor($NouvelleLargeur, $NouvelleHauteur) or die  ("Erreur");
                                            
                                            imagecopyresampled($NouvelleImage, $ImageChoisie, 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur,$TailleImageChoisie[0],$TailleImageChoisie[1]);
                                            imagedestroy($ImageChoisie);
                                            
                                            $NomImageExploitable = time();
                                            
                                            imagejpeg($NouvelleImage,'upload/'.$NomImageExploitable.'.'.$ExtensionPresumee,100);
                                            
                                            $LienPhoto = 'upload/'.$NomImageExploitable.'.'.$ExtensionPresumee;
                                        }
				    }
				}
			    }
	}*/
	$ListeExtension = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg');
        $ListeExtensionIE = array('jpg' => 'image/pjpeg', 'jpeg'=>'image/pjpeg');
        if(isset($_FILES['photo']) && !empty($_FILES['photo']['name']))
	{
            if($_FILES['photo']['error'] <=0)
	    {
                if($_FILES['photo']['size'] <= 2097152)
	    	{
                    $photo = $_FILES['photo']['name'];
                    $ExtensionPresumee = explode('.',$photo);
                    $ExtensionPresumee = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);
                    if($ExtensionPresumee == 'jpg' || $ExtensionPresumee == 'jpeg')
		    {
                        $photo = getimagesize($_FILES['photo']['tmp_name']);
                        $NomImageExploitable;
			if($photo['mime'] == $ListeExtension[$ExtensionPresumee] || $photo['mime'] == $ListeExtensionIE[$ExtensionPresumee])
			{
                            $ImageChoisie = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
                            $TailleImageChoisie = getimagesize($_FILES['photo']['tmp_name']);
                                            
                            //$NomImageChoisie = explode('.',$photo);
                                            
                            imagejpeg($ImageChoisie,'upload/'.$NomImageExploitable.'.'.$ExtensionPresumee,100);
                            imagedestroy($ImageChoisie);
			    $LienPhoto = 'upload/'.$NomImageExploitable.'.'.$ExtensionPresumee;
                        }
		    }
		}
	    }
	}
	
	$ListeExtension1 = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg');
        $ListeExtensionIE1 = array('jpg' => 'image/pjpeg', 'jpeg'=>'image/pjpeg');
        if(isset($_FILES['signature']) && !empty($_FILES['signature']['name']))
	{
            if($_FILES['signature']['error'] <=0)
    	    {
                if($_FILES['signature']['size'] <= 2097152)
		{
                    $signature = $_FILES['signature']['name'];
                    $ExtensionPresumee1 = explode('.',$signature);
                    $ExtensionPresumee1 = strtolower($ExtensionPresumee1[count($ExtensionPresumee1)-1]);
                    if($ExtensionPresumee1 == 'jpg' || $ExtensionPresumee1 == 'jpeg')
		    {
                        $signature = getimagesize($_FILES['signature']['tmp_name']);
                        $NomImageExploitable1;
			if($signature['mime'] == $ListeExtension1[$ExtensionPresumee1] || $signature['mime'] == $ListeExtensionIE1[$ExtensionPresumee1])
			{
			    $ImageChoisie1 = imagecreatefromjpeg($_FILES['signature']['tmp_name']);
			    $TailleImageChoisie1 = getimagesize($_FILES['signature']['tmp_name']);
							    
			    //$NomImageChoisie = explode('.',$photo);
							    
			    imagejpeg($ImageChoisie1,'upload/'.$NomImageExploitable1.'.'.$ExtensionPresumee1,100);
			    imagedestroy($ImageChoisie1);
			    $LienSignature = 'upload/'.$NomImageExploitable1.'.'.$ExtensionPresumee1;
			}
		    }
		}
	    }
	}
					
                                        //taille 90*90
                                       /* if($signature['mime'] == $ListeExtension1[$ExtensionPresumee1] || $photo['mime'] == $ListeExtensionIE1[$ExtensionPresumee1])
					{
                                            $ImageChoisie1 = imagecreatefromjpeg($_FILES['signature']['tmp_name']);
                                            $TailleImageChoisie1 = getimagesize($_FILES['signature']['tmp_name']);
                                            $NouvelleLargeur1 = 90;
                                            $NouvelleHauteur1 = 90;
                                            
                                            $NouvelleImage1 = imagecreatetruecolor($NouvelleLargeur1, $NouvelleHauteur1) or die  ("Erreur");
                                            
                                            imagecopyresampled($NouvelleImage1, $ImageChoisie1, 0,0, 0,0, $NouvelleLargeur1, $NouvelleHauteur1,$TailleImageChoisie1[0],$TailleImageChoisie1[1]);
                                            imagedestroy($ImageChoisie1);
                                            
                                            $NomImageExploitable1 = time();
                                            
                                            imagejpeg($NouvelleImage1,'upload/'.$NomImageExploitable1.'.'.$ExtensionPresumee1,100);
                                            
                                            $LienSignature = 'upload/'.$NomImageExploitable1.'.'.$ExtensionPresumee1;
                                        }
				    }
				}
			    }
	}*/
	
        //$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
        
        session_start();
	
        $_SESSION['nom'] = $_POST['nom'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['date'] = $dateD;
        $_SESSION['sexe'] = $_POST['sexe'];
        $_SESSION['adresse'] = $_POST['adresse'];
        $_SESSION['part'] = $_POST['part'];
        $_SESSION['photo'] = isset($LienPhoto);
        $_SESSION['fonction'] = $_POST['fonction'];
        $_SESSION['frais'] = $_POST['frais'];
        $_SESSION['signature'] = isset($LienSignature);
        $_SESSION['piece'] = $_POST['piece'];
        $_SESSION['mere'] = $_POST['mere'];
        $_SESSION['reference'] = $_POST['reference'];
        $_SESSION['responsable'] = $_POST['responsable'];
        $_SESSION['adrResp'] = $_POST['adrResp'];
        $_SESSION['detail'] = $_POST['detail'];
        $_SESSION['autPiece'] = $_POST['autPiece'];
        $_SESSION['pays'] = $_POST['pays'];
        $_SESSION['categorie'] = $_POST['categorie'];
        
        header('Location:compte.php');
        exit();
    }
?>

<!DOCTYPE HTML>
<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="cal.css" media="screen" />
</head>
<body>
    <script src="cal.js"></script>
    
    <?php
	function formatJjmmaaaaTOaaaammjj($d)
        {
	    $d2=substr($d,4,4).'-'.substr($d,2,2).'-'.substr($d,0,2);
	    return $d2;
        }
    ?>
    
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
                <form class="form-horizontal" action="personnePhysique.php" method="post" enctype="multipart/form-data">
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Nom personne</label>
			       <div class="controls">
				  <input type="text" name="nom" placeholder="">
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Pr&eacute;noms personne</label>
				<div class="controls">
				   <input type="text" name="prenom" placeholder="">
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
				<label class="control-label">Date de naissance</label>
				<div class="controls">
				   <input type="text" name="naiss" style="cursor: pointer" size="10" onclick="new calendar(this);" value="" id="naiss" />
				</div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Sexe</label>
				<!--<label>Select</label>!-->
				<div class="controls">
				    <select name="sexe">
				      <option value="M">Masculin</option>
				      <option value="F">Feminin</option>
				    </select>
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Adresse</label>
			       <div class="controls">
				  <input type="text" name="adresse" placeholder="">
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Fonction personne</label>
				<div class="controls">
				    <select name="fonction">
					<?php
					    try
					    {
						$reponse = $db->query('SELECT * FROM profession');
						
						while($donnees = $reponse->fetch())                                    
						    echo '<option value="'.$donnees['libProfession'].'">'.$donnees['libProfession'].'</option>';
							
					    }   catch(Exception $e)
						{
						    die( 'Erreur : ' .$e->getMessage() );
						}
					?>
				    </select>
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Part sociale</label>
				<div class="controls">
				    <input type="text" name="part" value="1000" readOnly placeholder="">
				</div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Frais adh&eacute;sion</label>
				<div class="controls">
				    <input type="text" name="frais" value="1000" readOnly placeholder="">
				</div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Pi&egrave;ce</label>
			       <div class="controls">
				    <select name="piece">
					<?php
					    try
					    {
						$reponse = $db->query('SELECT * FROM piece');
						
						while($donnees = $reponse->fetch())                                    
						    echo '<option value="'.$donnees['idPiece'].'">'.$donnees['libPiece'].'</option>';
							
					    }   catch(Exception $e)
						{
						    die( 'Erreur : ' .$e->getMessage() );
						}
					?>
				    </select>
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Nom de la m&egrave;re</label>
			       <div class="controls">
				  <input type="text" name="mere" placeholder="">
			       </div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">R&eacute;f&eacute;rence de la pi&egrave;ce</label>
			       <div class="controls">
				  <input type="text" name="reference" placeholder="">
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Responsable</label>
			       <div class="controls">
				  <input type="text" name="responsable" placeholder="">
			       </div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Photo de la personne</label>
			       <div class="controls">
				  <input type="file" name="photo" placeholder="">
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Signature</label>
				<div class="controls">
				   <input type="file" name="signature" placeholder="">
				</div>
			    </div>
			</div>
                    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Adresse responsable</label>
			       <div class="controls">
				  <input type="text" name="adrResp" placeholder="">
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Date inscription</label>
			       <div class="controls">
				  <input type="text" name="dateInscri" placeholder="">
			       </div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">D&eacute;tail profession</label>
			       <div class="controls">
				  <input type="text" name="detail" placeholder="">
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Autre pi&egrave;ce</label>
			       <div class="controls">
				  <input type="text" name="autPiece" placeholder="">
			       </div>
			    </div>
			</div>
		    </div>
		    <div class="row">
			<div class="span5">
			    <div class="control-group">
				<label class="control-label" for="">Pays d'origine</label>
				<div class="controls">
				    <select name="pays" id="pays">
					<?php $tab = array("Afrique du sud","Algerie","Allemagne","Angola","Belgique","Benin","Botswana","Burkina Faso","Burundi","Cameroun","Canada","Cap Vert","Chine","Congo","Cote d'Ivoire","Djibouti",
							    "Egypte","Etats-Unis","France","Gabon","Gambie","Ghana","Guine-Bissau","Israel","Italie","Japon","Libye","Mali","Maroc","Niger","Nigeria","Senegal","Tchad",
							    "Togo","Tunisia");
					    foreach($tab as $pays){
					?>
					    <option value="<?php echo $pays?>" <?php if(isset($_POST['pays']) && ($_POST['pays'] == $pays)) echo 'selected'; ?>><?php echo $pays ?></option>
					<?php
					    }
					?>
				    </select>
			       </div>
			    </div>
			</div>
			<div class="span5">
			    <div class="control-group">
			       <label class="control-label" for="">Categorie personne</label>
			       <div class="controls">
				    <select name="categorie">
					<?php
					    try
					    {
						$reponse = $db->query('SELECT * FROM categorie_personne');
						
						while($donnees = $reponse->fetch())                                    
						    echo '<option value="'.$donnees['numCategoriePerson'].'">'.$donnees['libCategoriePerson'].'</option>';
							
					    }   catch(Exception $e)
						{
						    die( 'Erreur : ' .$e->getMessage() );
						}
					?>
				    </select>
				</div>
			    </div>
			</div>
		    </div>
                    <br/>
		    <button class="btn btn-primary pull-right" type="submit" name="suivant">Suivant</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
