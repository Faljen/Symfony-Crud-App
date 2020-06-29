<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, ['label' => 'Imię'])
            ->add('surname', TextType::class, ["required" => false, 'label' => 'Nazwisko'])
            ->add('dudaVoter', CheckboxType::class, ['required' => false, 'label' => 'Głosuję na Dudę?'])
            ->add('submit', SubmitType::class, ['label' => 'Dodaj użytkownika'])
            ->getForm();
    }
}