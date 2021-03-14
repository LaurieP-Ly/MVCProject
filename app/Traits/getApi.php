<?php

namespace app\Traits;

use app\Entity\Clients;
use app\Entity\user;

trait getApi{

    
    public function getApi($table){

       
        $array=$this->model->All();
        
        $number=0;
        foreach ($array as $d){
            $number=$number+1;
        }
        $record=[];
        $fields="";
        for($i=0; $i<sizeof($array); $i++){
            
                $fields=$array[$i];
            
            
            $record[$i]=array("fields"=>array($fields));
        }
        
        $api=array("nbhits"=>$number, "classe"=>$table, "format"=>"json", "records"=>$record);
        return $api;

    }

    public function getApiClient(){
        $array=$this->model->All();
        $data=array();
        $number=0;
        foreach ($array as $client){
            $cli=new Clients($client);
            array_push($data, $cli);
            $number=$number+1;
        }
        $record=[];
        for($i=0; $i<sizeof($data);$i++){
            $record[$i]=array("fields"=>array("idClient"=>$data[$i]->getIdClient(), "nom"=>$data[$i]->getNom(), "prenom"=>$data[$i]->getPrenom(), "CodePostale"=>$data[$i]->getCodePostale(), "email"=>$data[$i]->getEmail(), "pseudo"=>$data[$i]->getPseudo()));
        }
        
        $api=array("nbhits"=>$number, "classe"=>"Clients", "format"=>"json", "records"=>$record);
        return $api;
    }

    public function getApiUser(){
        $array=$this->model->All();
        $data=array();
        $number=0;
        foreach ($array as $user){
            $us=new User($user);
            array_push($data, $us);
            $number=$number+1;
        }
        $record=[];
        for($i=0; $i<sizeof($data);$i++){
            $record[$i]=array("fields"=>array("id_user"=>$data[$i]->getId_user(), "role"=>$data[$i]->getRole(), "username"=>$data[$i]->getUsername()));
        }
        
        $api=array("nbhits"=>$number, "classe"=>"User", "format"=>"json", "records"=>$record);
        return $api;
    }




}