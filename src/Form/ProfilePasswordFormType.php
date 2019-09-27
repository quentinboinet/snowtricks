<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfilePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('old_password', PasswordType::class, ['label' => 'Ancien mot de passe : ', 'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer un mot de passe.'
                ]),
                new Length([
                    'min' => 5,
                    'minMessage' => 'Votre mot de passe doit contenir au moins 5 caractères.'
                ])
            ]])
            ->add('password', PasswordType::class, ['label' => 'Nouveau mot de passe : ', 'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer un mot de passe.'
                ]),
                new Length([
                    'min' => 5,
                    'minMessage' => 'Votre mot de passe doit contenir au moins 5 caractères.'
                ])
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
