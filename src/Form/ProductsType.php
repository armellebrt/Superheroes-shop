<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sku', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => "SKU"
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => "Nom"
            ])
            ->add('price', NumberType::class, [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                'label' => "Prix"
                ])
            ->add('image', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('stock', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;

//        ->add('password', RepeatedType::class, [
//        'type' => PasswordType::class,
//        'first_options'  => ['label' => 'Mot de passe',
//            'attr' => [
//                'class' => 'form-control trapezoid'
//            ],
//        ],
//        'second_options' => ['label' => 'Confirmation du mot de passe',
//            'attr' => [
//                'class' => 'form-control trapezoid'
//            ],
//        ],
//        'invalid_message' => 'form.user.register.errors.passwords_mismatch'
//    ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
