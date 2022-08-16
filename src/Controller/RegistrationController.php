<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Utilisateur;


class RegistrationController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function index(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $repository = $this->getDoctrine()->getRepository(Utilisateur::class);

            $matricule = $request->get('matricule');
            $matricule = $repository->findBy(['Matricule' => $matricule ]);

           

            //$id = $user['id'];
            if ($matricule) {

                // Encode the new users password
                $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

                // Set their role
                $user->setRoles(['ROLE_USER']);

                // Set matricule
                $idmaricule = $matricule[0]->getmatricule();
                $user->setMatricule($idmaricule);

                // Save
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('app_login');
            }

            if (empty($matricule)) {

                return $this->render('registration/register.html.twig', [

                    'form' => $form->createView(),
                    ]);
                // meesage flash ou bien error
            }


        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}