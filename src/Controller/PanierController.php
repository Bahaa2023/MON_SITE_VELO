<?php

namespace App\Controller;


use App\Entity\Velos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="page_panier")
     */
    public function panier(SessionInterface $session, ManagerRegistry $doctrine)
    {
        $panier = $session->get('panier', []);


        $panierData = [];
        foreach($panier as $id => $quantity)
        {
            $panierData[] = [
                "velos" => $doctrine->getRepository(Velos::class)->find($id),
                "quantity" => $quantity
              
            ];
        }
        $total = 0;
        foreach($panierData as $id => $value)
        {
            $total += $value['velos']->getPrix() * $value['quantity'];
        }
        $totalQuantity = 0;
        foreach($panierData as $id => $value)
        {
            $totalQuantity += $value['quantity'];
        }


     

       

        return $this->render('panier/index.html.twig', [
            "items" => $panierData,
            "total" => $total,
            "totalQuantity" => $totalQuantity
           
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

        // dd($session->get('panier', []));  
        // this code above is like vardump we can decomment it to see what we have
       
        return $this ->redirectToRoute('page_panier');
    }

 /**
     * @Route("/panier/delete/{id}", name="panier_delete")
     */
    public function delete($id, SessionInterface $session)
    {
        #On récupere la session 'panier' si elle existe - sinon elle est créée avec un tableau vide
        $panier = $session->get('panier', []);
        
        #On supprime de la session celui dont on a passé l'id
        if(!empty($panier[$id]))
        {
            $panier[$id]--;

            if($panier[$id] <= 0)
            {
                unset($panier[$id]); //unset pour dépiler de la session
            }
        }

        #On réaffecte le nouveau panier à la session
        $session->set('panier', $panier);

        #On redirige vers le panier
        return $this->redirectToRoute('page_panier');
    }  


     /**
     * @Route("/panier/clear", name="panier_clear")
     */
    public function clearCart(SessionInterface $session)
    {
        
        $session->remove('panier');

        #On redirige vers le panier
        return $this->redirectToRoute('page_panier');
    }   

}

   

