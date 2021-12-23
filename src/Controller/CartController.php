<?php

namespace App\Controller;

use App\Entity\Cart;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    //Récupération des produits du panier
    #[Route('/cart', name: 'cart')]
    public function index(): Response
    {
        $cart = $this->doctrine->getRepository(Cart::class)->findAll();
        return $this->render('cart/index.html.twig', [
            'Cart' => $cart,
        ]);
    }
}
