<?php

namespace App\Repository;

use App\Entity\Breed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Breed>
 *
 * @method Breed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Breed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Breed[]    findAll()
 * @method Breed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BreedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Breed::class);
    }

    /**
     * @param Breed[] $results
     * @return array
     */
    public static function toArray(array $results): array
    {
        $breeds = [];

        foreach ($results as $result) {
            $breeds[] = $result->getAsArray();
        }

        return $breeds;
    }

//    /**
//     * @return Breed[] Returns an array of Breed objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Breed
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
