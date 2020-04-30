<?php
declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\AbstractEntity;

interface RepositoryInteface
{
    public function getById($id);

    public function getAll();

    public function begin();

    public function persist(AbstractEntity $entity);

    public function commit();
}