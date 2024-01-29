<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType ;
use Symfony\Component\Form\Extension\Core\Type\TextType ; 
use Symfony\Component\Form\Extension\Core\Type\PasswordType ; 
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType ; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType ;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Mon adresse email'
            ])
            
            ->add('firstname', TextType::class, [
                    'disabled' => true,
                    'label' => 'mon nom'
                ])
            ->add('lastname', TextType::class, [
                'disabled' => true, 
                'label' => 'mon prenom'
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Mon mot de passe actuel',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Veuiller saisir votre mot de passe actuel'
                ]
                
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false ,
                'invalid_message' => 'Le mot de passe et la confirmation doivent etre identique',
                'label' => 'Confirmez mon mot de passe',
                'required' => true ,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmer le nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre mot de passe'
                    ]
                    
                    ]

            ]) 
            ->add('submit', SubmitType::class, [
                'label' => "Mettre à jour"
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
