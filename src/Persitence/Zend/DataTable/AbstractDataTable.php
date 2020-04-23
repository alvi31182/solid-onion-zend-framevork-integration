<?php declare(strict_types=1);

namespace App\Persitence\Zend\DataTable;


use App\Domain\Entity\AbstractEntity;
use App\Domain\Repository\RepositoryInteface;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Db\TableGateway\TableGateway;

abstract  class AbstractDataTable implements RepositoryInteface
{
    protected TableGateway $getaway;
    protected HydratorInterface $hydrator;

    public function __construct
    (
        TableGateway $gateway,
        HydratorInterface $hydrator
    )
    {
        $this->getaway = $gateway;
        $this->hydrator = $hydrator;
    }

    public function getById($id)
    {
        $result = $this->getaway->select(['id' => intval($id)])->current();
        return $result ? $result : false;
    }

    public function getAll()
    {
        return $this->getaway->select();
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

    public function begin()
    {
        $this->getaway->getAdapter()->getDriver()->getConnection()->beginTransaction();
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