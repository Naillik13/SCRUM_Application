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

class UserRepository extends EntityRepository
{
    public function loadAll($limit = 500, $offset = 0)
    {
        $queryBuilder = $this->createQueryBuilder('u');
        $queryBuilder->setFirstResult($offset);
        $queryBuilder->setMaxResults($limit);

        return $queryBuilder->getQuery()->execute();
    }

    public function count()
    {
        $queryBuilder = $this->createQueryBuilder('u');
        $queryBuilder->select('COUNT(u.id)');

        return (int)$queryBuilder->getQuery()->getSingleScalarResult();
    }

    public function select($id)
    {
        $queryBuilder = $this->createQueryBuilder('u');
        $queryBuilder->select($id);

        return $queryBuilder->getQuery()->execute();
    }

    /*
    function getUser(PDO $db, $id)
    {
        $sql = 'SELECT id, username, email FROM user WHERE id = :id'; // :quelque chose correspond aux valeurs qu'on veut remplacer
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }*/
}