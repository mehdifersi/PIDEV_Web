<?php

namespace App\Form;

use App\Entity\Rapport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idbien')
            ->add('idrdv')
            ->add('daterdv')
            ->add('notebien')
            ->add('etatbien', ChoiceType::class,[
                'choices' =>
                     [
                         'Parfait' => 'Parfait',
                         'Bonne' => 'Bonne',
                         'Passable' => 'Passable',
                         'Médiocre' => 'Médiocre'
                    ]])

            ->add('positionbien', ChoiceType::class,[
                'choices' =>
                    [
                        'Prés' => 'Prés',
                        'Moyenne' => 'Moyenne',
                        'Loin' => 'Loin'
                    ]])


            ->add('voisinagebien', ChoiceType::class,[
                'choices' =>
                    [
                        'Calme' => 'Calme',
                        'Moyenne' => 'Moyenne',
                        'Insupportable' => 'Insupportable'
                    ]])

            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}
