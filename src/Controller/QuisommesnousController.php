<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuisommesnousController extends AbstractController
{
    /**
     * @Route("/quisommesnous", name="page_quisommesnous")
     */
    public function quisommesnous()
    {
        return $this->render('quisommesnous/index.html.twig');
    }
}
