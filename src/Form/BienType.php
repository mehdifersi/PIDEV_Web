<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('RefBien',\Symfony\Component\Form\Extension\Core\Type\TextType::class,[
                'label'=> 'RefBien',
                'attr'=> [
                    'placeholder'=>'Merci de définir ref',
                    'class'=>'RefBien'
                ]
            ])
            ->add('typeBien' , ChoiceType::class,[
                'choices' => [
                    'type du bien' => [
                        'maison' => 'maison',
                        'appartement' => 'appartement',
                        'terrain' => 'terrain',
                        'depot' => 'depot',
                        'hotel' => 'hotel',
                        'autre' => 'autre',

                    ]]])
            ->add('prix')
            ->add('surfaceMetre')
            ->add('description')



            ->add('numRue')
            ->add('ville')
            ->add('codePostal')
            ->add('numTel')
            ->add('adresseMail')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
