<?php

namespace App\Repository;

use App\Entity\Line;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Line|null find($id, $lockMode = null, $lockVersion = null)
 * @method Line|null findOneBy(array $criteria, array $orderBy = null)
 * @method Line[]    findAll()
 * @method Line[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Line::class);
    }

    public function getAllUserLines($user_id)
    {
        return $this->createQueryBuilder('l')
            ->leftJoin('l.user', 'user')
            ->andWhere('user.id = :id')
            ->setParameter('id', $user_id)
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function getAll()
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function getCountByUser($user_id)
    {
        return $this->createQueryBuilder('l')
            ->leftJoin('l.user', 'user')
            ->andWhere('user.id = :id')
            ->setParameter('id', $user_id)
            ->select('count(l.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function getCount()
    {
        return $this->createQueryBuilder('l')
            ->select('count(l.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findByUrl($url){
        return $this->createQueryBuilder('l')
            ->leftJoin('l.user', 'u')
            ->select('l')
            ->andWhere('u.url like :url')
            ->setParameter('url', $url)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Line[] Returns an array of Line objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Line
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
