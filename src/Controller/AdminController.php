<?php

namespace App\Controller;

use App\Form\ResetPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response|void
     * @Route("/admin", name="app_admin")
     */

    public function resetPassword(Request $request)

    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $form = $this->createForm(ResetPasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $passwordEncoder = $this->get('security.password_encoder');

            $oldPassword = $request->request->get('reset_password')['oldPassword'];

            // Si l'ancien mot de passe est bon

            if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {

                $newEncodedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());

                $user->setPassword($newEncodedPassword);



                $em->persist($user);

                $em->flush();

                $this->addFlash('notice', 'Votre mot de passe à bien été changé !');

                return $this->redirectToRoute('admin');

            } else {

                $form->addError(new FormError('Ancien mot de passe incorrect'));

            }

        }



        return $this->render('admin/index.html.twig', array(

            'form' => $form->createView(),

        ));

    }

}



