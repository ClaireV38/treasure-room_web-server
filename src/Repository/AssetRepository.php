<?php

namespace App\Repository;

use App\Entity\Asset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Asset|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asset|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asset[]    findAll()
 * @method Asset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asset::class);
    }

    /**
     * @return Asset[] Returns an array of Asset objects
     */
    public function findAllOrderByNbVotes()
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.voters', 'v')
            ->groupBy('a')
            ->orderBy('COUNT(DISTINCT v)', 'DESC')
            ->getQuery()
            ->getResult();
    }


    /**
     * @param $category
     * @param $owner
     * @return Asset[] Returns an array of Asset objects
     */
    public function findByCategoryOwner($category, $owner)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.category = :category')
            ->setParameter('category', $category)
            ->andWhere('a.owner = :owner')
            ->setParameter('owner', $owner)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Asset
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
*/
}
