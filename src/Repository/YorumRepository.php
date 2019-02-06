<?php

namespace App\Repository;

use App\Entity\Yorum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Yorum|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yorum|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yorum[]    findAll()
 * @method Yorum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YorumRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Yorum::class);
    }

    // /**
    //  * @return Yorum[] Returns an array of Yorum objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Yorum
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
