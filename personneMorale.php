<?php
   require 'lib/autoload.inc.php';
   $db = DBFactory::getMysqlConnexionWithPDO();
   //$personne = new PersonneManager_PDO($db);
    
   if (isset($_POST['creation']))
   {
      $timeD = " 00:00:00";
      $timeF = " 23:59:59";
    
      $D = addslashes($_POST['creation']);
    
      $datexD=explode("/",$D);
    
      $jrD=$datexD[0];
      $moisD=$datexD[1];
      $anneD=$datexD[2];
    
      if(strlen($jrD)==1)$jrD='0'.$jrD;
      if(strlen($moisD)==1)$moisD='0'.$moisD;
    
      $D =$jrD.$moisD.$anneD;
    
      $dateD=formatJjmmaaaaTOaaaammjj($D).$timeD;
   }
   
   session_start();
   $_SESSION['moral'] = "M";
    
   if (isset($_POST['suivant']))
   {
      //$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
     
      
      $_SESSION['raison'] = $_POST['raison'];
      $_SESSION['sigle'] = $_POST['sigle'];
      $_SESSION['date'] = $dateD;
      $_SESSION['secteur'] = $_POST['secteur'];
      $_SESSION['adresse'] = $_POST['adresse'];
      $_SESSION['part'] = $_POST['part'];
      $_SESSION['detail'] = $_POST['detail'];
      $_SESSION['frais'] = $_POST['frais'];
      $_SESSION['doc'] = $_POST['doc'];
      $_SESSION['autre'] = $_POST['autre'];
      $_SESSION['ref'] = $_POST['ref'];
      $_SESSION['responsable'] = $_POST['responsable'];
      $_SESSION['adrResp'] = $_POST['adrResp'];
      $_SESSION['pays'] = $_POST['pays'];
      
      header('Location:compteMorale.php');
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
            <form class="form-horizontal" action="personneMorale.php" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Raison sociale</label>
                        <div class="controls">
                           <input type="text" placeholder="" name="raison">
                        </div>
                     </div>
                  </div>
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Sigle</label>
                        <div class="controls">
                           <input type="text" placeholder="" name="sigle">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Date de cr&eacute;ation</label>
                        <div class="controls">
                           <input type="text" name="naiss" style="cursor: pointer" size="10" onclick="new calendar(this);" value="" id="naiss" />
                        </div>
                     </div>
                  </div>
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Secteur d'activit&eacute;s</label>
                        <div class="controls">
                           <input type="text" placeholder="">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">D&eacute;tail secteur activit&eacute;</label>
                        <div class="controls">
                           <input type="text" placeholder="">
                        </div>
                     </div>
                  </div>
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Adresse</label>
                        <div class="controls">
                           <input type="text" placeholder="">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Frais adh&eacute;sion</label>
                        <div class="controls">
                           <input type="text" value="1000" readOnly placeholder="">
                        </div>
                     </div>
                  </div>
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Part sociale</label>
                        <div class="controls">
                           <input type="text" value="1000" readOnly placeholder="">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Document fourni</label>
                        <div class="controls">
                           <input type="file" placeholder="" name="documentF">
                        </div>
                     </div>  
                  </div>
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Autre document</label>
                        <div class="controls">
                           <input type="file" placeholder="" name="autreDoc">
                        </div>
                     </div>
                  </div>
               </div>               
               <div class="row">
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">R&eacute;f&eacute;rence document</label>
                        <div class="controls">
                           <input type="text" placeholder="">
                        </div>
                     </div>
                  </div>
                  <div class="span5">
                     <div class="control-group">
                        <label class="control-label" for="">Responsable</label>
                        <div class="controls">
                           <input type="text" placeholder="">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="control-group">
                  <label class="control-label" for="">Adresse responsable</label>
                  <div class="controls">
                     <input type="text" placeholder="">
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
