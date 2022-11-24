<?php

namespace App\Form;

use App\Entity\EtatBiens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtatBiensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etat', ChoiceType::class,[
            'choices' => [
        'Note Produit' => [
            'Excellent' => 'Excellent',
            'Bien' => 'Bien',
            'Normal' => 'Normal',
            'Mediocre' => 'Mediocre',
            'Mal' => 'Mal',
        ]]])
            ->add('nombrePannes')
            ->add('description')
            ->add('idBien')
            ->add('confirmer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EtatBiens::class,
        ]);
    }
}
