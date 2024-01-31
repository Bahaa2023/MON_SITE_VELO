<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Gregwar\CaptchaBundle\Type\CaptchaType;





class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sujet', TextType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)

            // below is the code that i added for captcha and above i also inserted: use Gregwar\CaptchaBundle\Type\CaptchaType; 
            // ->add('captcha', CaptchaType::class);
            ->add('captcha', CaptchaType::class, [
                'label' => 'Captcha',
                'attr' => [
                    'class' => 'captcha', // Ajoutez une classe CSS pour personnaliser le style si nécessaire
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
