<?php

namespace App\Persitence\Doctrine\Repository;

use App\Domain\Repository\RepositoryInteface;
use Doctrine\ORM\EntityManager;
use App\Domain\Entity\AbstractEntity;
use http\Exception\RuntimeException;

abstract class AbstractDoctrineRepository implements RepositoryInteface
{
    private EntityManager $entityManager;
    private $entityClass;

    public function __construct(EntityManager $em)
    {
        if (empty($this->entityClass)) {
            throw new RuntimeException(
                \get_class($this) . '::$entityClass is no defined'
            );
        }
        $this->entityManager = $em;
    }

    /**
     * @param $id
     * @return object|null
     */
    public function getById($id)
    {
        return $this->entityManager->find($this->entityClass, $id);
    }

    /**
     * @return object[]
     */
    public function getAll()
    {
        return $this->entityManager->getRepository($this->entityClass)->findAll();
    }
}