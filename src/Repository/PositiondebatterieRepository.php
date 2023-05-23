<?php

namespace App\Repository;

use App\Entity\Positiondebatterie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Positiondebatterie>
 *
 * @method Positiondebatterie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Positiondebatterie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Positiondebatterie[]    findAll()
 * @method Positiondebatterie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PositiondebatterieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Positiondebatterie::class);
    }

    public function add(Positiondebatterie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Positiondebatterie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Positiondebatterie[] Returns an array of Positiondebatterie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Positiondebatterie
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
