<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Donation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    // Display template on route /home
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        $animals = $this->doctrine->getRepository(Animal::class)->findByDate();
        $totalDonation = $this->doctrine->getRepository(Donation::class)->findTotalAmount();

        return $this->render('home/index.html.twig', [
            'animals' => $animals,
            'totalDonation' => implode($totalDonation)
        ]);
    }
}
