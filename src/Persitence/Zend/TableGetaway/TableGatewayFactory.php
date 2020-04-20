<?php
declare(strict_types=1);

namespace App\Persitence\Zend\TableGetaway;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\HydratorInterface;

class TableGatewayFactory
{
    public function createGeteway
    (
        Adapter $dbAdapter,
        HydratorInterface $hydrator,
        object $object,
        string $table
    )
    {
        $resultSet = new HydratingResultSet($hydrator, $object);
        return new TableGateway($table, $dbAdapter, null, $resultSet);
    }
}