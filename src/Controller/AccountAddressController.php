<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface ;
use App\Form\AddressType ; 
use App\Entity\Address ; 

class AccountAddressController extends AbstractController
{
    private $entityManager ; 

    public function __construct(EntityManagerInterface $entityManager){
            $this->entityManager = $entityManager ; 
    }

    public function index()
    {
        
        return $this->render('account/address.html.twig');
    }

    public function create(Request $request)
    {
        $address = new Address(); 
        $form = $this->createForm(AddressType::class, $address) ;

        $form->handleRequest($request) ;

        if($form->isSubmitted() && $form->isValid()){
            $address->setUser($this->getUser()) ;
            $this->entityManager->persist($address) ;
            $this->entityManager->flush() ;
            return $this->redirectToRoute('account_address') ; 
        }
        return $this->render('account/address_add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function update(Request $request, $id)
    {
        $address = $this->entityManager->getRepository(Address::class)->findOneById($id); 
        if(!$address || $address->getUser() != $this->getUser()){
            return $this->redirectToRoute('account_address') ; 
        }

        $form = $this->createForm(AddressType::class, $address) ;

        $form->handleRequest($request) ;

        if($form->isSubmitted() && $form->isValid()){
          
            $this->entityManager->flush() ;
            return $this->redirectToRoute('account_address') ; 
        }
        return $this->render('account/address_add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function delete(Request $request, $id)
    {
        $address = $this->entityManager->getRepository(Address::class)->findOneById($id); 
        if($address || $address->getUser() == $this->getUser()){
             $this->entityManager->remove($address) ; 
             $this->entityManager->flush() ; 
        }

        return $this->redirectToRoute('account_address') ; 

        

    }
}
