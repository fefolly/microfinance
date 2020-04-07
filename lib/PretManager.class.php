<?php
    abstract class Pret
    {
        
        abstract protected function add(Pret $pret);
        
        abstract public function count();
        
        abstract public function delete($idPret);
        
        abstract public function getList($debut = -1, $limite = -1);
        
        abstract public function getUnique($idPret);
        
        public function save(Pret $pret)
        {
            if ($personne->isValid())
            {
                $pret->isNew() ? $this->add($pret) : $this->update($pret);
            }
            else
            {
                throw new RuntimeException('Toutes les conditions doivent �tre valide pour pouvoir enr�gistrer le pret');
            }
        }
        
        
        abstract protected function update(Pret $pret);
    }
?>