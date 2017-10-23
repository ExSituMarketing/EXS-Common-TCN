<?php

namespace exs\TcnCommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => true,
                'max_length' => 255
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Email',
                ],
                'max_length' => 255
            ])
            ->add('sendTo', HiddenType::class, [
                'label' => false,
                'required' => false,
                'max_length' => 255
            ])
            ->add('message', TextType::class, [
                'label' => 'Comments, Questions, Rants, etc.....',
                'required' => true,
                'max_length' => 1000
            ]);
    }
}
