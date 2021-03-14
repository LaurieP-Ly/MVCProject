<?php


namespace app\Entity;


class Recette
{
    private $idRecette;
    private $nom;
    private $niveau;
    private $temps;
    private $nbPersonnes;
    private $ingredients;
    private $description;
    private $categorie;
    private $imgRecette;
    private $imgDerouleRecette;

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

    
    public function getIdRecette()
    {
        return $this->idRecette;
    }

    
    public function setIdRecette($idRecette)
    {
        $this->idRecette = $idRecette;
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


    public function getTemps()
    {
        return $this->temps;
    }

    public function setTemps($temps)
    {
        $this->temps = $temps;
    }

    public function getNombreDePersonne()
    {
        return $this->nbPersonnes;
    }

    public function setNombreDePersonne($nbPersonnes)
    {
        $this->nbPersonnes = $nbPersonnes;
    }

    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function getImgRecette()
    {
        return $this->imgRecette;
    }

    public function setImgRecette($imgRecette)
    {
        $this->imgRecette = $imgRecette;
    }

    public function getImgDerouleRecette()
    {
        return $this->imgDerouleRecette;
    }

    public function setImgDerouleRecette($imgDerouleRecette)
    {
        $this->imgDerouleRecette = $imgDerouleRecette;
    }





}