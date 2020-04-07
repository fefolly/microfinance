<?php
    abstract class PersonneManager
    {
        /**
        * M�thode permettant d'ajouter une news
        * @param $news News La news � ajouter
        * @return void
        */
        abstract protected function add(Personne $personne);
        
        /**
        * M�thode renvoyant le nombre de news total
        * @return int
        */
        abstract public function count();
        
        /**
        * M�thode permettant de supprimer une news
        * @param $id int L'identifiant de la news � supprimer
        * @return void
        */
        abstract public function delete($id);
        
        /**
        * M�thode retournant une liste de news demand�e
        * @param $debut int La premi�re news � s�lectionner
        * @param $limite int Le nombre de news � s�lectionner
        * @return array La liste des news. Chaque entr�e est une instance
        de News.
        */
        abstract public function getList($debut = -1, $limite = -1);
        
        /**
        * M�thode retournant une news pr�cise
        * @param $id int L'identifiant de la news � r�cup�rer
        * @return News La news demand�e
        */
        abstract public function getUnique($id);
        
        /**
        * M�thode permettant d'enregistrer une news
        * @param $news News la news � enregistrer
        * @see self::add()
        * @see self::modify()
        * @return void
        */
        public function save(Personne $personne)
        {
            if ($personne->isValid())
            {
                $personne->isNew() ? $this->add($personne) : $this->update($personne);
            }
            else
            {
                throw new RuntimeException('La personne doit �tre valide pour �tre enregistr�e');
            }
        }
        
        /**
        * M�thode permettant de modifier une news
        * @param $news news la news � modifier
        * @return void
        */
        abstract protected function update(Personne $personne);
    }
?>