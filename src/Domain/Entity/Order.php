<?php declare(strict_types=1);

namespace App\Domain\Entity;

class Order
{
    private $customer;
    private $ordernumber;
    private $description;
    private $total;

    /**
     * @return mixed
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param $customer
     * @return void
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getOrdernumber(): int
    {
        return $this->ordernumber;
    }

    /**
     * @param $ordernumber
     * @return $this
     */
    public function setOrdernumber($ordernumber)
    {
        $this->ordernumber = $ordernumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return void
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     * @return void
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }


}