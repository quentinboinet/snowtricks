<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Nom d\'utilisateur :', 'constraints' => [
        new NotBlank([
            'message' => 'Veuillez entrer un nom d\'utilisateur !',
        ]),
        new Length([
            'min' => 2,
            'minMessage' => 'Votre nom d\'utilisateur doit contenir au moins 2 caractères.',
            ]), ]])
            ->add('email', EmailType::class, ['label' => 'Adresse e-mail :', 'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer une adresse e-mail !',
                ]), ]])
            ->add('plainPassword', PasswordType::class, ['label' => 'Mot de passe :', 'mapped' => false, 'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer un mot de passe !',
                ]),
                new Length([
                    'min' => 5,
                    'minMessage' => 'Votre mot de passe doit contenir au moins 5 caractères.',
                ]),
            ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
