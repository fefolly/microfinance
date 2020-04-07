<?php
    class PersonneManager_PDO extends PersonneManager
    {
        /**
        * Attribut contenant l'instance représentant la BDD
        * @type PDO
        */
        protected $db;
        
        /**
        * Constructeur étant chargé d'enregistrer l'instance de PDO dans
        l'attribut $db
        * @param $db PDO Le DAO
        * @return void
        */
        public function __construct(PDO $db)
        {
            $this->db = $db;
        }
        
        /**
        * @see NewsManager::add()
        */
        protected function add(Personne $personne)
        {
            $requete = $this->db->prepare(" INSERT INTO personne SET idPersonne = :idPersonne, nomPersonne = :nom, prenomPersonne = :prenom, dateNaiss = :dateNaiss, sexe = :sexe,
                                            adresse = :adresse, partSocial = :partSocial, photoPersonne = :photoPersonne, fonctionPersonne = :fonctionPersonne, fraisAdhesion = :fraisAdhesion,
                                            signature = :signature, piece = :piece, nomMere = :nomMere, referencepiece = :referencepiece, responsable = :responsable, adresseResponsable = :adresseResponsable,
                                            dateInscription = :dateInscription, detailsurprofession = :detailsurprofession, autrepiece = :autrepiece, paysOrigine = :paysOrigine, categorie_personne = :categorie_personne ");
            $requete->bindValue(':adresse', $personne->adresse());
            $requete->bindValue(':nomPersonne', $personne->nomPersonne());
            $requete->bindValue(':prenomPersonne', $personne->prenomPersonne());
            $requete->bindValue(':dateNaiss', $personne->dateNaiss());
            $requete->bindValue(':sexe', $personne->sexe());
            $requete->bindValue(':partSocial', $personne->partSocial());
            $requete->bindValue(':photoPersonne', $personne->photoPersonne());
            $requete->bindValue(':fonctionPersonne', $personne->fonctionPersonne());
            $requete->bindValue(':fraisAdhesion', $personne->fraisAdhesion());
           // $requete->bindValue(':idPersonne', $personne->idPersonne());
            $requete->bindValue(':signature', $personne->signature());
            $requete->bindValue(':piece', $personne->piece());
            $requete->bindValue(':nomMere', $personne->nomMere());
            $requete->bindValue(':referencepiece', $personne->referencepiece());
            $requete->bindValue(':responsable', $personne->responsable());
            $requete->bindValue(':adresseResponsable', $personne->adresseResponsable());
            $requete->bindValue(':dateInscription', $personne->dateInscription());
            $requete->bindValue(':detailsurprofession', $personne->detailsurprofession());
            $requete->bindValue(':autrepiece', $personne->autrepiece());
            $requete->bindValue(':paysOrigine', $personne->paysOrigine());
            $requete->bindValue(':categorie_personne', $personne->categorie_personne());
            
            $requete->execute();
        }
        
        /**
        * @see NewsManager::count()
        */
        public function count()
        {
            return $this->db->query('SELECT COUNT(*) FROM personne')->fetchColumn();
        }
        
        /**
        * @see NewsManager::delete()
        */
        public function delete($idPersonne)
        {
            $this->db->exec('DELETE FROM personne WHERE idPersonne = '.(string) $idPersonne);
        }
        
        /**
        * @see NewsManager::getList()
        */
        public function getList($debut = -1, $limite = -1)
        {
            $listePersonne = array();
            
            $sql = 'SELECT idPersonne, nomPersonne, prenomPersonne, dateNaiss, sexe,adresse, partSocial, photoPersonne, fonctionPersonne, fraisAdhesion,
                    signature, piece, nomMere, referencepiece, responsable, adresseResponsable, dateInscription, detailsurprofession, autrepiece,
                    paysOrigine, categorie_personne FROM personne ORDER BY idPersonne DESC';
            
            // On vérifie l'intégrité des paramètres fournis
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }
            
            $requete = $this->db->query($sql);
            
            while ($personne = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $listePersonne[] = new Personne($personne);
            }
            
            $requete->closeCursor();
            
            return $listePersonne;
        }
        
        /**
        * @see NewsManager::getUnique()
        */
        public function getUnique($idPersonne)
        {
            $requete = $this->db->prepare(' SELECT idPersonne, nomPersonne, prenomPersonne, dateNaiss, sexe,adresse, partSocial, photoPersonne, fonctionPersonne, fraisAdhesion,
                                            signature, piece, nomMere, referencepiece, responsable, adresseResponsable, dateInscription, detailsurprofession, autrepiece,
                                            paysOrigine, categorie_personne FROM personne WHERE idPersonne = :idPersonne ');
            
            $requete->bindValue(':idPersonne', $idPersonne);
            $requete->execute();
            
            return new Personne($requete->fetch(PDO::FETCH_ASSOC));
        }
        
        /**
        * @see NewsManager::update()
        */
        protected function update(Personne $personne)
        {
            $requete = $this->db->prepare(' UPDATE personne SET nomPersonne = :nom, prenomPersonne = :prenom, dateNaiss = :dateNaiss, sexe = :sexe, adresse = :adresse,
                                            partSocial = :partSocial, photoPersonne = :photoPersonne, fonctionPersonne = :fonctionPersonne, fraisAdhesion = :fraisAdhesion,
                                            signature = :signature, piece = :piece, nomMere = :nomMere, referencepiece = :referencepiece, responsable = :responsable,
                                            adresseResponsable = :adresseResponsable, dateInscription = :dateInscription, detailsurprofession = :detailsurprofession,
                                            autrepiece = :autrepiece, paysOrigine = :paysOrigine, categorie_personne = :categorie_personne WHERE idPersonne = :idPersonne ');
            
            $requete->bindValue(':nomPersonne', $personne->nomPersonne());
            $requete->bindValue(':prenomPersonne', $personne->prenomPersonne());
            $requete->bindValue(':dateNaiss', $personne->dateNaiss());
            $requete->bindValue(':sexe', $personne->sexe());
            $requete->bindValue(':adresse', $personne->adresse());
            $requete->bindValue(':partSocial', $personne->partSocial());
            $requete->bindValue(':photoPersonne', $personne->photoPersonne());
            $requete->bindValue(':fonctionPersonne', $personne->fonctionPersonne());
            $requete->bindValue(':fraisAdhesion', $personne->fraisAdhesion());
            $requete->bindValue(':signature', $personne->signature());
            $requete->bindValue(':piece', $personne->piece());
            $requete->bindValue(':nomMere', $personne->nomMere());
            $requete->bindValue(':referencepiece', $personne->referencepiece());
            $requete->bindValue(':responsable', $personne->responsable());
            $requete->bindValue(':adresseResponsable', $personne->adresseResponsable());
            $requete->bindValue(':dateInscription', $personne->dateInscription());
            $requete->bindValue(':detailsurprofession', $personne->detailsurprofession());
            $requete->bindValue(':autrepiece', $personne->autrepiece());
            $requete->bindValue(':paysOrigine', $personne->paysOrigine());
            $requete->bindValue(':categorie_personne', $personne->categorie_personne());
            $requete->bindValue(':idPersonne', $personne->idPersonne());
            
            $requete->execute();
        }
    }
?>