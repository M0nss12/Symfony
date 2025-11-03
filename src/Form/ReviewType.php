<?php

namespace App\Form;

use App\Entity\Review;
use App\Entity\Customer;
use App\Entity\Camera;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customer', EntityType::class, [
                'label' => 'Клиент',
                'class' => Customer::class,
                'choice_label' => 'fullName',
                'attr' => ['class' => 'form-select']
            ])
            ->add('camera', EntityType::class, [
                'label' => 'Фотоаппарат',
                'class' => Camera::class,
                'choice_label' => 'model',
                'attr' => ['class' => 'form-select']
            ])
            ->add('rating', ChoiceType::class, [
                'label' => 'Общий рейтинг',
                'choices' => [
                    '1 звезда' => 1,
                    '2 звезды' => 2,
                    '3 звезды' => 3,
                    '4 звезды' => 4,
                    '5 звезд' => 5
                ],
                'attr' => ['class' => 'form-select']
            ])
            ->add('title', TextType::class, [
                'label' => 'Заголовок отзыва',
                'attr' => ['class' => 'form-control']
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Комментарий',
                'attr' => ['class' => 'form-control', 'rows' => 4]
            ])
            ->add('image_quality_rating', ChoiceType::class, [
                'label' => 'Рейтинг качества изображения',
                'choices' => [
                    '1 звезда' => 1,
                    '2 звезды' => 2,
                    '3 звезды' => 3,
                    '4 звезды' => 4,
                    '5 звезд' => 5
                ],
                'required' => false,
                'attr' => ['class' => 'form-select']
            ])
            ->add('ease_of_use_rating', ChoiceType::class, [
                'label' => 'Рейтинг удобства использования',
                'choices' => [
                    '1 звезда' => 1,
                    '2 звезды' => 2,
                    '3 звезды' => 3,
                    '4 звезды' => 4,
                    '5 звезд' => 5
                ],
                'required' => false,
                'attr' => ['class' => 'form-select']
            ])
            ->add('is_verified_purchase', CheckboxType::class, [
                'label' => 'Подтвержденная покупка',
                'required' => false,
                'attr' => ['class' => 'form-check-input']
            ])
            ->add('review_date', DateTimeType::class, [
                'label' => 'Дата отзыва',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}