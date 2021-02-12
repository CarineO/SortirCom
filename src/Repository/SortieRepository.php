<?php

namespace App\Repository;


use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Sortie::class);
	}
	
	public function searchByFiltre($campus, $search, $date1, $date2, $organisateur, $datepassee)
	{
		$qb = $this->createQueryBuilder('s');
		
		if ($campus) {
			$qb->andWhere('s.campus = :campus');
			$qb->setParameter("campus", $campus);
		}
		if ($search) {
			$qb->andWhere('s.nom = :search');
			$qb->setParameter('search', $search);
		}
		if ($date1) {
			$qb->andWhere('s.dateHeureDebut >= :date1');
			$qb->setParameter('date1', $date1);
		}
		if ($date2) {
			$qb->andWhere('s.dateHeureDebut <= :date2');
			$qb->setParameter('date2', $date2);
		}
		if ($organisateur) {
			$qb->andWhere('s.organisateur = :user');
			$qb->setParameter('user', $organisateur);
		}
		if ($datepassee) {
			$qb->andWhere('s.dateHeureDebut <= CURRENT_DATE()');
			
		}
		
		return $qb->orderBy('s.dateHeureDebut', 'ASC')->getQuery()->getResult();
	}
	
	
	
	
	
	// /**
	//  * @return Sortie[] Returns an array of Sortie objects
	//  */
	/*
	public function findByExampleField($value)
	{
		return $this->createQueryBuilder('s')
			->andWhere('s.exampleField = :val')
			->setParameter('val', $value)
			->orderBy('s.id', 'ASC')
			->setMaxResults(10)
			->getQuery()
			->getResult()
		;
	}
	*/
	
	/*
	public function findOneBySomeField($value): ?Sortie
	{
		return $this->createQueryBuilder('s')
			->andWhere('s.exampleField = :val')
			->setParameter('val', $value)
			->getQuery()
			->getOneOrNullResult()
		;
	}
	*/
}
