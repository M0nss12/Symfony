<?php

namespace App\Controller;

use App\Entity\Camera;
use App\Form\CameraType;
use App\Repository\CameraRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/camera')]
class CameraController extends AbstractController
{
    #[Route('/', name: 'app_camera_index', methods: ['GET'])]
    public function index(CameraRepository $cameraRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $cameraRepository->createQueryBuilder('c')
            ->orderBy('c.created_at', 'DESC')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('camera/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_camera_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $camera = new Camera();
        $form = $this->createForm(CameraType::class, $camera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($camera);
            $entityManager->flush();

            $this->addFlash('success', 'Фотоаппарат успешно создан!');

            return $this->redirectToRoute('app_camera_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('camera/new.html.twig', [
            'camera' => $camera,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_camera_show', methods: ['GET'])]
    public function show(Camera $camera): Response
    {
        return $this->render('camera/show.html.twig', [
            'camera' => $camera,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_camera_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Camera $camera, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CameraType::class, $camera);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Фотоаппарат успешно обновлен!');

            return $this->redirectToRoute('app_camera_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('camera/edit.html.twig', [
            'camera' => $camera,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_camera_delete', methods: ['POST'])]
    public function delete(Request $request, Camera $camera, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$camera->getId(), $request->request->get('_token'))) {
            $entityManager->remove($camera);
            $entityManager->flush();

            $this->addFlash('success', 'Фотоаппарат успешно удален!');
        }

        return $this->redirectToRoute('app_camera_index', [], Response::HTTP_SEE_OTHER);
    }
}