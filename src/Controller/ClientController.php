<?php

namespace App\Controller;


use App\Entity\Utilisateur;

use App\Form\UtilisateurType;
use http\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="app_client")
     */
    public function index(): Response
    {
        $Utilisateur = $this->getDoctrine()->getManager()->getRepository(Utilisateur::class)->findAll();
        return $this->render('client/index.html.twig', [
            'U'=>$Utilisateur
        ]);
    }


    /**
     * @Route("/addclient", name="addclient")
     */
    public function addclient(Request $request): Response
    {
        $Utilisateur = new Utilisateur();

        $form = $this->createForm(UtilisateurType::class,$Utilisateur);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Utilisateur);//Add
            $em->flush();

            return $this->redirectToRoute('app_client');
        }
        return $this->render('client/createClient.html.twig',['f'=>$form->createView()]);

    }

    /**
     * @Route("/removeBlog/{id}", name="supp_client")
     */
    public function suppressionBlog(Utilisateur  $utilisateur): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($utilisateur);
        $em->flush();

        return $this->redirectToRoute('app_client');


    }


}
