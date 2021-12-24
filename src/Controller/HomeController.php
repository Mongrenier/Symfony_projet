<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Donation;
use App\Form\DonationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home', name: 'home_')]
class HomeController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    // Display template on route /
    #[Route('/', name: 'route')]
    public function index(Request $request, ManagerRegistry $mr): Response
    {
        $animals = $this->doctrine->getRepository(Animal::class)->findByDate();
        $totalDonation = $this->doctrine->getRepository(Donation::class)->findTotalAmount();

        $donation = new Donation;

        $form = $this->createForm(DonationType::class, $donation);

        $form->handleRequest($request);

        // Si les données sont ok
        if ($form->isSubmitted() && $form->isValid()) {

            $donation->setDate(new \DateTime());
            // On le persist et l'enregistre en BDD
            $em = $mr->getManager();
            $em->persist($donation);
            $em->flush();

            // On retourne sur la page des animaux
            return $this->redirectToRoute('home_route'); /*TODO Modifier pour rediriger sur interface admin ou autre*/
        }

        return $this->render('home/index.html.twig', [
            'animals' => $animals,
            'totalDonation' => implode($totalDonation),
            'form' => $form->createView()
        ]);
    }
}
