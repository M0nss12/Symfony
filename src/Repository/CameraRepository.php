<?php

namespace App\Repository;

use App\Entity\Camera;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CameraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Camera::class);
    }

    public function findByBrand(string $brand): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.brand = :brand')
            ->setParameter('brand', $brand)
            ->orderBy('c.price', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findInStock(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.stock_quantity > 0')
            ->orderBy('c.brand', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByPriceRange(float $minPrice, float $maxPrice): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.price >= :minPrice')
            ->andWhere('c.price <= :maxPrice')
            ->setParameter('minPrice', $minPrice)
            ->setParameter('maxPrice', $maxPrice)
            ->orderBy('c.price', 'ASC')
            ->getQuery()
            ->getResult();
    }
}