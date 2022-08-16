<?php

namespace App\Repository;

use App\Entity\Jour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Jour>
 *
 * @method Jour|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jour|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jour[]    findAll()
 * @method Jour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Jour::class);

    }
//    public function FindDate($datesirine){
//       $queryBuilder= $this->createQueryBuilder('J')
//            ->from('Jour','J')
//            ->where('J.Date')
//           ->getParameter('datesirine',$datesirine);
//       dd(
//           $datesirine
//       );


//public function findDate(){
//        $qb = $this->createQueryBuilder('J');
//
//
//            return $qb->getQuery()->getResult();

//    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Jour $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Jour $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Jour[] Returns an array of Jour objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jour
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
