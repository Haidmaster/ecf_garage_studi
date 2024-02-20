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

    public function findByBrand(): array
    {
        $dql = 'SELECT car FROM App\Entity\Brand as car ORDER BY car.brand';

        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getResult();
    }


    /**
     *  @return Car[]
     */

    public function findByGearboxes(): array
    {
        $dql = 'SELECT car FROM App\Entity\Car as car ORDER BY car.gearbox';

        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getResult();
    }

    /**
     *  @return Car[]
     */

    public function findBynEnergys(): array
    {
        $dql = 'SELECT car FROM App\Entity\Car as car ORDER BY car.energy';

        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getResult();
    }

    /**
     *  @return Car[]
     */

    public function findByMinPrice(): array
    {
        $dql = 'SELECT car FROM App\Entity\Car as car ORDER BY car.price ASC';

        $query = $this->getEntityManager()->createQuery($dql);
        dd($query->getSQL());

        return $query->getResult();
    }

    /**
     *  @return Car[]
     */

    public function findByMaxPrice(): array
    {
        $dql = 'SELECT car FROM App\Entity\Car as car ORDER BY car.price DESC';

        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getResult();
    }


    /**
     *  @return Car[]
     */

    public function findByNewer(): array
    {
        $dql = 'SELECT car FROM App\Entity\Car as car ORDER BY car.year DESC';

        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getResult();
    }

    /**
     *  @return Car[]
     */

    public function findByOlder(): array
    {
        $dql = 'SELECT car FROM App\Entity\Car as car ORDER BY car.year ASC';

        $query = $this->getEntityManager()->createQuery($dql);

        return $query->getResult();
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
