<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'name',
                'attr' => [
                    'placeholder' => 'product name',
                    'class' => "form-control"
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'description',
                'attr' => [
                    'placeholder' => 'product description...',
                    'class' => "form-control"
                ]
            ])
            ->add('weight', TextType::class, [
                'label' => 'weight',
                'attr' => [
                    'placeholder' => 'weight gm',
                    'class' => "form-control"
                ]
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'stock',
                'attr' => [
                    'placeholder' => '',
                    'class' => "form-control"
                ]
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => 'Ajouter une image'
            ])
            ->add('price', NumberType::class, [
                'label' => 'price',
                'attr' => [
                    'placeholder' => '',
                    'class' => "form-control"
                ]
            ])
            ->add('isVegan', CheckboxType::class, [
                'label' => 'Vegan ? ',
                'attr' => [
                    'class' => "form-check-label"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
