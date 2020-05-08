<?php
declare(strict_types=1);

namespace App\Domain\Entity;

final class Invoice extends AbstractEntity
{
    private $order;
    private $invoiceDate;
    private $total;


    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
       $this->order = $order;
    }

    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(\DateTime $date): void
    {
        $this->invoiceDate = $date;
    }


    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total): void
    {
        $this->total = $total;
    }

}