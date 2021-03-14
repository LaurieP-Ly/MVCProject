<?php


namespace app\Entity;


class User
{
    private $iduser;
    private $role;
    private $username;
    private $password;

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

    
    public function getId_user()
    {
        return $this->iduser;
    }

    
    public function setId_user($iduser)
    {
        $this->iduser = $iduser;
    }

   
    public function getRole()
    {
        return $this->role;
    }

   
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getUsername()
    {
        return $this->username;
    }

   
    public function setUsername($username)
    {
        $this->username = $username;
    }



    public function getPassword()
    {
        return $this->password;
    }

   
    public function setPassword($password)
    {
        $this->password = $password;
    }



}