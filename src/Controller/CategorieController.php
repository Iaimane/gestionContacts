<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/Categories", name="Categories")
     */
    public function index(CategorieRepository $repo): Response
    {   
        $Categories = $repo->findAll();
        return $this->render('Categorie/listeCategories.html.twig', [
            'Categories' => $Categories,
        ]);
    }


     /**
     * @Route("/Categorie/{id}/{prevCont?}", name="ficheCategorie")
     */
    public function ficheCategorie(CategorieRepository $repo, $id, $prevCont): Response
    {   
        $Categorie= $repo->find($id);
        return $this->render('Categorie/ficheCategorie.html.twig', [
            'Categorie' => $Categorie,
            'prevCont'=>$prevCont,
            // previousCOntact est utilisé pour afficher le bouton "retour" en bas de page
        ]);
    }
}
