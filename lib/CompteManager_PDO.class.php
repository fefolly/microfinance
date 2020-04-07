<?php
    class CompteManager_PDO extends CompteManager
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
        protected function add(Compte $compte)
        {
            $requete = $this->db->prepare('INSERT INTO compte SET numCompte = :numCompte, idPersonne = :idPersonne, idTypeCompte = :idTypeCompte,
                                          etatCompte = :etatCompte, dateCreation = NOW(), solde = :solde, premierversement = :premierversement');
            
            $requete->bindValue(':numCompte', $compte->numCompte());
            $requete->bindValue(':idPersonne', $compte->idPersonne());
            $requete->bindValue(':idTypeCompte', $compte->idTypeCompte());
            $requete->bindValue(':etatCompte', $compte->etatCompte());
            $requete->bindValue(':solde', $compte->solde());
            $requete->bindValue(':premierversement', $compte->premierversement());
            
            $requete->execute();
        }
        
        /**
        * @see NewsManager::count()
        */
        public function count()
        {
            return $this->db->query('SELECT COUNT(*) FROM compte')->fetchColumn();
        }
        
        /**
        * @see NewsManager::delete()
        */
        public function delete($numCompte)
        {
            $this->db->exec('DELETE FROM compte WHERE numCompte = '$numCompte);
        }
        
        /**
        * @see NewsManager::getList()
        */
        public function getList($debut = -1, $limite = -1)
        {
            $listeCompte = array();
            
            $sql = 'SELECT numCompte, idPersonne, idTypeCompte, etatCompte, DATE_FORMAT (dateCreation, \'le %d/%m/%Y à %Hh%i\') AS dateCreation,
                    solde, premierversement FROM compte ORDER BY id DESC';
            
            // On vérifie l'intégrité des paramètres fournis
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }
            
            $requete = $this->db->query($sql);
            
            while ($compte = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $listeCompte[] = new Compte($compte);
            }
            
            $requete->closeCursor();
            
            return $listeCompte;
        }
        
        /**
        * @see NewsManager::getUnique()
        */
        public function getUnique($numCompte)
        {
            $requete = $this->db->prepare('SELECT numCompte, idPersonne, idTypeCompte, etatCompte, DATE_FORMAT (dateCreation, \'le %d/%m/%Y à %Hh%i\')
                                          AS dateCreation, solde, premierversement FROM compte WHERE numCompte = :numCompte');
            $requete->bindValue(':numCompte', $numCompte);
            $requete->execute();
            
            return new Compte($requete->fetch(PDO::FETCH_ASSOC));
        }
        
        /**
        * @see NewsManager::update()
        */
        protected function update(Compte $compte)
        {
            $requete = $this->db->prepare('UPDATE compte SET idPersonne = :idPersonne, idTypeCompte = :idTypeCompte, etatCompte = :etatCompte,
                                          dateCreation = NOW(), solde = :solde, premierversement = :premierversement WHERE numCompte = :numCompte');
            
            $requete->bindValue(':idPersonne', $compte->idPersonne());
            $requete->bindValue(':idTypeCompte', $compte->idTypeCompte());
            $requete->bindValue(':etatCompte', $compte->etatCompte());
            $requete->bindValue(':solde', $compte->solde());
            $requete->bindValue(':premierversement', $compte->premierversement());
            $requete->bindValue(':numCompte', $compte->numCompte());
            
            $requete->execute();
        }
    }
?>