<?php
declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Order;

use App\Domain\Entity\Invoice;

class InvoiceFactory
{

    public function createFromOrder(Order $order)
    {

        $invoice = new Invoice();
        $invoice->setOrder($order);
        $invoice->setInvoiceDate(new \DateTime());
        $invoice->setTotal(500);
      //  var_dump($invoice);
        return $invoice;
    }
}