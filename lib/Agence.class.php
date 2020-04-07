<?php
    class Agence
    {
        protected   $erreurs =  array(),
                    $bref,
                    $libAgence,
                    $adresseAgence,
                    $position;
                    
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
            return empty($this->numCompte);
        }
        
    /**
    * Méthode permettant de savoir si la news est valide
    * @return bool
    */
    
        public function isValid()
        {
            return !( empty($this->idPersonne) || empty($this->idTypeCompte) || empty($this->etatCompte) || empty($this->solde) || empty($this->premierversement) );
        }
        
    // GETTERS //
    
        public function erreurs()
        {
            return $this->erreurs;
        }
        
        public function numCompte()
        {
            return $this->numCompte;
        }
        
        public function idPersonne()
        {
            return $this->idPersonne;
        }
        
        public function idTypeCompte()
        {
            return $this->idTypeCompte;
        }
        
        public function etatCompte()
        {
            return $this->etatCompte;
        }
        
        public function dateCreation()
        {
            return $this->dateCreation;
        }
        
        public function solde()
        {
            return $this->solde;
        }
        
        public function premierversement()
        {
            return $this->premierversement;
        }
        
    // SETTERS //
    
        public function setNumCompte($numCompte)
        {
            $this->numCompte = (int) $numCompte;
        }
        
        public function setIdPersonne($idPersonne)
        {
            $this->idPersonne = (int) $idPersonne;
        }
        
        public function setIdTypeCompte($idTypeCompte)
        {
            $this->idTypeCompte = (int) $idTypeCompte;
        }
        
        public function setEtatCompte($etatCompte)
        {
            $this->etatCompte = $etatCompte;
        }
        
        public setDateCreation($dateCreation)
        {
            $this->dateCreation = $dateCreation;
        }
        
        public function setSolde($solde)
        {
            $this->solde = $solde;
        }
        
        public function setPremierversement($premierversement)
        {
            $this->premierversement = $premierversement;
        }
    }
?>