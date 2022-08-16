<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Stat;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response|void
     * @Route("/product/new", name="app_product_new")
     */
    public function new(Request $request)
    {
        $ligne=0;

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();
dump($brochureFile);
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {


                $myfile  = fopen($brochureFile, "r") or die("Unable to open file!");

                $i = 0 ;
                while(!feof($myfile)) {

                    $ligne = fgets($myfile);
                    $ligne1= fgets($myfile);
                    $ligne2= fgets($myfile);

                    $ligne = str_replace("\r\n", "", $ligne);
                    $ligne1 = str_replace("\r\n", "", $ligne1);
                    $ligne2 = str_replace("\r\n", "", $ligne2);

                    if($i == 0){
                        $ligne  = str_replace("Nombre de clients   :    ", "", $ligne);
                    }
                    if($i == 0){
                        $ligne1  = str_replace("Nombre de pages     :    ", "", $ligne1) ;

                    }
                    if($i == 0){
                        $ligne2 = str_replace("Nombre d'enveloppes :    ", "", $ligne2);
                    }

                    $i++ ;

                    $Stat =  new Stat() ;
                    $Stat-> setTotal($ligne );
                    $Stat-> setPages($ligne1 );
                    $Stat-> setEnveloppes ($ligne2);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($Stat);
                    $em->flush();
//                    dd($Stat);


//                      dump($ligne);

                }
                fclose($myfile);
                die();




                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                //$safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $product->setBrochureFilename($newFilename);
                $entityManager->persist($product);
                $entityManager->flush();

            }

            // ... persist the $product variable or any other work

            return $this->redirectToRoute('app_product_new');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
