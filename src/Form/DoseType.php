<?php

namespace App\Form;

use App\Entity\Dose;
use App\Entity\Frequency;
use App\Entity\Moment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class DoseType extends AbstractType
{

    protected $em;

    public function __construct(EntityManagerInterface $entityManager){
        $this->em = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('frequency', EntityType::class,[
                'class' => Frequency::class,
                'choice_label' => 'name'
            ])
            ->add('frequencyNew', FrequencyType::class, array(
                'required' => FALSE,
                'mapped' => FALSE,
                'property_path' => 'item',
            ))
            ->add('moment', EntityType::class,[
                'class' => Moment::class,
                'choice_label' => 'name'
            ])
            ->add('envoi', SubmitType::class)
        ;

       $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();
//dump($data['frequencyNew']['name']);

//dump($event);
//dd($data->getFrequency());
//dd($form);
//dd($form->get('frequencyNew')->getData()->getName());

            if (!empty($form->get('frequencyNew')->getData())) {
                $newFrequency = new Frequency();
                $newFrequency->setName($form->get('frequencyNew')->getData()->getName());
                $this->em->persist($newFrequency);
                $this->em->flush();
              //  $data['frequencyNew']['name'] = '';

                $data->setFrequency($newFrequency);
                $event->setData($data);

                /*$form->remove('frequency');

                $form->add('frequencyNew', FrequencyType::class, array(
                    'required' => TRUE,
                    'mapped' => TRUE,
                    'property_path' => 'frequency',
                ));*/
            }
        });

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dose::class,
        ]);
    }


}
