<?php

namespace App\Form;

use App\Entity\Dose;
use App\Entity\Frequency;
use App\Entity\Moment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('frequency', EntityType::class,[
                'class' => Frequency::class,
                'choice_label' => 'name'
            ])
            ->add('moment', EntityType::class,[
                'class' => Moment::class,
                'choice_label' => 'name'
            ])
            ->add('envoi', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dose::class,
        ]);
    }
}
