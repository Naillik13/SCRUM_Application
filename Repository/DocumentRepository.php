<?php
/**
 * Created by PhpStorm.
 * User: timotheecorrado
 * Date: 08/12/2017
 * Time: 15:17
 */

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class DocumentRepository extends EntityRepository
{
    public function loadAll($limit = 500, $offset = 0)
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->setFirstResult($offset);
        $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery()->execute();
    }

    public function count()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id)');

        return (int)$queryBuilder->getQuery()->getSingleScalarResult();
    }
}