<?php
    class Retrait
    {
        protected   $erreurs =  array(),
                    $idRetrait,
                    $login,
                    $numCompte,
                    $dateRetrait,
                    $mntRetrait,
                    $commentaire,
                    $indication;
                    
    /**
    * Constructeur de la classe qui assigne les données spécifiées en
    paramètre aux attributs correspondants
    * @param $valeurs array Les valeurs à assigner
    * @return void
    */
    
        public function __construct($valeurs = array())
        {
            if (!empty($valeurs)) // Si on a spécifié des valeurs, alors on hydrate l'objet
                $this->hydrate($valeurs);
        }
        
    /**
    * Méthode assignant les valeurs spécifiées aux attributs
    correspondant
    * @param $donnees array Les données à assigner
    * @return void
    */
    
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
        
    /**
    * Méthode permettant de savoir si la news est nouvelle
    * @return bool
    */
    
        public function isNew()
        {
            return empty($this->idRetrait);
        }
        
    /**
    * Méthode permettant de savoir si la news est valide
    * @return bool
    */
    
        public function isValid()
        {
            return !( empty($this->login) || empty($this->numCompte) || empty($this->mntRetrait) || empty($this->commentaire) || empty($this->indication) );
        }
        
    // GETTERS //
    
        public function erreurs()
        {
            return $this->erreurs;
        }
        
        public function idRetrait()
        {
            return $this->idRetrait;
        }
        
        public function login()
        {
            return $this->login;
        }
        
        public function numCompte()
        {
            return $this->numCompte;
        }
        
        public function dateRetrait()
        {
            return $this->dateRetrait;
        }
        
        public function mntRetrait()
        {
            return $this->mntRetrait;
        }
        
        public function commentaire()
        {
            return $this->solde;
        }
        
        public function indication()
        {
            return $this->indication;
        }
        
    // SETTERS //
    
        public function setIdRetrait($idRetrait)
        {
            $this->idRetrait = (int) $idRetrait;
        }
        
        public function setLogin($login)
        {
            $this->login = $login;
        }
        
        public function setNumCompte($numCompte)
        {
            $this->numCompte = (int) $numCompte;
        }
        
        public function setDateRetrait($dateRetrait)
        {
            $this->dateRetrait = $dateRetrait;
        }
        
        public setMntRetrait($mntRetrait)
        {
            $this->mntRetrait = $mnRetrait;
        }
        
        public function setCommentaire($commentaire)
        {
            $this->commentaire = $commentaire;
        }
        
        public function setIndication($indication)
        {
            $this->indication = $indication;
        }
    }
?>