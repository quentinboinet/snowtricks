<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class PictureAddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'label' => false,
                'required' => false,
                'constraints' => [
        new Image(['maxSize' => '2M', 'maxSizeMessage' => 'Image trop lourde ! (max. 2Mo autorisé)', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'mimeTypesMessage' => 'Seules les images au format .jpg, .jpeg, .png et .gif sont autorisées.'])
        ]]);
        //TODO : ajouter attribut alt
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
