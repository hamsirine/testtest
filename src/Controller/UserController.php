<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="app_user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/contact", name="app_contact")
     */
    public function Contact(): Response
    {
        return $this->render('user/contact.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


    /**
     * @Route("/profile", name="app_profile")
     */
    public function ResetPassword(): Response
    {
        return $this->render('user/profile.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

//    /**
//     * @param Request $request
//     * @param $dateshm
//     * @param EntityManagerInterface $em
//     * @return Response
//     * @Route("/calendar/{dateshm}", name="datedesuivies")
//
//     */
//    public function suivie(Request $request , $dateshm ,EntityManagerInterface $em): Response
//
//    {
//        $em = $this->getDoctrine()->getManager();
//        $query6 = "
//                      SELECT
//                      *
//                      FROM jour
//                      where date = '".$dateshm."'
//                      ";
//
//        $stmt6 =  $em->getConnection()->prepare($query6);
//        $stmt6 ->execute();
//        $Jour = $stmt6->fetchAll();
//
//        return $this->render('user/calendar2.html.twig', [
//            'Jour'=>$Jour,
//        ]);
//
//    }



}
