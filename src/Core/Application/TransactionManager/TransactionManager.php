<?php declare(strict_types=1);

namespace App\Core\Application\TransactionManager;

use App\Domain\Entity\AbstractEntity;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Hydrator\HydratorInterface;

final class TransactionManager
{
    private TransactionHandlerInterface $transactionHandler;
    private HydratorInterface $hydrator;
    private TableGateway $getaway;

    public function __construct(
        TransactionHandlerInterface $transactionHandler,
        TableGateway $getaway,
        HydratorInterface $hydrator
    )
    {
        $this->transactionHandler = $transactionHandler;
        $this->getaway = $getaway;
        $this->hydrator = $hydrator;
    }

    public function begin()
    {
        $this->getaway->getAdapter()->getDriver()->getConnection()->beginTransaction();
        return $this;
    }

    public function persist(AbstractEntity $entity)
    {
        $data = $this->hydrator->extract($entity);
        if($this->hasIdentity($entity)){
            $this->getaway->update($data,['id' => $entity->getId()]);
        }else{
            $this->getaway->insert($data);
            $entity->setId($this->getaway->getLastInsertValue());
        }
        return $this;
    }

    public function commit()
    {
        $this->getaway->getAdapter()->getDriver()->getConnection()->commit();
        return $this;
    }

    public function hasIdentity(AbstractEntity $entity)
    {
        return !empty($entity->getId());
    }
}