<?php declare(strict_types=1);

namespace App\Domain\Entity;


class Invoice
{
    private Order $order;
    private \DateTimeImmutable $createdAd;
    private int $total;

    public function __construct(
        \DateTimeImmutable $invoiceDate,
        Order $order,
        int $total
    )
    {
        $this->createdAd = $invoiceDate;
        $this->order = $order;
        $this->total = $total;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder($order): void
    {
        $this->order = $order;
    }

    public function getInvoiceDate(): \DateTimeImmutable
    {
        return $this->createdAd;
    }


    public function createdAt($invoiceDate): void
    {
        $this->createdAd = $invoiceDate;
    }


    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal($total): void
    {
        $this->total = $total;
    }

}