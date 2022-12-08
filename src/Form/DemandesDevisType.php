<?php

namespace App\Form;

use App\Entity\DemandesDevis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class DemandesDevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('duree')
            ->add('mission')
            ->add('dateCommencement')
            ->add('traiter',ChoiceType::class, ['choices'  => [
                'Yes' => 'oui',
                'No' => 'non',
            ],
            ])
            ->add('idClient')
            ->add('idPrestataire')
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandesDevis::class,
        ]);
    }
}
