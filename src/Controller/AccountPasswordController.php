<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ChangePasswordType ;
use Symfony\Component\HttpFoundation\Request ;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface ;
use Doctrine\ORM\EntityManagerInterface ;


class AccountPasswordController extends AbstractController
{
    private $entityManager ; 
    public function __construct(EntityManagerInterface $entityManager ) {
        $this->entityManager = $entityManager ; 

    }
    #[Route('/password', name: 'app_account_password')]
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $notification = null ;
        $user = $this->getUser() ;
        $form = $this->createForm(ChangePasswordType::class, $user) ;

        $form->handleRequest($request) ;
        
        if($form->isSubmitted() && $form->isValid()){
            $old_pwd = $form->get('old_password')->getData() ;
            
            if($encoder->isPasswordValid($user, $old_pwd)){
                   $new_pwd = $form->get('new_password')->getData() ; 
                   $password = $encoder->encodePassword($user, $new_pwd) ; 

                   $user->setPassword($password) ;
                   
                   
                   $this->entityManager->flush() ; 
                   $notification = "Votre mot de passe a été mis a jour" ;

            }else {
                 $notification ="Votre mot de passe n'est pas bons" ; 
            }

        }

        return $this->render('compte/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
