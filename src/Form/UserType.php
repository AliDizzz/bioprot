<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname')
            ->add('name')
            ->add('email')
            ->add(
                'password',
                PasswordType::class,
                [
                  'label' => 'Mot de passe',
                  'attr' => [
                    'placeholder' => 'Veuillez tapez votre mot de passe'
                  ]
                ]
              )
            ->add('hasAcceptedCondition')
            ->add('hasSubscribedNewsletter')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}