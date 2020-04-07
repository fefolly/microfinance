<?php
    class Pret
    {
        protected   $erreurs = array(),
                    $commentaire,
                    $dateAccordPret,
                    $dateDemande,
                    $duree,
                    $etatPret,
                    $fraisdossier,
                    $garantiePret,
                    $idPret,
                    $login,
                    $mnAssurance,
                    $mntPretD,
                    $mntPretF,
                    $mntComptePret,
                    $objetPret,
                    $periodicite,
                    $rembcste,
                    $taux,
                    $typeAssurance,
                    $typeCompte;
                    
    
        public function __construct($valeurs = array())
                    {
                        if (!empty($valeurs)) // Si on a spécifié des valeurs, alors on hydrate l'objet
                            $this->hydrate($valeurs);
                    }
        
        public function hydrate($donnees)
        {
            foreach ($donnees as $attribut => $valeur)
            {
                $methode = 'set'.ucfirst($attribut);
                if (is_callable(array($this, $methode)))
                {
                    $this->$methode($valeur);
                }
            }
        }
        
        public function isNew()
        {
            return empty($this->idPret);
        }
        
        public function isValid()
        {
            return !(empty($this->idPret) || empty($this->login) || empty($this->fraisdossier));
        }
        
        //GETTRES //
        
        public function erreurs()
        {
            return $this->erreurs;
        }
                    
        public function commentaire()
        {
            return $this->commentaire;
        }
        
        public function dateAccordPret()
        {
            return $this->dateAccordPret;
        }
        
        public function dateDemande()
        {
            return $this->dateDemande;
        }
        
        public function duree()
        {
            return $this->duree;
        }
        
        public function etatPret()
        {
            return $this->etaPret;
        }
        
        public function fraisdossier()
        {
            return $this->fraisdossier;
        }
        
        public function garantiePret()
        {
            return $this->garantiePret;
        }
        
        public function idPret()
        {
            return $this->idPret;
        }
        
        public function login()
        {
            return $this->login;
        }
        
        public function mntAssurance()
        {
            return $this->mntAssurance;
        }
        
        public function mntPretD()
        {
            return $thid->mntPresD;
        }
        
        public function mntPretF()
        {
            return $this->mntPretF;
        }
        
        public function numComptePret()
        {
            return $this->numComptePret;
        }
        
        public function objetPret()
        {
            return $this->objetPret;
        }
        
        public function periodicite()
        {
            return $this->periodicite;
        }
        
        public function rembcste()
        {
            return $this->rembcste;
        }
        
        public function taux()
        {
            return $this->taux;
        }
        
        public function typeAssurance()
        {
            return $this->typeAssurance;
        }
        
        public function typeCompte()
        {
            return $this->typeCompte;
        }
        
        //SETTERS //
                   
        public function setcommentaire($commentaire)
        {
            $this->commentaire = $commentaire;
        }
        
        public function setdateAccordPret($dateAccordPret)
        {
            $this->dateAccordPret = $dateAccordPret;
        }
        
        public function setdateDemande($dateDemande)
        {
            $this->dateDemande = $dateDemande;
        }
        
        public function setduree($duree)
        {
            $this->duree = $duree;
        }
        
        public function setetatPret($etatPret)
        {
            $this->etaPret = $etatPret;
        }
        
        public function setfraisdossier($fraisdossier)
        {
            $this->fraisdossier = $fraisdossier;
        }
        
        public function setgarantiePret($garantiePret)
        {
            $this->garantiePret = $garantiePret;
        }
        
        public function setidPret($idPret)
        {
            $this->idPret = $idPret;
        }
        
        public function setlogin($login)
        {
            $this->login = $login;
        }
        
        public function setmntAssurance($mntAssurrance)
        {
            $this->mntAssurance = $mntAssurance;
        }
        
        public function setmntPretD($mntPretD)
        {
            $thid->mntPresD = mntPresD;
        }
        
        public function setmntPretF($mntPretF)
        {
            $this->mntPretF = mntPretF;
        }
        
        public function setnumComptePret($numComptePret)
        {
            $this->numComptePret = $numComptePret;
        }
        
        public function setobjetPret($objetPret)
        {
            $this->objetPret = $objetPret;
        }
        
        public function setperiodicite($periodicite)
        {
            $this->periodicite = $periodicite;
        }
        
        public function setrembcste($rembcste)
        {
            $this->rembcste = $rembcste;
        }
        
        public function settaux($taux)
        {
            $this->taux = $taux;
        }
        
        public function settypeAssurance($typeAssurance)
        {
            $this->typeAssurance = $typeAssurance;
        }
        
        public function settypeCompte($typCompte)
        {
            $this->typeCompte = $typCompte;
        }
        
                     
                    
    }

?>