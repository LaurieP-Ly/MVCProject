<?php


namespace app\Entity;


class Categorie
{
    private $idCategorie;
    private $categorie;

    public function __construct(array $data)
    {


        $this->hydrate($data);


    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $values) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($values);
            }
        }
    }

    
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    
    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;
    }

   
    public function getCategorie()
    {
        return $this->categorie;
    }

   
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }



}