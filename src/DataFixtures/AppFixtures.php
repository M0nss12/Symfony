<?php

namespace App\DataFixtures;

use App\Entity\Camera;
use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('ru_RU');

        // Создание камер
        $cameras = [];
        $brands = ['Canon', 'Nikon', 'Sony', 'Fujifilm', 'Panasonic', 'Olympus', 'Pentax', 'Leica'];
        $sensorTypes = ['Full-Frame', 'APS-C', 'Micro Four Thirds', 'Medium Format'];

        echo "Создание фотоаппаратов...\n";
        for ($i = 0; $i < 300; $i++) {
            $camera = new Camera();
            $camera->setModel($faker->randomElement($brands) . ' ' . $faker->bothify('?##D'));
            $camera->setBrand($faker->randomElement($brands));
            $camera->setPrice($faker->randomFloat(2, 300, 5000));
            $camera->setMegapixels($faker->numberBetween(12, 60));
            $camera->setSensorType($faker->randomElement($sensorTypes));
            $camera->setWifi($faker->boolean(80));
            $camera->setBluetooth($faker->boolean(60));
            $camera->setDescription($faker->paragraph(3));
            $camera->setStockQuantity($faker->numberBetween(0, 100));

            $manager->persist($camera);
            $cameras[] = $camera;

            if ($i % 50 === 0) {
                echo "Создано {$i} фотоаппаратов...\n";
            }
        }

        // Создание клиентов
        $customers = [];
        echo "\nСоздание клиентов...\n";
        for ($i = 0; $i < 300; $i++) {
            $customer = new Customer();
            $customer->setFirstName($faker->firstName());
            $customer->setLastName($faker->lastName());
            $customer->setEmail($faker->unique()->safeEmail());
            $customer->setPhone($faker->phoneNumber());
            $customer->setAddress($faker->streetAddress());
            $customer->setCity($faker->city());
            $customer->setZipCode($faker->postcode());
            $customer->setRegistrationDate($faker->dateTimeBetween('-2 years', 'now'));
            $customer->setIsActive($faker->boolean(90));

            $manager->persist($customer);
            $customers[] = $customer;

            if ($i % 50 === 0) {
                echo "Создано {$i} клиентов...\n";
            }
        }

        // Создание заказов
        $orderStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $paymentMethods = ['credit_card', 'paypal', 'bank_transfer', 'cash_on_delivery'];

        echo "\nСоздание заказов...\n";
        for ($i = 0; $i < 300; $i++) {
            $order = new Order();
            $order->setCustomer($faker->randomElement($customers));
            $order->setCamera($faker->randomElement($cameras));
            $order->setQuantity($faker->numberBetween(1, 3));
            
            $cameraPrice = $order->getCamera()->getPrice();
            $order->setTotalPrice($cameraPrice * $order->getQuantity());
            
            $order->setStatus($faker->randomElement($orderStatuses));
            $order->setOrderDate($faker->dateTimeBetween('-1 year', 'now'));
            $order->setPaymentMethod($faker->randomElement($paymentMethods));
            $order->setShippingAddress($faker->address());
            $order->setTrackingNumber($faker->boolean(70) ? $faker->bothify('TRK#####') : null);

            $manager->persist($order);

            if ($i % 50 === 0) {
                echo "Создано {$i} заказов...\n";
            }
        }

        // Создание отзывов
        echo "\nСоздание отзывов...\n";
        for ($i = 0; $i < 300; $i++) {
            $review = new Review();
            $review->setCustomer($faker->randomElement($customers));
            $review->setCamera($faker->randomElement($cameras));
            $review->setRating($faker->numberBetween(1, 5));
            $review->setComment($faker->paragraph(2));
            $review->setReviewDate($faker->dateTimeBetween('-1 year', 'now'));
            $review->setTitle($faker->sentence());
            $review->setIsVerifiedPurchase($faker->boolean(80));
            $review->setImageQualityRating($faker->numberBetween(1, 5));
            $review->setEaseOfUseRating($faker->numberBetween(1, 5));

            $manager->persist($review);

            if ($i % 50 === 0) {
                echo "Создано {$i} отзывов...\n";
            }
        }

        echo "\nСохранение данных в базу...\n";
        $manager->flush();
        echo "Готово! Создано 300 записей для каждой таблицы.\n";
    }
}