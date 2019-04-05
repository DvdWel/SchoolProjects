<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 21-3-2019
 * Time: 11:27
 */

namespace AppBundle\Form;


use AppBundle\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('duration', IntegerType::class, ['label' => 'duration in minutes'])
            ->add('cost', MoneyType::class)
            ->add('submit', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Training::class
        ]);
    }
}