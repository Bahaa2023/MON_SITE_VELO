<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="page_panier")
     */
    public function panier(SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        return $this->render('panier/index.html.twig', [
          
        ]);
    }


     /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function panierAdd($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        
        if(!empty($panier[$id]))
        {
            $panier[$id]++;
        }
        else 
        {
            $panier[$id]=1;
        }
        
        $session->set('panier', $panier);

        dd($session->get('panier', []));  
        // this code above is like vardump we can decomment it to see what we have
    }

}

   

