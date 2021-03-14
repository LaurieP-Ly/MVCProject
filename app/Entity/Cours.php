<?php


namespace app\Entity;


class Cours
{
    private $idCours;
    private $nom;
    private $niveau;
    private $prix;
    private $temps;
    private $categorie;
    private $description;
    private $imgCours;


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

    
    public function getIdCours()
    {
        return $this->idCours;
    }

    
    public function setIdCours($idCours)
    {
        $this->idCours = $idCours;
    }

    
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($Nom)
    {
        $this->nom = $Nom;
    }


    public function getNiveau()
    {
        return $this->niveau;
    }

    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }


    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function getTemps()
    {
        return $this->temps;
    }

    public function setTemps($temps)
    {
        $this->temps = $temps;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImgCours()
    {
        return $this->imgCours;
    }

    public function setImgCours($imgCours)
    {
        $this->imgCours = $imgCours;
    }





}