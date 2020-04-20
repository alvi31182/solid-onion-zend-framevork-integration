<?php


namespace App\Persitence\Zend\DataTable;


use App\Domain\Repository\OrderRepositoryInterface;

class OrderTable extends AbstractDataTable implements OrderRepositoryInterface
{

    public function getUninvoicedOrders()
    {
        return [];
    }
}