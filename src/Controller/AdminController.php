<?php

namespace App\Controller;

use App\Entity\Animal;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $animals = $this->doctrine->getRepository(Animal::class)->findAll();
        
        return $this->render('admin/index.html.twig', [
            'animals' => $animals,
        ]);
    }
}
