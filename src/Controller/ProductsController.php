<?php

namespace App\Controller;


use App\Entity\Kern;
use App\Entity\Products;
use App\Form\ProductsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/products/new", name="app_products_new")
     */
    public function new(Request $request)
    {
        $products = new Products();
        $form = $this->createForm(ProductsType::class, $products);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {


                $lines = count(file($brochureFile));
                $Kern =  new Kern() ;
                $Kern-> setTotalTraite($lines );


                $em = $this->getDoctrine()->getManager();
                $em->persist($Kern);
                $em->flush();
//                dd($lines);


                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                //$safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory2'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $products->setBrochureFilesname($newFilename);
                $entityManager->persist($products);
                $entityManager->flush();

            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('app_products_new');
        }

        return $this->render('products/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

