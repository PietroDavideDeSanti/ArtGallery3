<?php

namespace UserBundle\Model;
use UserBundle\Repository\UtenteRepository;

class UtenteModel 
{
    protected $em;
    protected $container;
    
    public function __construct($em, $container) {
        $this->em = $em;
        $this->container = $container;
    }
    
    public function selectUser($pathUt,$idUtente){
        
        $repository= $this->em->getRepository("UserBundle:Utente");
        $user=$repository->getUtenteById($this->em,$pathUt, $idUtente);
        
        
        return $user;
        
    }
    
    public function selectAllUsers(){
         $repository= $this->em->getRepository("UserBundle:Utente");
         $users=$repository->getAllUsers();
         
        return $users;
         
    }
    
    public function verificaUtenticazione($username,$password){
        $repository= $this->em->getRepository("UserBundle:Utente");
        $user=$repository->selectUserWhere($username,$password);
         
         if($user){
             return true;
         }
         
         else{
             return false;
         }
         
       
    }
    
    public function insertUser($user){
         $repository= $this->em->getRepository("UserBundle:Utente");
         $repository->insertUtente($this->em,$user);
    }
    
    public function selectUserByUname($uname){
         $repository= $this->em->getRepository("UserBundle:Utente");
         $utente=$repository->selectUserFromUname($uname);
         
        return $utente;
         
    }
    
    public function verificaAdmin($em,$username,$password){
         $repository= $this->em->getRepository("UserBundle:Utente");
         $idUtente=$repository->searchIdByUnamePass($username,$password);
         $utente=$repository->selectUserAdminById($em,$idUtente);
         
         $bool=false;
         
         if($utente){
              $bool=true;
             
         }
        return $bool;
    }
    
    
    
    
}
