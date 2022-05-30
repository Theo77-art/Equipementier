<?php
namespace App\Controller;

use App\Entity\Equipement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{   
    /**
     * @Route("/equipementier/add", name="add")
     */

    public function new(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // creates a task object and initializes some data for this example
        $equipement = new Equipement();
        $equipement->setNom('Nom');
        $equipement->setMarque('Marque');
        $equipement->setPrix(0);
        $equipement->setDescription('Description');
        $equipement->setQuantite(0);

        $form = $this->createFormBuilder($equipement)
            ->add('nom', TextType::class)
            ->add('marque', TextType::class)
            ->add('prix', TextType::class)
            ->add('description', TextType::class)
            ->add('quantite', TextType::class) 
            ->add('save', SubmitType::class, ['label' => 'Soumettre l\'équipement'])
            ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $equipement = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($equipement);
                $entityManager->flush();

                return $this->redirectToRoute('add');
            }


            //$form = $this->createForm(TaskType::class, $task);
            return $this->render('page.html.twig', [
                'form' => $form->createView(),
            ]);
    }
}
?>