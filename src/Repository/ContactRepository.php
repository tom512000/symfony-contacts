<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contact>
 *
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * @return Contact[]
     */
    public function search(string $text = ''): array
    {
        return $this->createQueryBuilder('c')
            ->where('c.firstname LIKE :text')
            ->orWhere('c.lastname LIKE :text')
            ->setParameter('text', '%'.$text.'%')
            ->orderBy('c.firstname', 'ASC')
            ->orderBy('c.lastname', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
