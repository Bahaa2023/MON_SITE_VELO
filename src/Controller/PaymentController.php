<?php

namespace App\Controller;

use App\Entity\Velos;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="page_payment")
     */
    public function index(): Response
    {
        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }


    /**
     * @Route("/checkout", name="payment_checkout")
     */
    public function checkout($stripeSK, SessionInterface $session, ManagerRegistry $doctrine)
    {
        
        Stripe::setApiKey($stripeSK);

        $panier = $session->get('panier', []);

        $panierData = [];
        foreach($panier as $id => $quantity)
        {
            
            $panierData[] = [
                "product" => $doctrine->getRepository(Velos::class)->find($id),
                "quantity" => $quantity
            ];
        }


        foreach($panierData as $id => $value)
        {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $value['product']->getmodel(),
                    ],
                    'unit_amount' => $value['product']->getPrix()*100, 
                    ],
                    'quantity' => $value['quantity'],                
                ];
        }

        $session = Session::create([
            'line_items' => [
                $line_items 
            ],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        //dd($session);
        return $this->redirect($session->url, 303);
    }

    /**
     * @Route("/payment/success", name="success_url")
     */
    public function successUrl(SessionInterface $session)
    {
        $session->remove('panier');

        return $this->render("payment/success.html.twig");
    }

    /**
     * @Route("/payment/cancel", name="cancel_url")
     */
    public function cancelUrl()
    {
        return $this->render("payment/cancel.html.twig");
    }

}








