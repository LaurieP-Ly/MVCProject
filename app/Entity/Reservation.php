<?php


namespace app\Entity;


class Reservation
{
    private $idReservation;
    private $idCommande;
    private $idHoraire;

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

    
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

   
    public function getIdCommande()
    {
        return $this->idCommande;
    }

   
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

    public function getIdHoraire()
    {
        return $this->idHoraire;
    }

   
    public function setIdHoraire($idHoraire)
    {
        $this->idHoraire = $idHoraire;
    }



}