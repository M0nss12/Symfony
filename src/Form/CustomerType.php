<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name', TextType::class, [
                'label' => 'Имя',
                'attr' => ['class' => 'form-control']
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Фамилия',
                'attr' => ['class' => 'form-control']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'form-control']
            ])
            ->add('phone', TextType::class, [
                'label' => 'Телефон',
                'attr' => ['class' => 'form-control']
            ])
            ->add('address', TextType::class, [
                'label' => 'Адрес',
                'attr' => ['class' => 'form-control']
            ])
            ->add('city', TextType::class, [
                'label' => 'Город',
                'attr' => ['class' => 'form-control']
            ])
            ->add('zip_code', TextType::class, [
                'label' => 'Почтовый индекс',
                'attr' => ['class' => 'form-control']
            ])
            ->add('registration_date', DateType::class, [
                'label' => 'Дата регистрации',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('is_active', CheckboxType::class, [
                'label' => 'Активен',
                'required' => false,
                'attr' => ['class' => 'form-check-input']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}