<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Order extends AbstractEntity
{
    private $customer;
    private $ordernumber;
    private $description;
    private $total;

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param $customer
     * @return void
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
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
     * @return void
     */
    public function setOrdernumber($ordernumber)
    {
        $this->ordernumber = $ordernumber;
    }

    /**
     * @return mixed
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTotal(): ?string
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     * @return void
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }


}