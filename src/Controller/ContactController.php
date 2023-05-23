<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="page_contact")
     */
    public function contact(ManagerRegistry $doctrine, Request $request, MailerInterface $mailer)
    {
        $contact=new Contact;
        $form =$this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);  
if($form->isSubmitted() && $form->isValid())
{
    $entityManager = $doctrine->getManager();
    $entityManager->persist($contact);
    $entityManager->flush();
    $email = (new TemplatedEmail())
    ->from($contact->geteMail())
    ->to('ryan@example.com')
    ->subject('Demande de contact!')
    ->htmlTemplate('contact/email.html.twig')
   ->context([
    "contact" => $contact
      ]);
    $mailer->send($email);
     $this->addFlash('contact_success', "Le mail a bien été envoyer, on revient vers vous dans le plus brief delai !");
     // note: below the code ( return $this->redirectToRoute('page_contact');) we can décomment it incase i dont need the formulaire de contact to empty after sending the message.
     return $this->redirectToRoute('page_contact');
   
}
           return $this->render('contact/index.html.twig', [
            "form"=>$form->createView()
        ]);
    }    
     
}

            
        


           