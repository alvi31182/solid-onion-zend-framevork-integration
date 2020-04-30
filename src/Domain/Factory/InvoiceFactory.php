<?php
declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Invoice;
use App\Domain\Entity\Order;

class InvoiceFactory
{
    public function createFromOrder(Order $order)
    {
        $invoice = new Invoice();
        $invoice->setOrder($order);
        $invoice->setInvoiceDate(new \DateTimeImmutable());
        $invoice->setTotal($invoice->getTotal());

        return $invoice;
    }
}