<?php declare(strict_types=1);


namespace App\Domain\Entity;


class Order
{
    protected $customer;
    protected $ordernumber;
    protected $description;
    protected $total;

    /**
     * @return mixed
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @param $customer
     * @return $this
     */
    public function setCustomer($customer): self
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrdernumber()
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Order
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
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
     * @return Order
     */
    public function setTotal($total): self
    {
        $this->total = $total;
        return $this;
    }


}