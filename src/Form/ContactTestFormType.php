<?php

namespace App\Form;

use App\Entity\Contacttest;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;



class ContactTestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Your name',
                    'class' => 'common-input'
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your name'
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 255
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Your email',
                    'class' => 'common-input'
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your email'
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 255
                    ])
                ]
            ])
            ->add('number', TextType::class, [
                'attr' => [
                    'placeholder' => 'Your message',
                    'class' => 'common-input'
                ],
                'label' => false
            ])

            ->add('subject', TextType::class, [
                'attr' => [
                    'placeholder' => 'Subject',
                    'class' => 'common-input'
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your subject'
                    ]),

                ]
            ])

            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Your message',
                    'class' => 'common-input'
                ],
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your message'
                    ]),

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contacttest::class
        ]);
    }
}
