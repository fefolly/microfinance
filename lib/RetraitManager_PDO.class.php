<?php
    class RetraitManager_PDO extends RetraitManager
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
        protected function add(Retrait $retrait)
        {
            $requete = $this->db->prepare('INSERT INTO retrait SET login = :login, numCompte = :numCompte, dateRetrait = NOW(),
                                          mntRetrait = :mntRetrait, commentaire = :commentaire, indication = :indication');
            
            $requete->bindValue(':login', $retrait->login());
            $requete->bindValue(':numCompte', $retrait->numCompte());
            $requete->bindValue(':mntRetrait', $retrait->mntRetrait());
            $requete->bindValue(':commentaire', $retrait->commentaire());
            $requete->bindValue(':indication', $retrait->indication());
            
            $requete->execute();
        }
        
        /**
        * @see NewsManager::count()
        */
        public function count()
        {
            return $this->db->query('SELECT COUNT(*) FROM retrait')->fetchColumn();
        }
        
        /**
        * @see NewsManager::delete()
        */
        public function delete($idRetrait)
        {
            $this->db->exec('DELETE FROM retrait WHERE idRetrait = '$idRetrait);
        }
        
        /**
        * @see NewsManager::getList()
        */
        public function getList($debut = -1, $limite = -1)
        {
            $listeDepot = array();
            
            $sql = 'SELECT idRetrait, login, numCompte, DATE_FORMAT (dateRetrait, \'le %d/%m/%Y à %Hh%i\') AS dateRetrait,
                    mntRetrait, commentaire, indication FROM depot ORDER BY idRetrait DESC';
            
            // On vérifie l'intégrité des paramètres fournis
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }
            
            $requete = $this->db->query($sql);
            
            while ($retrait = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $listeRetrait[] = new Retrait($retrait);
            }
            
            $requete->closeCursor();
            
            return $listeRetrait;
        }
        
        /**
        * @see NewsManager::getUnique()
        */
        public function getUnique($idRetrait)
        {
            $requete = $this->db->prepare('SELECT idRetrait, login, numCompte, DATE_FORMAT (dateRetrait, \'le %d/%m/%Y à %Hh%i\') AS dateRetrait,
                                            mntRetrait, commentaire, indication FROM retrait WHERE idRetrait = :idRetrait');
            $requete->bindValue(':idRetrait', $idRetrait);
            $requete->execute();
            
            return new Retrait($requete->fetch(PDO::FETCH_ASSOC));
        }
        
        /**
        * @see NewsManager::update()
        */
        protected function update(Retrait $retrait)
        {
            $requete = $this->db->prepare('UPDATE retrait SET login = :login, numCompte = :numCompte, dateRetrait = NOW(), mntRetrait, commentaire, indication WHERE idDepot = :idDepot');
            
            $requete->bindValue(':login', $retrait->login());
            $requete->bindValue(':numCompte', $retrait->numCompte());
            $requete->bindValue(':mntRetrait', $retrait->mntRetrait());
            $requete->bindValue(':commentaire', $retrait->commentaire());
            $requete->bindValue(':indication', $retrait->indication());
            $requete->bindValue(':idRetrait', $retrait->idRetrait());
            
            $requete->execute();
        }
    }
?>