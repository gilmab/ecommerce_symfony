<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface ;
use App\Classe\Cart ; 
use App\Entity\Product ; 

class CartController extends AbstractController
{
    private $entityManager ; 

    public function __construct(EntityManagerInterface $entityManager){
            $this->entityManager = $entityManager ;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(Cart $cart)
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull()
        ]);
    }

    #[Route('/cart/add/{id}', name: 'add_to_cart')]
    public function add(Cart $cart,$id)
    {
        $cart->add($id) ; 
        
        return $this->redirectToRoute('cart') ;
    }

    #[Route('/cart/remove', name: 'remove_my_cart')]
    public function remove(Cart $cart)
    {
        $cart->remove(); 
        
        return $this->redirectToRoute('products') ;
    }

    #[Route('/cart/delete/{id}', name: 'delete_my_cart')]
    public function delete(Cart $cart, $id)
    {
        $cart->delete($id); 
        
        return $this->redirectToRoute('cart') ;
    }

    #[Route('/cart/decrease/{id}', name: 'decrease')]
    public function decrease(Cart $cart, $id)
    {
        $cart->decrease($id); 
        
        return $this->redirectToRoute('cart') ;
    }
    
}
