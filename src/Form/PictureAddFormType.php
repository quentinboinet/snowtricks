<?php

namespace App\Form;

use App\Entity\Picture;
use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class PictureAddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'attr' => ['placeholder' => 'Image au format .jpg, .jpeg, .gif, .png', 'class' => 'form-row'],
                'required' => false,
                'label' => false,
                'constraints' => [
        new Image(['maxSize' => '2M', 'maxSizeMessage' => 'Image trop lourde ! (max. 2Mo autorisé)', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'mimeTypesMessage' => 'Seules les images au format .jpg, .jpeg, .png et .gif sont autorisées.'])
        ]])
            ->add('alt', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['class' => 'form-row', 'placeholder' => 'Texte alternatif à afficher']
            ])
        ;
        //TODO : ajouter attribut alt
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
