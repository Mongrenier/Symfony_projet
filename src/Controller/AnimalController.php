<?php

namespace App\Controller;

use App\Entity\Animal;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/animal', name: 'animal_')]
class AnimalController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    // Affichage du catalogue de tous les animaux
    #[Route('/', name: 'list', methods: "GET")]
    public function index(): Response
    {
        $animals = $this->doctrine->getRepository(Animal::class)->findAll();

        return $this->render('animal/index.html.twig', [
            'animals' => $animals,
        ]);
    }

    // Affichage seulement des infos d'un animal après avoir cliqué dessus
    #[Route('/info/{id}', name: "info", methods: "GET")]
    public function info(Animal $animal): Response {

        return $this->render("animal/info.html.twig", [
            "animal" => $animal,
        ]);
    }
}
