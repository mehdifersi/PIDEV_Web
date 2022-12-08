<?php

namespace App\Form;

use App\Entity\DevisService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomClient')
            ->add('nomCommercial')
            ->add('date')
            ->add('valableJusquA')
            ->add('mission')
            ->add('dateCommencement')
            ->add('prixHt', MoneyType::class, [
                'label' => "Montant HT",
                'attr' => [
                    'placeholder' => "Entrez le montant HT",
                    'id' => 'prixht'

                ]
            ])
            ->add('prixTtc', MoneyType::class, [
                'label' => "Total TTC",
                'attr' => [
                    'placeholder' => "Entrez le Total TTC",
                    'id' => 'prixttc',
                    'hidden'=> true
                ]
            ])
            ->add('description')
            ->add('idPrestataitre')
            ->add('idClient')
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DevisService::class,
        ]);
    }
}
