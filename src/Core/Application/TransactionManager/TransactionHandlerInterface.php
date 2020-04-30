<?php declare(strict_types=1);


namespace App\Core\Application\TransactionManager;

use App\Domain\Entity\AbstractEntity;

interface TransactionHandlerInterface
{
    public function begin();
    public function persist(AbstractEntity $entity);
    public function commit();
}