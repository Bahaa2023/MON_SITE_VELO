<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Taillederoue;
use App\Entity\Velos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// note the use below was added manually 
use App\Form\AddveloType;
use Symfony\Component\HttpFoundation\File\File;

class VelosController extends AbstractController
{
    /**
     * @Route("/gallerie/{id}", name="page_gallerie")
     */
    public function gallerie(ManagerRegistry $doctrine, $id)
    {
        $velos = $doctrine->getRepository(velos::class)->findBy(['categorie' => $id]);
        return $this->render('velos/gallerie.html.twig', [
            'velos' => $velos,
        ]);
    }

    /**
     * @Route("/gallerie/detail/{id}", name="page_detail")
     */
    public function detail($id, ManagerRegistry $doctrine)
    {
        $velo = $doctrine->getRepository(Velos::class)->find($id);

        return $this->render('velos/detail.html.twig', [
            'velo' => $velo,
        ]);
    }

    /**
     * @Route("/velos/list", name="velos_list")
     */
    public function veloslist(ManagerRegistry $doctrine)
    {
        $velos = $doctrine->getRepository(Velos::class)->findAll();
        // $categorie = $doctrine->getRepository(Categorie::class)->findAll();

        return $this->render('velos/list.html.twig', [
            'velos' => $velos,
            // 'categorie' =>$categorie
        ]);
    }



    /**
     * @Route("/velo/add", name="velo_add")
     */
    public function add(ManagerRegistry $doctrine, Request $request)
    {
        $velo = new Velos;
        $newvelo = $this->createForm(AddveloType::class, $velo);
        $newvelo->handleRequest($request);
        if ($newvelo->isSubmitted() && $newvelo->isValid()) {
            $velo->setStock(0);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($velo);
            $entityManager->flush();
            $this->addFlash('add_new_velo', "Un nouveau vélo a bien été ajouté !");
            return $this->redirectToRoute('velos_list');
        }
        return $this->render('velos/add.html.twig', [
            "newvelo" => $newvelo->createView()
        ]);
    }

    /**
     * @Route("/velo/modification/{id}", name="velo_modification")
     */
    public function modification(Request $request, ManagerRegistry $doctrine, $id)
    {
        $velo = $doctrine->getRepository(Velos::class)->find($id);
        $velo->setImageFile(null);
        $velomodification = $this->createForm(AddveloType::class, $velo);
        $velomodification->handleRequest($request);
        if ($velomodification->isSubmitted() && $velomodification->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->flush();
            $this->addFlash('velo_modification_request', "La modification que vous avez effectuée a bien été enregistrée !");
            return $this->redirectToRoute('velos_list');
        }
        return $this->render('velos/modification.html.twig', [
            "velomodification" => $velomodification->createView()
        ]);
    }

    /**
     * @Route("/velo/supprimer/{id}", name="velo_supprimer")
     */
    public function supprimer(ManagerRegistry $doctrine, $id)
    {

        $entityManager = $doctrine->getManager();

        $velo = $doctrine->getRepository(Velos::class)->find($id);

        $entityManager->remove($velo);

        $entityManager->flush();


        $this->addFlash('velo_supprimer_request', " Votre vélo a bien été supprimé !");

        return $this->redirectToRoute('velos_list');
    }
}
