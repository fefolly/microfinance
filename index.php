<?php
    require 'lib\autoload.inc.php';
    
    $db = DBFactory::getMysqlConnexionWithPDO();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title></title>
<link rel="stylesheet" type="text/css" href="layout.css" />
</head>

<body style="margin: auto;">
    <div id="middle">
    <a href="" id="ancre"></a>
    <center>
        <div style="margin-top: 100px">
            <?php
		if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion')
                {
   		    if ((isset($_POST['pseudo']) && !empty($_POST['pseudo'])) && (isset($_POST['password']) && !empty($_POST['password'])))
                    {
			try
                        {	
			    // on teste si une entrée de la base contient ce couple login / pass
			    
			    $reponse = $db->query('SELECT count(*) FROM profil WHERE nomProfil="'.($_POST['pseudo']).'"')->fetchColumn();
				
			    // si on obtient une réponse, alors l'utilisateur est un membre
			    
			    if ($reponse == 1)
			    {																
				$_SESSION['pseudo'] = $_POST['pseudo'];
				header('Location: connexion.php');
				exit();
			    }
			    
                            // si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
			    if ($reponse == 0)
			    {																
				$erreur [] = 'Compte non reconnu.';
			    }
			}   catch(Exception $e)
                            {
				die( 'Erreur : ' .$e->getMessage());
			    }
					
		    }
		    else
		    {
			$erreur [] = 'Au moins un des champs vide.';
		    }
                
      		    // sinon, alors la, il y a un gros problème 
		    
      		   /* else
                    {
         		$erreur [] = 'Problème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
      		    }*/
					
		    if(!empty($erreur))
                    {					
			foreach($erreur as $error)
			{
			    echo'<div class="error">'.$error.'</div>';
			}
		    } 
		}
	    ?>
        </div><br><br><br>
        <div>
            VOS PARAMETRES DE CONNEXION
        </div>
        <div class="login">
            <form action="index.php" method="post">
                <table>
                    <tr>
                        <td>Pseudo</td>
                        <td> <input style="height: 28px" type="text" name="pseudo" value="<?php if (isset($_POST['pseudo'])) echo htmlentities(trim($_POST['pseudo'])) ?>" /> </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td> <input style="height: 28px" type="password" name="password" /> </td>
                    </tr>
                    <tr class="thirdLine">
                        <td colspan="2"> <input type="submit" name="connexion" value="Connexion" style="box-shadow: 0px 2px 5px #1c1a19; text-align: right;" /> </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
</div>
</body>