<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, [
            "label" => "Nom de la tâche",
            "required" => true
        ])
        ->add('description')
            // ->add('state')
            ->add('state', ChoiceType::class, [
                'choices'  => Task::STATES,
                'choice_label' => function ($choice, $key, $value) {
                    return $value;
                },
            ])
            // ->add('openDate')
            // ->add('scheduleDate')
            ->add('scheduleDate', DateType::class, [
                "label" => "Pour le",
                'widget' => 'choice',
                'format' => 'dd MM yyyy',
            ]);
            // ->add('closeDate')
            // ->add('project')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
