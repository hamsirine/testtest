<?php

namespace App\Controller;
use App\Entity\Date;
use App\Form\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DateController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     * @Route("/date", name="date")
     */
    public function index(Request $request): Response
    {

        $date = new Date();
        $form = $this->createForm(DateType::class, $date);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $File */
            $File = $form->get('brochure')->getData();


            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($File) {
                $originalFilename = pathinfo($File->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $File->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $File->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $date->setFile($newFilename);
            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('app_file_list');
        }

        return $this->render('date/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
