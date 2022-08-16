<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    //Affichage

    /**
     * @param StudentRepository $repository
     * @return Response
     * @Route("/AfficheStud", name="AfficheStud")
     */
    public function AfficheS(StudentRepository $repository){
        $student=$repository->findAll();
        return $this->render('student/Affiche.html.twig',[
            'student'=>$student
        ]);

    }

    //Suppression

    /**
     * @Route("/delete/{id}", name="delete")
     */
    function delete($id, StudentRepository $repository){
        $student=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute('AfficheStud');
    }

//Update

    /**
     * @param StudentRepository $repository
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/student/update/{id}", name="Update")
     */
    function Update(StudentRepository $repository,$id, Request $request){
        $student=$repository->find($id);
        $form=$this->createForm(StudentType::class, $student);
        $form->add('update', SubmitType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficheStud');
        }
        return $this->render('student/update.html.twig',[
            'f'=>$form->createView()
        ]);
    }


    //Ajout

    /**
     * @param Request $request
     * @Route("/student/Ajout", name="Ajout")
     */

    function Ajout(Request $request){
        $student= new Student();
        $form=$this->createForm(StudentType::class, $student);
        $form->add('ajouter', SubmitType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('AfficheStud');
        }
return $this->render('student/add.html.twig',[
    'form'=>$form->createView()
]);


    }




}
