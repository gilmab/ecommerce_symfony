<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType ;
use Symfony\Component\Form\Extension\Core\Type\TextType ; 
use Symfony\Component\Form\Extension\Core\Type\CountryType ;
use Symfony\Component\Form\Extension\Core\Type\TelType ;


class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Quel nom souhaitez vous donnez',
                'attr' => [
                    'placeholder' => 'Nommer votre addresse'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Votre nom'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => 'Nommez votre société',
                'attr' => [
                    'placeholder' => '(facultatif) Donner le nom de votre société'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Votre addresse',
                'attr' => [
                    'placeholder' => '7 rue du commerce'
                ]
            ])
            ->add('postal', TextType::class, [
                'label' => 'Votre code postal',
                'attr' => [
                    'placeholder' => 'Entrez votre code postal'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Votre ville',
                'attr' => [
                    'placeholder' => 'Donnez nous votre ville'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Votre pays',
                'attr' => [
                    'placeholder' => 'Donnez moi le nom de votre pays'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Donnez votre numero de téléphone',
                'attr' => [
                    'placeholder' => 'Renseigner votre numéro de téléphone  '
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider mon addresse', 
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ])
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
