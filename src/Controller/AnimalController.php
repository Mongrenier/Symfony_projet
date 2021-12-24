<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Form\UpdateAnimalType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnimalController extends AbstractController
{
    
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    // Affichage du catalogue de tous les animaux
    #[Route('/animal', name: 'animal_list', methods: "GET")]
    public function index(): Response
    {
        $animals = $this->doctrine->getRepository(Animal::class)->findAll();

        return $this->render('animal/index.html.twig', [
            'animals' => $animals,
        ]);
    }

    // Affichage seulement des infos d'un animal après avoir cliqué dessus
    #[Route('/animal/info/{id}', name: "animal_info", methods: "GET")]
    public function info(Animal $animal): Response {

        return $this->render("animal/info.html.twig", [
            "animal" => $animal,
        ]);
    }

    #[Route('admin/add', name:"add", methods: ["POST", "GET"])]
    public function append(Request $request, ManagerRegistry $mr): Response {

        $animal = new Animal;

        $form = $this->createForm(AnimalType::class, $animal);

        $form->handleRequest($request);

        // Si les données sont ok
        if ($form->isSubmitted() && $form->isValid()) {

            $picture = $form->get('picture')->getData();
            $pictureName = md5(uniqid()).'.'. $picture->guessExtension();

            $picture->move(
                $this->getParameter('upload_files'),
                $pictureName
            );
            $animal->setPicture($pictureName);
            $animal->setState(1);

            // On le persist et l'enregistre en BDD
            $em = $mr->getManager();
            $em->persist($animal);
            $em->flush();

            // On retourne sur la page des animaux
            return $this->redirectToRoute("animal_list"); /*TODO Modifier pour rediriger sur interface admin ou autre*/
        }

        return $this->render("animal/add_animal.html.twig", [
            'form' => $form->createView()
        ]);
    }

    #[Route('admin/update/{id}', name:"update", methods: ["GET", "POST"])]
    public function update(Animal $animal, Request $request): Response {

        $form = $this->createForm(UpdateAnimalType::class, $animal);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->doctrine->getManager();

            $em->persist($animal);
            $em->flush();

            //return $this->redirectToRoute("category_single", ['id' => $category->getId()]);
        }

        return $this->render("animal/update.html.twig", [
            'form' => $form->createView()
        ]);
    }

    #[Route('admin/delete/{id}', name:"delete", methods:["GET", "POST"])]
    public function delete(Animal $animal): Response
    {
        $em = $this->doctrine->getManager();
        $em->remove($animal);
        $em->flush();

        return $this->redirectToRoute("animal_list");
    }
}
