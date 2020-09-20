<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur", name="auteur")
     */
    public function index()
    {
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
        ]);
    }

    /**
     * @Route("/add-author", name="add_author")
     */
    public function addAuteur(Request $request): Response
    {
        $auteur = new Auteur();

        $form = $this->createForm(AuteurFormType::class, $auteur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();
            $this->addFlash('success', 'Auteur Created! Knowledge is power!');

            return $this->redirectToRoute("authors");
        }

        return $this->render("auteur/auteur-form.html.twig", [
            "form_title" => "Ajouter un auteur",
            "form_author" => $form->createView(),
        ]);
    }

    /**
     * @Route("/auteurs", name="authors")
     */
    public function auteurs()
    {
        //$products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $auteurs = $this->getDoctrine()->getRepository(Auteur::class)->findAll();

        return $this->render('auteur/auteurs.html.twig', [
            "auteurs" => $auteurs,
        ]);
    }
}
