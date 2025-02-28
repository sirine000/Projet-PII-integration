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

class UserType extends AbstractType
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
        ->add('plainPassword', PasswordType::class, [
            'mapped' => false, // Prevent storing plain password directly in DB
            'label' => 'Password',
            'required' => false,
            'attr' => ['autocomplete' => 'new-password', 'class' => 'form-control'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Password is required',
                ]),
                new Length([
                    'min' => 8,
                    'minMessage' => 'Your password must be at least {{ limit }} characters long.',
                ]),
            ],
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
