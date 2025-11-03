<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Customer;
use App\Entity\Camera;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OrderType extends AbstractType
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
            ->add('quantity', NumberType::class, [
                'label' => 'Количество',
                'attr' => ['class' => 'form-control']
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Статус',
                'choices' => [
                    'В ожидании' => 'pending',
                    'В обработке' => 'processing',
                    'Отправлен' => 'shipped',
                    'Доставлен' => 'delivered',
                    'Отменен' => 'cancelled'
                ],
                'attr' => ['class' => 'form-select']
            ])
            ->add('order_date', DateTimeType::class, [
                'label' => 'Дата заказа',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('payment_method', ChoiceType::class, [
                'label' => 'Способ оплаты',
                'choices' => [
                    'Кредитная карта' => 'credit_card',
                    'PayPal' => 'paypal',
                    'Банковский перевод' => 'bank_transfer',
                    'Наличные при получении' => 'cash_on_delivery'
                ],
                'attr' => ['class' => 'form-select']
            ])
            ->add('shipping_address', TextareaType::class, [
                'label' => 'Адрес доставки',
                'required' => false,
                'attr' => ['class' => 'form-control', 'rows' => 3]
            ])
            ->add('tracking_number', TextType::class, [
                'label' => 'Трек номер',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}