<?php


namespace app\Entity;


class Horaire
{
    private $idHoraire;
    private $idCours;
    private $jour;
    private $heure;

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

    
    public function getIdHoraire()
    {
        return $this->idHoraire;
    }

    
    public function setIdHoraire($idHoraire)
    {
        $this->idHoraire = $idHoraire;
    }

    
    public function getIdCours()
    {
        return $this->idCours;
    }

    public function setIdCours($idCours)
    {
        $this->idCours = $idCours;
    }


    public function getJour()
    {
        return $this->jour;
    }

    public function setJour($jour)
    {
        $this->jour = $jour;
    }


    public function getHeure()
    {
        return $this->heure;
    }

    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

   





}