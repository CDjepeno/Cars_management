<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Prenom",
                "attr" => [
                    "placeholder" => "Entrez votre prénom"
                ]
            ])
            ->add('password', PasswordType::class,[
                "label" => "mot de passe",
                "attr" => [
                    "placeholder" => "Entrez votre mot de passe"
                ]
            ])
            ->add('passwordConfirm', PasswordType::class,[
                "label" => "Confirmation mot de passe",
                "attr" => [
                    "placeholder" => "Confirmez votre mot de passe"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
