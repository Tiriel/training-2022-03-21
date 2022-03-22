<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Full name',
                'attr' => ['placeholder' => 'Enter your name...'],
                'required' => false,
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Enter your email...'],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(['message' => 'Please enter a valid email address.']),
                ]
            ])
            ->add('subject', TextType::class, [
                'attr' => ['placeholder' => 'Please enter a subject...'],
                'constraints' => [
                    new Assert\Length(['min' => 5])
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['placeholder' => 'Your message'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
