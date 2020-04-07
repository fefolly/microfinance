<?php
    class Depot
    {
        protected   $erreurs =  array(),
                    $idDepot,
                    $login,
                    $numCompte,
                    $dateDepot,
                    $mntDepot,
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
            return empty($this->idDepot);
        }
        
    /**
    * Méthode permettant de savoir si la news est valide
    * @return bool
    */
    
        public function isValid()
        {
            return !( empty($this->login) || empty($this->numCompte) || empty($this->mntDepot) || empty($this->commentaire) || empty($this->indication) );
        }
        
    // GETTERS //
    
        public function erreurs()
        {
            return $this->erreurs;
        }
        
        public function idDepot()
        {
            return $this->idDepot;
        }
        
        public function login()
        {
            return $this->login;
        }
        
        public function numCompte()
        {
            return $this->numCompte;
        }
        
        public function dateDepot()
        {
            return $this->dateDepot;
        }
        
        public function mntDepot()
        {
            return $this->mntDepot;
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
    
        public function setIdDepot($idDepot)
        {
            $this->idDepot = (int) $idDepot;
        }
        
        public function setLogin($login)
        {
            $this->login = $login;
        }
        
        public function setNumCompte($numCompte)
        {
            $this->numCompte = (int) $numCompte;
        }
        
        public function setDateDepot($dateDepot)
        {
            $this->dateDepot = $dateDepot;
        }
        
        public setMntDepot($mntDepot)
        {
            $this->mntDepot = $mntDepot;
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