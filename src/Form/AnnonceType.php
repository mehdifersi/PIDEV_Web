<?php

namespace App\Form;

use App\Entity\Annonce;
use App\Entity\Bien;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('refAnnonce')
            ->add('titreAnnonce')
            ->add('afficheAnnonce', FileType::class, [
                'label' => 'votre affiche   (des fichier image uniquement)',
                'mapped' => false,
                'required' => false,'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                            'image/gif',

                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])





            ->add('dateDepot')
            ->add('refBien',EntityType::class,[

                'class'=>Bien::class,
                'choice_label'=>'RefBien'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
