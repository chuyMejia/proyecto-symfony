<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
            'label' => 'Title'
        ])
        ->add('content', TextareaType::class, [
            'label' => 'Content'
        ])
        ->add('priority', ChoiceType::class, [
            'label' => 'priority',
            'choices'=> array(
                'Alta' => 'high',
                'Medio' => 'medium',
                'Baja' => 'Low'
            )
        ])
        ->add('hours', ChoiceType::class, [
            'label' => 'Horas',  
            'choices'=> array(
               '1' => 1,
               '2' => 2,
               '3' => 3,
               '4' => 4,
               '5' => 5,
               '6' => 6,
                )
        ])
        
        ->add('complete', ChoiceType::class, [
            'choices'  => [
                'No' => false,
                'Sí' => true,
            ],
            'expanded' => true,  // Muestra los valores como checkboxes   
            'attr' => [
                'style' => 'display: flex !important;',
            ],      
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Guardar'
        ]);
    }
}
