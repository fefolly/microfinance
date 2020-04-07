<?php
    class DepotManager_PDO extends DepotManager
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
        protected function add(Depot $depot)
        {
            $requete = $this->db->prepare('INSERT INTO depot SET login = :login, numCompte = :numCompte, dateDepot = NOW(),
                                          mntDepot = :mntDepot, commentaire = :commentaire, indication = :indication');
            
            $requete->bindValue(':login', $depot->login());
            $requete->bindValue(':numCompte', $depot->numCompte());
            $requete->bindValue(':mntDepot', $depot->mntDepot());
            $requete->bindValue(':commentaire', $depot->commentaire());
            $requete->bindValue(':indication', $depot->indication());
            
            $requete->execute();
        }
        
        /**
        * @see NewsManager::count()
        */
        public function count()
        {
            return $this->db->query('SELECT COUNT(*) FROM depot')->fetchColumn();
        }
        
        /**
        * @see NewsManager::delete()
        */
        public function delete($idDepot)
        {
            $this->db->exec('DELETE FROM depot WHERE idDepot = '$idDepot);
        }
        
        /**
        * @see NewsManager::getList()
        */
        public function getList($debut = -1, $limite = -1)
        {
            $listeDepot = array();
            
            $sql = 'SELECT idDepot, login, numCompte, DATE_FORMAT (dateDepot, \'le %d/%m/%Y à %Hh%i\') AS dateDepot,
                    mntDepot, commentaire, indication FROM depot ORDER BY idDepot DESC';
            
            // On vérifie l'intégrité des paramètres fournis
            if ($debut != -1 || $limite != -1)
            {
                $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
            }
            
            $requete = $this->db->query($sql);
            
            while ($depot = $requete->fetch(PDO::FETCH_ASSOC))
            {
                $listeDepot[] = new Depot($depot);
            }
            
            $requete->closeCursor();
            
            return $listeDepot;
        }
        
        /**
        * @see NewsManager::getUnique()
        */
        public function getUnique($idDepot)
        {
            $requete = $this->db->prepare('SELECT idDepot, login, numCompte, DATE_FORMAT (dateDepot, \'le %d/%m/%Y à %Hh%i\') AS dateDepot,
                                            mntDepot, commentaire, indication FROM depot WHERE idDepot = :idDepot');
            $requete->bindValue(':idDepot', $idDepot);
            $requete->execute();
            
            return new Depot($requete->fetch(PDO::FETCH_ASSOC));
        }
        
        /**
        * @see NewsManager::update()
        */
        protected function update(Depot $depot)
        {
            $requete = $this->db->prepare('UPDATE depot SET login = :login, numCompte = :numCompte, dateDepot = NOW(), mntDepot, commentaire, indication WHERE idDepot = :idDepot');
            
            $requete->bindValue(':login', $depot->login());
            $requete->bindValue(':numCompte', $depot->numCompte());
            $requete->bindValue(':mntDepot', $depot->mntDepot());
            $requete->bindValue(':commentaire', $depot->commentaire());
            $requete->bindValue(':indication', $depot->indication());
            $requete->bindValue(':idDepot', $depot->idDepot());
            
            $requete->execute();
        }
    }
?>