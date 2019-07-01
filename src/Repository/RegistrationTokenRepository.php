<?php

namespace App\Repository;

use App\Entity\RegistrationToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RegistrationToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegistrationToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegistrationToken[]    findAll()
 * @method RegistrationToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistrationTokenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RegistrationToken::class);
    }

    // /**
    //  * @return RegistrationToken[] Returns an array of RegistrationToken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RegistrationToken
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
