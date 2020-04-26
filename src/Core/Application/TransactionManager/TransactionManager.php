<?php declare(strict_types=1);

namespace App\Core\Application\TransactionManager;

use App\Domain\Entity\AbstractEntity;

final class TransactionManager
{
    private TransactionHandlerInterface $transactionHandler;

    public function __construct(TransactionHandlerInterface $transactionHandler)
    {
        $this->transactionHandler = $transactionHandler;
    }

    public function begin()
    {
        // TODO: Implement begin() method.
    }

    public function persist(AbstractEntity $entity)
    {
        // TODO: Implement persist() method.
    }

    public function commit()
    {
        // TODO: Implement commit() method.
    }
}