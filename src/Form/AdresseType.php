<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Agence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avenue',TextType::class,[

                'attr' => [
                    'placeholder' => 'Entrée Avenue',
                    'class'=>Adresse::class

                ]])

            ->add('numeroRue',TextType::class,[

                'attr' => [
                    'placeholder' => 'Entrée Numéro Rue',
                    'class'=>Adresse::class

                ]])

            ->add('codePostal',TextType::class,[

                'attr' => [
                    'placeholder' => 'Entrée Code Postal',
                    'class'=>Adresse::class

                ]])

            ->add('id_Agence',EntityType::class,[

                'class'=>Agence::class,
                'choice_label'=>'region'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
