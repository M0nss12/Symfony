<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function findByCamera(int $cameraId): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.camera = :cameraId')
            ->setParameter('cameraId', $cameraId)
            ->orderBy('r.rating', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findHighRatedReviews(int $minRating = 4): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.rating >= :minRating')
            ->setParameter('minRating', $minRating)
            ->orderBy('r.rating', 'DESC')
            ->getQuery()
            ->getResult();
    }
}