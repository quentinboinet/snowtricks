<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\Trick;
use App\Entity\Video;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TrickEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom de la figure:', 'constraints' => [new NotBlank(['message' => 'Veuillez entrer un nom de figure.']), new Length(['min' => 2, 'max' => 50])]])
            ->add('description', TextareaType::class, ['label' => 'Description :'])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie :',
            ])
            ->add('pictures', CollectionType::class, [
                'entry_type' => PictureAddFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_data' => new Picture(),
                'attr' => ['class' => 'form-inline'],
            ])
            ->add('videos', CollectionType::class, [
                'entry_type' => VideoAddFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_data' => new Video(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
