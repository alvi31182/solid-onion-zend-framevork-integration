<?php declare(strict_types=1);

namespace App\Domain\Repository;

use App\Core\Application\TransactionManager\TransactionHandlerInterface;

interface CustomerRepositoryInterface extends TransactionHandlerInterface, ReadReposytoryInterface
{
}