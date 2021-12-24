<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    #[Route('/', name: 'animals')]
    public function index(): Response
    {
        $animals = $this->doctrine->getRepository(Animal::class)->findAll();
        
        return $this->render('admin/index.html.twig', [
            'animals' => $animals,
        ]);
    }

    #[Route('/products', name: 'products')]
    public function adminProducts(): Response
    {
        $product = $this->doctrine->getRepository(Product::class)->findAll();

        return $this->render('admin/products.html.twig', [
            'products' => $product,
        ]);
    }
}
