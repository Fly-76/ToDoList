<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Titre du projet",
                "required" => true
            ])
            ->add('description')
            // ->add('state')
            ->add('state', ChoiceType::class, [
                "label" => "Etat",
                'choices'  => Project::STATES,
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
            // ->add('isArchived')
            // ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
