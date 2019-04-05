<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 28-3-2019
 * Time: 14:36
 */

namespace AppBundle\Form;


use AppBundle\Entity\Lesson;
use AppBundle\Entity\Person;
use AppBundle\Entity\Training;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LessonType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('time', TimeType::class, ['placeholder' =>
                ['hour' => 'Hours', 'minute' => 'Minutes' ],
                'minutes' => [00, 15, 30, 45]])
            ->add('date', DateType::class, ['format' => 'dd-MM-yyyy',
                'placeholder' => [
                    'day' => 'Day', 'month' => 'Month', 'year' => 'Year'
                ],
                'years' => range(2019, 2035)
            ])
            ->add('location', TextType::class)
            ->add('maxMembers', IntegerType::class)
            ->add('trainingId', EntityType::class, [
                'class' => Training::class,
                'multiple' => false,
                'choice_label' => function ($trainingId) {
                    return $trainingId->getName();
                }
            ])
            ->add('create', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Lesson::class
        ]);
    }
}