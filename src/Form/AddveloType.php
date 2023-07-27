<?php

namespace App\Form;

use App\Entity\Capacitebatterie;
use App\Entity\Categorie;
use App\Entity\Motorisation;
use App\Entity\Nombredevitesse;
use App\Entity\Positiondebatterie;
use App\Entity\Taillederoue;
use App\Entity\Velos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AddveloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', TextType::class)

            ->add('prix', IntegerType::class)

            // ->add('images', filetype::class)

            ->add('description', TextareaType::class)

            #note below when we start typing the EntityType we must choose the 3rd choice. 
            ->add('categorie', EntityType::class, [
                'required' => false,
                'class' => Categorie::class,
                'choice_label' => 'velocategorie'
            ])

            ->add('roues', EntityType::class, [
                'required' => false,
                'class' => Taillederoue::class,
                'choice_label' => 'taille_roue'
            ])

            ->add('capacitebatterie', EntityType::class, [
                'required' => false,
                'class' => Capacitebatterie::class,
                'choice_label' => 'capacitebatterie'
            ])


            ->add('positiondebatterie', EntityType::class, [
                'required' => false,
                'class' => Positiondebatterie::class,
                'choice_label' => 'positionbatterie'
            ])

            ->add('motor', EntityType::class, [
                'required' => false,
                'class' => Motorisation::class,
                'choice_label' => 'taille_motor'
            ])

            ->add('vitesse', EntityType::class, [
                'required' => false,
                'class' => Nombredevitesse::class,
                'choice_label' => 'nombre_vitesse'
            ])

            ->add('imageFile', FileType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Velos::class,
        ]);
    }
}
