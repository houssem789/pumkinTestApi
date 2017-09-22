<?php
/**
 * Created by PhpStorm.
 * User: pierrick
 * Date: 20/06/2017
 * Time: 12:19
 */

namespace AppBundle\Repository\Transaction;


use AppBundle\Entity\User\User;
use Doctrine\ORM\EntityRepository;

/**
 * Class TransactionRepository
 * @package AppBundle\Repository\Transaction
 */
class TransactionRepository extends EntityRepository
{
    /**
     * Find transactions for given user
     *
     * @param User $user
     * @return array
     */
    public function findByUser(User $user)
    {
        $qb = $this->createQueryBuilder('t');

        $qb->where('t.owner = :user');
        $qb->orWhere('t.creditedPerson = :user');
        $qb->orWhere('t.debitedPerson = :user');

        $qb->setParameter('user', $user);

        return $qb->getQuery()->getResult();
    }
}