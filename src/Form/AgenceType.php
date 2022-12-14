<?php

namespace App\Form;

use App\Entity\Agence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('region',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=> 'Region',
                'attr'=> [
                    'placeholder'=>'Merci de définir region',
                    'class'=>'region'
                ]
            ])
            ->add('numeroTel',TextType::class,[

                'attr' => [
                    'placeholder' => 'Entrée Le numéro du télephone',
                    'class'=>Agence::class

                ]])
            ->add('email',TextType::class,[

                'attr' => [
                    'placeholder' => 'Entrée Email',
                    'class'=>Agence::class

                ]])
            ->add('webSite',TextType::class,[

                'attr' => [
                    'placeholder' => 'Entrée le Web Site',
                    'class'=>Agence::class

                ]])
            ->add('nomDuResponsable',TextType::class,[

                'attr' => [
                    'placeholder' => 'Entrée Nom Du Responsable',
                    'class'=>Agence::class

                ]])
            ->add('nombreDesEmployees',TextType::class,[

                'attr' => [
                    'placeholder' => 'Entrée Nombre Des Employees',
                    'class'=>Agence::class

                ]])
            ->add('jourDeCreation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agence::class,
        ]);
    }
}
