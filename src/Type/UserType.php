<?php

namespace App\Type;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, ['label' => 'Imię '])
            ->add('surname', TextType::class, ["required" => false, 'label' => 'Nazwisko '])
            ->add('dudaVoter', CheckboxType::class, ['required' => false, 'label' => 'Głosuję na Dudę? '])
            ->add('country', CountryType::class, ['label' => 'Kraj ', 'required' => false])
            ->add('category', EntityType::class, ['class' => Category::class, 'choice_label' => 'name', 'label' => 'Kategoria '])
            ->add('submit', SubmitType::class, ['label' => 'Dodaj użytkownika'])
            ->getForm();
    }
}