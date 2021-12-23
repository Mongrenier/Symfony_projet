<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product', name: 'product_')]
class ProductController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    // Affichage du catalogue de tous les produits
    #[Route('/', name: 'list', methods: "GET")]
    public function index(): Response
    {
        $products = $this->doctrine->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'produits' => $products,
        ]);
    }

}
