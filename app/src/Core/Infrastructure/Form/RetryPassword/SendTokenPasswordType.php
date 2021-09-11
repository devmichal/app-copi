<?php

namespace App\Core\Infrastructure\Form\RetryPassword;


use App\Core\Application\RetryPassword\UserExist\SendTokenPasswordDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SendTokenPasswordType extends AbstractType
{
    final public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', TextType::class);
    }

    final public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => SendTokenPasswordDTO::class
        ]);
    }

}