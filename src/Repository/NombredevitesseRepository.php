<?php

namespace App\Repository;

use App\Entity\Nombredevitesse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Nombredevitesse>
 *
 * @method Nombredevitesse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nombredevitesse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nombredevitesse[]    findAll()
 * @method Nombredevitesse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NombredevitesseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nombredevitesse::class);
    }

    public function add(Nombredevitesse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Nombredevitesse $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Nombredevitesse[] Returns an array of Nombredevitesse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Nombredevitesse
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
