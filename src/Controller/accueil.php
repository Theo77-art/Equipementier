<?php
namespace App\Controller;

use App\Entity\Equipement;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Repository\EquipementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class accueil extends AbstractController
{
      /**
    *  @var EquipementRepository
    **/

    // Injection des dépendances "Equipement" pour récupérer les colonnes de la table "Equipement"

    private $repository;

    public function __construct(EquipementRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/equipementier/accueil", name="homepage")
     * @Method({"GET", "POST"})
     */
     
    public function show(): Response
    {
       
        $repository = $this->getDoctrine()
        ->getRepository(Equipement::class)
        ->findAll();

        /*if(!$repository){
            throw $this->createNotFoundException(
                'Aucun équipement n a été enregistrer'
            );
        }*/


        return $this->render('tableau.html.twig',
         ["produits" => $repository]);
        
    }

}
?>