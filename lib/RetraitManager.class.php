<?php
    abstract class RetraitManager
    {
        /**
        * Méthode permettant d'ajouter une news
        * @param $news News La news à ajouter
        * @return void
        */
        abstract protected function add(Retrait $retrait);
        
        /**
        * Méthode renvoyant le nombre de news total
        * @return int
        */
        abstract public function count();
        
        /**
        * Méthode permettant de supprimer une news
        * @param $id int L'identifiant de la news à supprimer
        * @return void
        */
        abstract public function delete($id);
        
        /**
        * Méthode retournant une liste de news demandée
        * @param $debut int La première news à sélectionner
        * @param $limite int Le nombre de news à sélectionner
        * @return array La liste des news. Chaque entrée est une instance
        de News.
        */
        abstract public function getList($debut = -1, $limite = -1);
        
        /**
        * Méthode retournant une news précise
        * @param $id int L'identifiant de la news à récupérer
        * @return News La news demandée
        */
        abstract public function getUnique($id);
        
        /**
        * Méthode permettant d'enregistrer une news
        * @param $news News la news à enregistrer
        * @see self::add()
        * @see self::modify()
        * @return void
        */
        public function save(Retrait $retrait)
        {
            if ($retrait->isValid())
            {
                $retrait->isNew() ? $this->add($retrait) : $this->update($retrait);
            }
            else
            {
                throw new RuntimeException('Le retrait doit être valide pour être enregistré');
            }
        }
        
        /**
        * Méthode permettant de modifier une news
        * @param $news news la news à modifier
        * @return void
        */
        abstract protected function update(Retrait $retrait);
    }
?>