<?php

namespace App\Controller;

use App\Repository\CameraRepository;
use App\Repository\CustomerRepository;
use App\Repository\OrderRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        CameraRepository $cameraRepository,
        CustomerRepository $customerRepository,
        OrderRepository $orderRepository,
        ReviewRepository $reviewRepository
    ): Response {
        return $this->render('home/index.html.twig', [
            'cameras_count' => $cameraRepository->count([]),
            'customers_count' => $customerRepository->count([]),
            'orders_count' => $orderRepository->count([]),
            'reviews_count' => $reviewRepository->count([]),
            'recent_cameras' => $cameraRepository->findBy([], ['id' => 'DESC'], 6),
        ]);
    }
}