<?php

namespace App\Form;

use App\Entity\Grille;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GrilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero1')
            ->add('numero2')
            ->add('numero3')
            ->add('numero4')
            ->add('numero5')
            ->add('numerochance')
            ->add('Jouer', SubmitType::class)
//            ->add('date')
//            ->add('gagnant')
//            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Grille::class,
        ]);
    }
}
