<?php

namespace App\Core\Infrastructure\Form\Task;

use App\Core\Application\Command\Task\CreateTaskDTO;
use App\Core\Domain\Model\Client\Client;
use App\Core\Domain\Model\TypeText\TypeText;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    final public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titleTask', TextType::class)
            ->add('createdAt', TextType::class)
            ->add('deadLineAt', TextType::class)
            ->add('client', EntityType::class, [
                'class' => Client::class,
            ])
                ->add('typeText', EntityType::class, [
                'class' => TypeText::class,
            ])
            ->add('numberCountCharacter', TextType::class)
            ->add('status', CheckboxType::class)
            ;
    }

    final public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
           'data_class' => CreateTaskDTO::class,
        ]);
    }
}
