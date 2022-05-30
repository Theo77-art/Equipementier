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

class detailsEquipement extends AbstractController{
    
    /**
     * @Route("/equipementier/showdetails/{id}", name="details")
     */
    public function showDetails(int $id): Response
    {
        $equipement = $this->getDoctrine()
        ->getRepository(Equipement::class)
        ->find($id);

        if(!$equipement){
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('details.html.twig', ['equipement' => $equipement]);

    }
}

?>