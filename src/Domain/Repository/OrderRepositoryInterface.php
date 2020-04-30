<?php declare(strict_types=1);

namespace App\Domain\Repository;


use App\Core\Application\TransactionManager\TransactionHandlerInterface;

interface OrderRepositoryInterface extends ReposytoryRead, TransactionHandlerInterface
{
    public function getUninvoicedOrders();
}