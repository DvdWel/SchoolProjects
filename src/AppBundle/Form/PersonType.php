<?php
/**
 * Created by PhpStorm.
 * User: K2
 * Date: 21-3-2019
 * Time: 11:04
 */

namespace AppBundle\Form;

use AppBundle\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('username', TextType::class, ['label' => 'User name *'])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('firstname', TextType::class, ['label' => 'First name *'])
            ->add('preprovision', TextType::class, ['label' => 'Prefix'])
            ->add('lastname', TextType::class, ['label' => 'Last name *'])
            ->add('dateofbirth', BirthdayType::class, ['label' => 'Date of birth *',
                'format' => 'dd-MM-yyyy',
                'placeholder' => [
                    'day' => 'Day', 'month' => 'Month', 'year' => 'Year'
                ],
            ])
            ->add('gender', ChoiceType::class, ['label' => 'Gender *',
                'choices' => [
                    'man' => 'male',
                    'vrouw' => 'female',
                ]
            ])
            ->add('email', EmailType::class, ['label' => 'E-mail *'])
            ->add('role', ChoiceType::class, ['label' => 'Role *',
                'choices' => [
                    'instructor' => 'instructor',
                    'member' => 'member',
                    'admin' => 'admin',
                ]
            ])
            ->add('hiring_date', DateType::class, ['label' => 'Hiring date (instructor) *',
                'format' => 'dd-MM-yyyy',
                'widget' => 'choice',
                'placeholder' => [
                    'day' => 'Day', 'month' => 'Month', 'year' => 'Year'
                ],
                'years' => range(1889,2019)
            ])
            ->add('salary', MoneyType::class, ['label' => 'Salary (instructor) *',
                    'group' => 'instructor'
                ])
            ->add('street', TextType::class, ['label' => 'Street (member) *'])
            ->add('postalcode', TextType::class, ['label' => 'Postal code (member) *'])
            ->add('place', TextType::class, ['label' => 'Place (member) *'])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Person::class
        ]);
    }
}