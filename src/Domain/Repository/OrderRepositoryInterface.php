<?php declare(strict_types=1);

namespace App\Domain\Repository;


interface OrderRepositoryInterface extends ReposytoryRead
{
    public function getUninvoicedOrders();
}