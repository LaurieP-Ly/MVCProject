<?php


namespace app\Entity;


class Clients
{
    private $idClient;
    private $nom;
    private $prenom;
    private $codePostal;
    private $email;
    private $pseudo;
    private $password;
    private $nbCredits;

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

    
    public function getIdClient()
    {
        return $this->idClient;
    }

    
    public function setIdClient($IdClient)
    {
        $this->idClient = $IdClient;
    }

    
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($Nom)
    {
        $this->nom = $Nom;
    }


    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }


    public function getCodePostale()
    {
        return $this->codePostal;
    }

    public function setCodePostale($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($email)
    {
        $this->pseudo = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getNbCredits()
    {
        return $this->nbCredits;
    }

    
    public function setNbCredits($nbCredits)
    {
        $this->nbCredits = $nbCredits;
    }





}