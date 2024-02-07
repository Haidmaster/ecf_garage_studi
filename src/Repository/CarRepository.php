<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }


    public function save(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Car $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     *  @return Car[]
     */

    public function findByGearboxes(): array
    {
        // $dql = 'SELECT Car FROM App\Entity\Car as gea ORDER BY car.gearbox';
        $qb = $this->createQueryBuilder('car')
            ->addOrderBy('car.gearbox', Criteria::ASC);

        $query = $qb->getQuery();
        return $query->getResult();
    }

    // public function findByMinPrice($min): array
    // {

    //     return $this->createQueryBuilder('c')
    //         ->andWhere('c.price = :price')
    //         ->setParameter('min', $min)
    //         ->orderBy('price', 'DESC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }
    // public function findByMinPrice($min): array
    // {

    //     return $this->createQueryBuilder('c')
    //         ->andWhere('c.price = :price')
    //         ->setParameter('min', $min)
    //         ->orderBy('price', 'DESC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }
    // public function findByMaxPrice($max): array
    // {
    //     return $this->createQueryBuilder('c')
    //         ->andWhere('c.price = :price')
    //         ->setParameter('max', $max)
    //         ->orderBy('price', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }

    // public function findByOldYears($older): array
    // {
    //     return $this->createQueryBuilder('c')
    //         ->andWhere('c.years = :years')
    //         ->setParameter('older', $older)
    //         ->orderBy('years', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }
    // public function findByNewYears($newer): array
    // {
    //     return $this->createQueryBuilder('c')
    //         ->andWhere('c.years = :years')
    //         ->setParameter('newer', $newer)
    //         ->orderBy('years', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult();
    // }

    //    /**
    //     * @return Car[] Returns an array of Car objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Car
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
