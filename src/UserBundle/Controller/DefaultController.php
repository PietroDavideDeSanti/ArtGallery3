<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\Utente;
use UserBundle\Model\UtenteModel;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    /**
     * @Route("/loginProcessaDati")
     */
    public function indexAction()
    {
        
        //recupero username e password
         $username=$_POST["usernameLogin"];
         $password=$_POST["passwordLogin"];
        // Recupero entity manager
        $em = $this->getDoctrine()->getManager();
        
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
        $model=new UtenteModel($em, $container);
        $trovato=$model->verificaUtenticazione($username,$password);
        
        if($trovato){
            
                    $utente=$model->selectUserByUname($username);
                 
                    $session=$container->get('session');
                    $session->set('nomeUtente', $utente->getNome());
                    $session->set('idUtente', $utente->getId());
                
                    
                    
                    return $this->render('HomeBundle:Default:home.html.twig');
                    
        }
        else{
                return $this->render('UserBundle:Default:viewNonUtenticato.html.twig');
        }
    }
    
    /**
     * @Route("/loginProcessaDatiAdmin")
     */
    public function indexAction10()
    {
        //recupero username e password
         $username=$_POST["usernameLogin"];
         $password=$_POST["passwordLogin"];
        // Recupero entity manager
        $em = $this->getDoctrine()->getManager();
        
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
        $model=new UtenteModel($em, $container);
        
        //verifico se l'utente esiste
        if($model->verificaUtenticazione($username,$password)){
                    
                    //verifico se l'utente è amministratore
                    $boolAdmin=$model->verificaAdmin($em,$username,$password);
        
                     if($boolAdmin){
            
                        $utente=$model->selectUserByUname($username);
                    
                        $session=$container->get('session');
                        $session->set('nomeUtente', $utente->getNome());
                        $session->set('idUtente', $utente->getId());
                        $session->set('userAdmin', "user Admin");
                
                    
                    
                        return $this->render('HomeBundle:Default:home.html.twig');
                    
                     }
                    else{
                        
                        return $this->render('UserBundle:Default:viewNonUtenticato.html.twig');
                     }
        }
        
        else{
            return $this->render('UserBundle:Default:viewNonUtenticato.html.twig');
        }
    }
    
    /**
     * @Route("/inserisciUtente")
     * 
     */
    public function indexAction1()
    {
        $utente=new Utente();
        $utente->setNome("Giacomo");
        $utente->setCognome("Zam");
        $utente->setUsername("z");
        $utente->setPassword("z");
        
       
        
        return $this->render('UserBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/selectUtente")
     * 
     */
    public function indexAction2()
    {
        // Recupero entity manager
        $em = $this->getDoctrine()->getManager();
        
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
        
        $model=new UtenteModel($em, $container);
        $utente=$model->selectUser("UserBundle\Entity\Utente", 1);
        
       
        var_dump($utente);
        return $this->render('UserBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/tuttiUtenti")
     * 
     */
    public function indexAction3()
    {
        // Recupero entity manager
        $em = $this->getDoctrine()->getManager();
        
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        
        
        $model=new UtenteModel($em, $container);
        $utenti=$model->selectAllUsers();
        
       
        var_dump($utenti);
        return $this->render('UserBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/registration")
     * 
     */
    public function indexAction4()
    {
        return $this->render('UserBundle:Registration:formRegistration.html.twig');
    }
    /**
     * @Route("/processaDatiReg")
     */ 
    public function indexAction5()
    {
      
        $user=new Utente();
        $user->setNome($_POST["nome"]);
        $user->setCognome($_POST["cognome"]);
        $user->setUsername($_POST["username"]);
        $user->setPassword($_POST["password"]);
        
        $em = $this->getDoctrine()->getManager();
        
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        $model=new UtenteModel($em,$container);
        $model->insertUser($user);
        
        return $this->render('UserBundle:Registration:viewUtenteInserito.html.twig');
    }
    /**
     * @Route("/recuperaPass")
     */
     public function indexAction6()
    {
        return $this->render('UserBundle:Recovery:formRecoveryPass.html.twig');
    }
    
    /**
     * @Route("/recuperaPassword")
     */
    public function indexAction7()
    {
         $em = $this->getDoctrine()->getManager();
      
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
  
       $model=new UtenteModel($em,$container);
       $user=$model->selectUserByUname($_POST["uname"]);
       if($user){
            return $this->render('UserBundle:Recovery:viewPass.html.twig',array('pass'=>$user->getPassword()));
       }
       else{
            return $this->render('UserBundle:Recovery:viewNotPass.html.twig');
       }
    }
    
    /**
     * @Route("/logOut")
     */
    public function indexAction8()
    {
        
         $em = $this->getDoctrine()->getManager();
      
        // Recupero il container (server per recuperare i servizi)
        $container = $this->container;
        //pulisco la sesione
        $container->get('session')->clear();
        
        
        
        return $this->render('UserBundle:Default:login.html.twig');
        
    }
     /**
     * @Route("/adminAccess")
     */
    public function indexAction9()
    {
     
        return $this->render('UserBundle:Default:adminLogin.html.twig');
        
    }
    
    /**
     * @Route("/endPointAjax")
     */
    public function indexAction11()
    {
     
        return $this->render('UserBundle:Default:adminLogin.html.twig');
        
    }
    
    
}
