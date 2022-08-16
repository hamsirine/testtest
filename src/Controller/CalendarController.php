<?php

namespace App\Controller;

use App\Entity\Jour;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityManagerInterface;


class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar", name="app_calendar")
     */
    public function index(): Response
    {
        return $this->render('calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }

    /**
     * @param Request $request
     * @param $datesirine
     * @param EntityManagerInterface $em
     * @return Response
     * @Route("/calendar/{datesirine}", name="datedesuivie")
     */

    public function suivie(Request $request, $datesirine, EntityManagerInterface $em): Response

    {
        $em = $this->getDoctrine()->getManager();
        $query6 = "
                      SELECT
                      *
                      FROM jour
                      where date = '" . $datesirine . "'
                      ";

        $stmt6 = $em->getConnection()->prepare($query6);
        $stmt6->execute();
        $Jour = $stmt6->fetchAll();

//
//                $Jour = new Jour();
//                $form = $this->createForm(UploadType::class, $Jour);

        return $this->render('calendar/index2.html.twig', [
            'Jour' => $Jour,
//            array(
//                'form'=>$form->createView(),
//            )
        ]);

    }

    /**
     * @Route("/removeBlog/{id}", name="supp_ligne")
     */
    public function suppressionBlog(Jour $jour): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($jour);
        $em->flush();

        return $this->redirectToRoute('datedesuivie');


    }
}
