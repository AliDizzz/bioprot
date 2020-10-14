<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('surname',TextType::class,[
        'label' => 'PRENOM',
        'attr' => [
          'placeholder' => 'votre prenom',
          'class' => "form-control"
        ]
      ])
      ->add('name',TextType::class,[
        'label' => 'NOM',
        'attr' => [
          'placeholder' => 'votre nom',
          'class' => "form-control"
        ]
      ])
      ->add('email',EmailType::class,[
        'label' => 'EMAIL',
        'attr' => [
          'placeholder' => 'votre mail',
          'class' => "form-control"
        ]
      ])
      ->add(
        'password',
        PasswordType::class,
        [
          'label' => 'Mot de passe',
          'attr' => [
            'placeholder' => 'Veuillez tapez votre mot de passe',
            'class' => "form-control"
          ]
        ]
      )
      ->add('hasAcceptedCondition',CheckboxType::class,[
        'label' => 'J\'accepte les condition d\'utilisations',
        'attr' => [
          'placeholder' => 'votre mail',
          'class' => "form-check-label"
        ]
      ])
      ->add('hasSubscribedNewsletter',CheckboxType::class,[
        'label' => 'Je m\'inscris à la newsletter',
        'attr' => [
          'placeholder' => 'votre mail',
          'class' => "form-check-label"
        ]
      ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
