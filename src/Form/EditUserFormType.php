<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Length;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstName', TextType::class, [
            'label' => 'First Name',
        ])
        ->add('lastName', TextType::class, [
            'label' => 'Last Name',
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email',
        ])
        ->add('phoneNumber', TelType::class, [
            'label' => 'Phone Number',
        ])
        ->add('birthDate', DateType::class, [
            'label' => 'Birth Date',
            'widget' => 'single_text',
        ])
        ->add('userType', ChoiceType::class, [
            'mapped' => false, // We manually handle this in the controller
            'label' => 'I want to:',
            'choices' => [
                'Buy Products' => 'ROLE_BUYER',
                'Sell Products' => 'ROLE_SELLER',
            ],
            'expanded' => false, // Displays as radio buttons
            'multiple' => false,
            'constraints' => [
                new NotBlank(['message' => 'Please select whether you want to buy or sell products.']),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
