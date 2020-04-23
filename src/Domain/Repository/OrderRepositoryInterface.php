<?php declare(strict_types=1);

namespace App\Domain\Repository;


interface OrderRepositoryInterface extends RepositoryInteface
{
    public function getUninvoicedOrders();
}