<?php

namespace App\Core\Infrastructure\Form\RetryPassword;


use App\Core\Application\RetryPassword\NewPassword\DTO\NewUserPasswordDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewUserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tokenCsrf', TextType::class)
            ->add('userToken', TextType::class)
            ->add('user', TextType::class)
            ->add('newPassword', TextType::class)
            ->add('retryNewPassword', TextType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => NewUserPasswordDTO::class
        ]);
    }

}