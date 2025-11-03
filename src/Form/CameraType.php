<?php

namespace App\Form;

use App\Entity\Camera;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CameraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', ChoiceType::class, [
                'label' => 'Бренд',
                'choices' => [
                    'Canon' => 'Canon',
                    'Nikon' => 'Nikon',
                    'Sony' => 'Sony',
                    'Fujifilm' => 'Fujifilm',
                    'Panasonic' => 'Panasonic',
                    'Olympus' => 'Olympus',
                    'Pentax' => 'Pentax',
                    'Leica' => 'Leica'
                ],
                'attr' => ['class' => 'form-select']
            ])
            ->add('model', TextType::class, [
                'label' => 'Модель',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Например: EOS R5']
            ])
            ->add('price', NumberType::class, [
                'label' => 'Цена (€)',
                'scale' => 2,
                'attr' => ['class' => 'form-control', 'step' => '0.01']
            ])
            ->add('megapixels', NumberType::class, [
                'label' => 'Мегапиксели',
                'attr' => ['class' => 'form-control']
            ])
            ->add('sensor_type', ChoiceType::class, [
                'label' => 'Тип сенсора',
                'choices' => [
                    'Full-Frame' => 'Full-Frame',
                    'APS-C' => 'APS-C',
                    'Micro Four Thirds' => 'Micro Four Thirds',
                    'Medium Format' => 'Medium Format'
                ],
                'attr' => ['class' => 'form-select']
            ])
            ->add('wifi', CheckboxType::class, [
                'label' => 'Wi-Fi',
                'required' => false,
                'attr' => ['class' => 'form-check-input']
            ])
            ->add('bluetooth', CheckboxType::class, [
                'label' => 'Bluetooth',
                'required' => false,
                'attr' => ['class' => 'form-check-input']
            ])
            ->add('stock_quantity', NumberType::class, [
                'label' => 'Количество на складе',
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
                'attr' => ['class' => 'form-control', 'rows' => 4]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Camera::class,
        ]);
    }
}