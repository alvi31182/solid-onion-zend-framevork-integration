<?php declare(strict_types=1);

namespace App\Persitence\Zend\TableGetaway;

use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Hydrator\HydratorInterface;

class TableGatewayFactory
{
    public function createGateway
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