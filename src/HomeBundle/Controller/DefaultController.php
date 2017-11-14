<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HomeBundle\Entity\Opera;
use HomeBundle\Entity\Autore;
use HomeBundle\Model\HomeModel;



class DefaultController extends Controller
{
    /**
     * @Route("/inserimentoOpera")
     */
    public function indexAction()
    {
        return $this->render('HomeBundle:OperaView:formInserimentoOpera.html.twig');
    }
    
    /**
     * @Route("/tornaHome")
     */
    public function indexAction1()
    {
        return $this->render('HomeBundle:Default:home.html.twig');
    }
    
     /**
     * @Route("/processaDatiOpera")
     */
    public function indexAction2()
    {
        
        $opera=new Opera();
        $opera->setTitolo($_POST["titolo"]);
        $opera->setTecnica($_POST["tecnica"]);
        $opera->setDimensioni($_POST["dimensioni"]);
        $opera->setData(new \DateTime($_POST["data"]));
        
        
        $autore=new Autore();
        $autore->setNome($_POST["nome"]);
        $autore->setEta($_POST["eta"]);
        
        $em = $this->getDoctrine()->getManager();
     
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
    
       
        $model=new HomeModel($em,$container);
        $model->insertOpera($opera,$autore);
        
        
         return $this->render('HomeBundle:OperaView:viewInsertOpera.html.twig');
        
    }
    
    /**
     * @Route("/listaOpereInserite")
     */
    public function indexAction3()
    {
         $em = $this->getDoctrine()->getManager();
     
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
        $model=new HomeModel($em,$container);
        $opere=$model->selectUserOpera($em, $container->get('session')->get('idUtente'));
        
        return $this->render('HomeBundle:OperaView:viewlistaOpere.html.twig',array('opere'=>$opere));
        
        
    }
   
    /**
     * @Route("/listaAutori")
     */
    public function indexAction4()
    {
         $em = $this->getDoctrine()->getManager();
     
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
         $model=new HomeModel($em,$container);
        $autori=$model->selectAuthor($em, $container->get('session')->get('idUtente'));
        
        
        return $this->render('HomeBundle:OperaView:viewlistaAutori.html.twig',array('autori'=>$autori));
        
    
    }
    
 
    /**
     * @Route("/leggiDb")
     */
    public function indexAction5(){
        
         return $this->render('HomeBundle:Default:viewCercaDb.html.twig');
        
    }
    
    /**
     * @Route("/cercaDb")
     */
    public function indexAction6(){
        
         $tabella=$_POST["tabellaName"] ;
         $em = $this->getDoctrine()->getManager();
     
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
         $model=new HomeModel($em,$container);
         $arrTupla=$model->selectTabella($em, $tabella);
         if($arrTupla){
                    return $this->render('HomeBundle:Default:viewTabellaDb.html.twig',array('arrTupla'=>$arrTupla,'tabella'=>$tabella));
         }
         else{
                  return $this->render('HomeBundle:Default:viewNotTabellaDb.html.twig');
         }
    }
    
    
    /**
     * @Route("/cercaOpereAutore")
     */
      public function indexAction7(){
          
          //var_dump($_POST);
          $idAutore=$_POST["tasto"];
          $em = $this->getDoctrine()->getManager();
     
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
         $model=new HomeModel($em,$container);
         $opere=$model->selectAuthorOpera($em,$container->get('session')->get('idUtente'),$idAutore);
        
         
          return $this->render('HomeBundle:OperaView:viewlistaOpere1.html.twig',array('opere'=>$opere));
          
      }
      
      /**
     * @Route("/dettagliAutore")
     */
      public function indexAction8(){
     
         
          $idAutore=$_POST["tasto"];
          $em = $this->getDoctrine()->getManager();
     
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
         $model=new HomeModel($em,$container);
         $autore=$model->selectAuthorById($idAutore);
       
         return $this->render('HomeBundle:OperaView:viewAutore.html.twig',array('autore'=>$autore));
          
      }
      
      
}
