<?php


namespace app\Entity;


class CommandeCredit
{
    private $idCommande;
    private $idClient;
    private $date;
    private $prixTotal;

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

    
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

   
    public function getIdClient()
    {
        return $this->idClient;
    }

   
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    public function getDate()
    {
        return $this->date;
    }

   
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

   
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;
    }



}