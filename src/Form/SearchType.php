<?php

namespace App\Form;
use App\Entity\Adresse;
use App\Entity\Agence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
  //  public function configureOptions(OptionsResolver $resolver)
    //{
      //  $resolver->setDefault([
                //configure your form options here
      //  ]);
    //}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',TextType::class,[

            'attr' => [
                'placeholder' => 'Entrée reserch',
                'class'=>TextType::class

            ]])

        ->add ('region',EntityType::class, [
          'class'=> Agence::class,
           'choice_label'=>'region'
        ]);
    }


}