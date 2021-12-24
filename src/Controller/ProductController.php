<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    // Affichage du catalogue de tous les produits
    #[Route('/product', name: 'product')]
    public function index(): Response
    {
        $products = $this->doctrine->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }


    #[Route('admin/product/add', name:"admin_product_add", methods: ["POST", "GET"])]
    public function append(Request $request, ManagerRegistry $mr): Response {

        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        // Si les données sont ok
        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère le nom de l'image avec son extension
            $picture = $form->get('picture')->getData();
            // on génère un nom random et ajoute l'extension de l'image pour faire un nom d'image uniq
            $pictureName = md5(uniqid()).'.'. $picture->guessExtension();

            // On ajoute l'image dans le fichier img/uploads/
            $picture->move(
                $this->getParameter('upload_files'),
                $pictureName
            );
            // on set le nom de l'image avec le nouveau nom
            $product->setPicture($pictureName);

            // On le persist et l'enregistre en BDD
            $em = $mr->getManager();
            $em->persist($product);
            $em->flush();

            // On retourne sur la page des animaux
            return $this->redirectToRoute("admin_product_add");
        }

        // on retourne le template avec le form
        return $this->render("admin/add_product.html.twig", [
            'form' => $form->createView()
        ]);
    }

}
