<?php
declare(strict_types=1);

namespace App\Domain\Entity;

final class Invoice
{
    private Order $order;
    private \DateTimeImmutable $createdAt;
    private int $total;

    public function __construct(
        \DateTimeImmutable $invoiceDate,
        Order $order,
        int $total
    ) {
        $this->createdAt = $invoiceDate;
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
        return $this->createdAt;
    }

    public function setInvoiceDate($date): void
    {
        $this->createdAt = $date;
    }

    public function createdAt($invoiceDate): void
    {
        $this->createdAt = $invoiceDate;
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