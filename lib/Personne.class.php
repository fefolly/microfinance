<?php
    class Personne
    {
        protected   $erreurs = array(),
                    $adresse,
                    $adresseResponsable,
                    $autrepiece,
                    $categorie_personne,
                    $dateInscription,
                    $dateNaiss,
                    $detailsurprofession,
                    $fonctionPersonne,
                    $fraisAdhesion,
                    $idPersonne,
                    $nomMere,
                    $nomPersonne,
                    $partSocial,
                    $paysOrigine,
                    $photoPersonne,
                    $Piece,
                    $prenomPersonne,
                    $referencepiece,
                    $responsable,
                    $sexe,                   
                    $signature;
                    
                    
                    const IDPERSONNE_INVALIDE = 1;
                    const ADRESSE_INVALIDE = 2;
                    const ADRESSERESPONSABLE_INVALIDE = 3;
                    const AUTREPIECE_INVALIDE = 4;
                    const DATEINSCRIPTION_INVALIDE = 5;
                    const DATENAISS_INVALIDE = 6;
                    const DETAILSURPROFESSION_INVALIDE = 7;
                    const FRAISADHESION_INVALIDE = 8;
                    const NOMMERE_INVALIDE = 9;
                    const NOMPERSONNE_INVALIDE = 10;
                    const PARTSOCIAL_INVALIDE = 11;
                    const PAYSORIGINE_INVALIDE = 12;
                    const PHOTOPERSONNE_INVALIDE = 13;
                    const PRENOMPERSONNE_INVALIDE = 14;
                    const REFERENCEPIECE_INVALIDE = 15;
                    const RESPONSABLE_INVALIDE = 16;
                    const SEXE_INVALIDE = 17;
                    const SIGNATURE_INVALIDE = 18;
                    const IDPIECE_INVALIDE = 19;
                    const LIBPROFESSION_INVALIDE = 20;
                    const NUMCATEGORIEPERSON_INVALIDE = 21;
                    
                    public function __construct($valeurs = array())
                    {
                        if (!empty($valeurs)) // Si on a spécifié des valeurs, alors on hydrate l'objet
                            $this->hydrate($valeurs);
                    }
                    
        /**
        * Méthode assignant les valeurs spécifiées aux attributs correspondant
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
            return empty($this->idPersonne);
        }
        
        /**
        * Méthode permettant de savoir si la news est valide
        * @return bool
        */
        
        public function isValid()
        {
            return !(empty($this->dateNaiss) || empty($this->nomPersonne) || empty($this->prenomPersonne) || empty($this->sexe) || empty($this->responsable));
        }
        
        // GETTERS //
        
        public function erreurs()
        {
            return $this->erreurs;
        }
        
        public function idPersonne()
        {
            return $this->idPersonne;
        }
        
        public function adresse()
        {
            return $this->adresse;
        }
        
        public function nomPersonne()
        {
            return $this->nomPersonne;
        }
        
        public function prenomPersonne()
        {
            return $this->prenomPersonne;
        }
        
        public function dateNaiss()
        {
            return $this->dateNaiss;
        }
        
        public function detailsurprofession()
        {
            return $this->detailsurprofession;
        }
        
        public function fraisAdhesion()
        {
            return $this->fraisAdhesion;
        }
        
        public function nomMere()
        {
            return $this->nomMere;
        }
        
       
        public function partSocial()
        {
            return $this->partSocial;
        }
        
        public function paysOrigine()
        {
            return $this->paysOrigine;
        }
        
        public function photoPersonne()
        {
            return $this->photoPersonne;
        }
        
        
        
        public function referencepiece()
        {
            return $this->referencepiece;
        }
        
        public function responsable()
        {
            return $this->responsable;
        }
        
        public function sexe()
        {
            return $this->sexe;
        }
        
        public function signature()
        {
            return $this->signature;
        }
        
        public function idPiece()
        {
            return $this->idPiece;
        }
        
        public function fonctionPersonne()
        {
            return $this->fonctionPersonne;
        }
        
        public function numCategoriePerson()
        {
            return $this->numCategoriePerson;
        }
        
        public function dateInscription()
        {
            return $this->dateInscription;
        }
        
        public function adresseResponsable()
        {
            return $this->adresseResponsable;
        }
        
        // SETTERS //
        
        public function setIdPersonne($id)
        {
            $this->IDPERSONNE = (string) $id;
        }
        
        public function setAdresse($adresse)
        {
            if (!is_string($adresse) || empty($adresse))
                $this->erreurs[] = self::ADRESSE_INVALIDE;
            else
                $this->adresse = $adresse;
        }
        
        public function setAdresseResponsable($adresseresponsable)
        {
            if (!is_string($adresseresponsable) || empty($adresseresponsable))
                $this->erreurs[] = self::ADRESSERESPONSABLE_INVALIDE;
            else
                $this->adresseResponsable = $adresseresponsable;
        }
        
        public function setAutrePiece($autrepiece)
        {
            if (!is_string($autrepiece) || empty($autrepiece))
                $this->erreurs[] = self::AUTREPIECE_INVALIDE;
            else
                $this->autrepiece = $autrepiece;
        }
        
        public function setdateInscription($dateinscription)
        {
            if (!is_string($dateinscription) || empty($dateinscription))
                $this->erreurs[] = self::DATEINSCRIPTION_INVALIDE;
            else
                $this->dateInscription = $dateinscription;
        }
        
        public function setdateNaiss($datenaiss)
        {
            if (!is_string($datenaiss) || empty($datenaiss))
                $this->erreurs[] = self::DATENAISS_INVALIDE;
            else
                $this->dateNaiss = $datenaiss;
        }
        
        public function setdetailsurprofession($detailsurprofession)
        {
            if (!is_string($detailsurprofession) || empty($detailsurprofession))
                $this->erreurs[] = self::DETAILSURPROFESSION_INVALIDE;
            else
                $this->detailsurprofession = $detailsurprofession;
        }
        
        public function setfraisAdhesion($fraisadhesion)
        {
            $this->fraisAdhesion = (float) $fraisadhesion;
        }
        
        public function setnomMere($nommere)
        {
            if (!is_string($nommere) || empty($nommere))
                $this->erreurs[] = self::NOMMERE_INVALIDE;
            else
                $this->nomMere = $nommere;
        }
        
        public function setNomPersone($nompersonne)
        {
            if (!is_string($nompersonne) || empty($nompersonne))
                $this->erreurs[] = self::NOMPERSONNE_INVALIDE;
            else
                $this->nomPersonne = $nompersonne;
        }
        
        public function setPartSocial($partsocial)
        {
            $this->partSocial = (float) $partsocial;
        }
        
        public function setPaysOrigine($paysorigine)
        {
            if (!is_string($paysorigine) || empty($paysorigine))
                $this->erreurs[] = self::PAYSORIGINE_INVALIDE;
            else
                $this->paysOrigine = $paysorigine;
        }
        
        public function setPhotoPersonne($photopersonne)
        {
            if (!is_string($photopersonne) || empty($photopersonne))
                $this->erreurs[] = self::PHOTOPERSONNE_INVALIDE;
            else
                $this->photoPersonne = $photopersonne;
        }
            
        public function setPrenomPersonne($prenompersonne)
        {
            if (!is_string($prenompersonne) || empty($prenompersonne))
                $this->erreurs[] = self::PRENOMPERSONNE_INVALIDE;
            else
                $this->prenomPersonne = $prenompersonne;
        }
        
        public function setReferencepiece($referencepiece)
        {
            if (!is_string($referencepiece) || empty($referencepiece))
                $this->erreurs[] = self::REFERENCEPIECE_INVALIDE;
            else
                $this->referencepiece = $referencepiece;
        }
        
        
        public function setResponsable($responsable)
        {
            if (!is_string($responsable) || empty($responsable))
                $this->erreurs[] = self::RESPONSABLE_INVALIDE;
            else
                $this->responsable = $responsable;
        }
        
        public function setSexe($sexe)
        {
            if (!is_string($sexe) || empty($sexe))
                $this->erreurs[] = self::SEXE_INVALIDE;
            else
                $this->sexe = $sexe;
        }
        
        public function setSignature($signature)
        {
            if (!is_string($signature) || empty($signature))
                $this->erreurs[] = self::RESPONSABLE_INVALIDE;
            else
                $this->signature = $signature;
        }
        
        public function setIdPiece($idPiece)
        {
            $this->idPiece = (int) $idPiece;
        }
    }
?>