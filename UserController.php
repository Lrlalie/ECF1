<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends AbstractController
{    
//    initial function index
//    /**
//     * @Route("/user",name="user")
//     */
//    public function index()
//    {
//        return $this->render('user/index.html.twig', [
//            'controller_name' => 'UserController',
//        ]);
//        }
    
    /**
     * @Route("/{home}", name="home")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            "title"=> "HOME",
            "paragraph"=> "Welcome to our site"
        ]);
    }     
    
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
       //Create a user object
        $user= new User();
        
        //instanciate form and bind it with user's fields
        $form = $this->createForm(RegistrationType::class, $user);
        
        //analysis the request (post of user's inputs)
        //Http request
        $form->handleRequest($request);
        
        //if form is submitted and valid then we could registered
        //data in the database
                
        if($form->isSubmitted() && $form->isValid()){
            //encode my password (I reach my password with getPassword method)
            $hash=$encoder->encodePassword($user, $user->getPassword);
            
            //modify my password which is in User and call it : $hash
            //in other words : before persist encode password
            $user->setPassword($hash);
            
            //persist and register data in database
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            
            //redirect to login zone
            return $this->redirectToRoute('login');
            
            //The encoding interface requires us to implement all its methods
            //so implements methods in the Entity User (else : Error)
            //because in security.yaml we have precise App\Entity\User : that's 
            //mean : data there, and symfony makes bind between this code and User
           
        }
        
        //display the form with the template : registration.html.twig
        return $this->render('user/registration.html.twig',[      
               'form'=>$form->createView()
        ]);
          //Enter form in a local variable in charged to create the view
    }

    public function login()
    {
        return $this->render('user/login.html.twig');
    }
    
    /**
     * 
     * @Route("/deconnexion", name="logout")
     */
    //This function doesn't make action
    //in security.yaml : provider logout
    //when the user is redirected to home, he becomes "anonymous" again
        public function logout(){}    
       
    
    

}
