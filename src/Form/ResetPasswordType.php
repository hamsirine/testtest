<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oldPassword', PasswordType::class, array(

                'mapped' => false,
                'label'=> 'Mot de passe actuel',

                'attr'=>[
                    'class'=>'form-control']



            ))

            ->add('password',RepeatedType::class, [
                'type'=>PasswordType::class,
                'first_options'=>[
                    'label'=>'Nouveau mot de passe',
                    'attr'=>[
                        'class'=>'form-control']
                ],
                'second_options'=>[
                    'label'=>'Retapez le nouveau mot de passe',
                    'attr'=>[
                        'class'=>'form-control']
                ]
            ])

            ->add('submit', SubmitType::class, array(

                'label'=> 'Mettre à jour le mot de passe',
                'attr' => array(

                    'class' => 'btn btn-primary w-80'

                )

            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
