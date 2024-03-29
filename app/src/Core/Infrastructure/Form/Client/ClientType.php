<?php

namespace App\Core\Infrastructure\Form\Client;

use App\Core\Application\Command\Client\CreateClientDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    final public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('city', TextType::class)
            ->add('street', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('taxNumber', TextType::class)
            ->add('salary', TextType::class)
            ->add('gross', CheckboxType::class)
            ;
    }

    final public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => CreateClientDTO::class,
        ]);
    }
}
