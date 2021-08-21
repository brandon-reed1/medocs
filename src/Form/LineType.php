<?php

namespace App\Form;

use App\Entity\Day;
use App\Entity\Dose;
use App\Entity\Line;
use App\Entity\Product;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qty', NumberType::class,['attr'=>[
                'type'=>'number'
            ]])
            ->add('day', EntityType::class, [
                'class' => Day::class
            ])
            ->add('dose', EntityType::class, [
                'class' => Dose::class
            ])
 /*           ->add('doseNew', DoseType::class, array(
                'required' => FALSE,
                'mapped' => FALSE,
                'property_path' => 'item',
            )) */
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Line::class,
        ]);
    }
}
