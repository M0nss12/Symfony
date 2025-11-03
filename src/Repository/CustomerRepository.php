<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function findActiveCustomers(): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.is_active = true')
            ->orderBy('c.last_name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByCity(string $city): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.city = :city')
            ->setParameter('city', $city)
            ->orderBy('c.last_name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}