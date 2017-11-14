<?php

namespace HomeBundle\Model;
use HomeBundle\Repository\AutoreRepository;
use HomeBundle\Repository\OperaRepository;

class HomeModel 
{
    protected $em;
    protected $container;
    
    public function __construct($em, $container) {
        $this->em = $em;
        $this->container = $container;
    }
    
     public function insertOpera($opera,$autore){
         $repository= $this->em->getRepository("HomeBundle:Opera");
         $repositoryAut=$this->em->getRepository("HomeBundle:Autore");
         
         $aut=$repositoryAut->searchAutore($this->em,$autore);
         $idAutore=0;
         if($aut){
             $idAutore=$aut->getId();
         }
         else{
            $repository->persistAutore($this->em,$autore);
            $idAutore=$autore->getId();
         }
         $opera->setIdAutore($idAutore);
         $repository->persistOpera($this->em,$opera);
         $idUtente=$this->container->get('session')->get('idUtente');
         
         $repository->updateOpereInserite($this->em,$idUtente,$opera->getId());
    }
    
    //verifica se l' oggetto è presente nella tabella
    
    public function isPresent($object){
        $repository=$this->em->getRepository("HomeBundle:Opera");
        return $repository->searchAutore($this->em,$object);
    }
    
    
    public function selectUserOpera($em,$idUtente){
        
        $repository=$this->em->getRepository("HomeBundle:Opera");
        $opere=$repository->getUserOpera($em,$idUtente);
        
        
        return $opere;
        
    }
    
    public function selectAuthor($em, $idUtente){
             $repository=$this->em->getRepository("HomeBundle:Opera");
             $autori=$repository->getAuthors($em,$idUtente);
        
        
        return $autori;
    }
    
    
    public function selectTabella($em,$tabella){
            $repository=$this->em->getRepository("HomeBundle:Opera");
            // seleziono la tabella se esiste nel db;
            $trovata=false;
            $tabelleDb=$repository->showTablesDb($em);
            //verifico se la tabella esiste nel db
            foreach($tabelleDb as $tabelle){
                foreach($tabelle as $nomeTabella){
                   
                    if($nomeTabella==$tabella){
                         $trovata=true;
                    }
                  
                }
            }
           if($trovata){
                    $tab=$repository->getTabella($em,$tabella);
                    return $tab;
           }
           else{
               return NULL;
           }
        
    }
    
    
    public function selectAuthorOpera($em,$idUtente,$idAutore){
             $repository=$this->em->getRepository("HomeBundle:Opera");
             
              $opere=$repository->showAthorOpere($em,$idUtente,$idAutore);
              
             return $opere;
    }
    
    public function selectAuthorById($idAutore){
            $repository=$this->em->getRepository("HomeBundle:Autore");
            $autore=$repository->getAutoreById($idAutore);
        
        return $autore;
    }
    
  
    
}
