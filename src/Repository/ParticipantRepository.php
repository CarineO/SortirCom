<?php

namespace App\Repository;


use App\Entity\Participant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;



/**
 * @method Participant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participant[]    findAll()
 * @method Participant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participant::class);
    }
	
	public function loadUserByUsername(string $usernameOrEmail)
	{
		$entityManager = $this->getEntityManager();
		
		return $entityManager->createQuery(
			'SELECT p
                FROM App\Entity\Participant p
                WHERE p.pseudo = :query
                OR p.email = :query'
		)
			->setParameter('query', $usernameOrEmail)
			->getOneOrNullResult();
	}


 //   /**
 //    * Used to upgrade (rehash) the user's password automatically over time.
 //    */
 //   public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
 //   {
 //       if (!$user instanceof Participant) {
 //           throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
 //       }

 //       $user->setPassword($newEncodedPassword);
 //       $this->_em->persist($user);
 //       $this->_em->flush();
 //   }

    // /**
    //  * @return Participant[] Returns an array of Participant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Participant
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
