<?php

namespace App\Core\Infrastructure\Form\Wallet;

use App\Core\Application\Command\UserManagement\UserManagementCreate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WalletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bankName', TextType::class)
            ->add('bankNumber', TextType::class)
            ->add('street', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('city', TextType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => UserManagementCreate::class,
        ]);
    }
}
