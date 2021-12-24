<?php

namespace App\Controller;

use App\Entity\Cart;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart', name: 'cart_')]
class CartController extends AbstractController
{

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    //Récupération des produits du panier
    #[Route('/', name: 'useless')]
    public function index(): Response
    {
        $cart = $this->doctrine->getRepository(Cart::class)->findAll();
        return $this->render('cart/index.html.twig', [
            'Cart' => $cart,
        ]);
    }

    //Suppression d'un obj du panier
    #[Route("/delete/{id}", name: "delete")]
    public function delete(Cart $cart): Response
    {
            $em = $this->doctrine->getManager();
            $em->remove($cart);
            $em->flush();

        return $this->redirectToRoute("cart_useless");
    }

    //Supprime tout le panier
    /*#[Route("/delete/all", name: "deleteEverything")]
    public function deleteEverything(Cart $cart): Response
    {
            $em = $this->doctrine->getManager();
            $em->remove($cart);
            $em->flush();

        return $this->redirectToRoute("cart_useless");
    }*/
}
