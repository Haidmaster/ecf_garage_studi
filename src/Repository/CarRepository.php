<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    public function findByModel($modelId = null): array
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->leftJoin('c.model', 'm');

        if ($modelId !== null) {
            $queryBuilder->where('m.id = :modelId')
                ->setParameter('modelId', $modelId);
        }

        return $queryBuilder->getQuery()->getResult();
    }
    public function findByGearbox($gearboxId = null): array
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->leftJoin('c.gearbox', 'g');

        if ($gearboxId !== null) {
            $queryBuilder->where('g.id = :gearboxId')
                ->setParameter('gearboxId', $gearboxId);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function findByEnergy($energyId = null): array
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->leftJoin('c.energy', 'e');

        if ($energyId !== null) {
            $queryBuilder->where('e.id = :energyId')
                ->setParameter('energyId', $energyId);
        }

        return $queryBuilder->getQuery()->getResult();
    }

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
