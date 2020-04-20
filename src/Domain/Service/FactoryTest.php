<?php
declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Factory\InvoiceFactory;
use App\Domain\Entity\Order;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase{

    public function testCreateFromOrder()
    {
        $order = new Order();
        $factory = new InvoiceFactory();
        $invoice = $factory->createFromOrder($order);
        $this->assertEquals($order, $factory->createFromOrder($order),'Eys');
    }

}

/*

    describe('InvoiceFactory',function (){
        describe('->createFromOrder()', function (){
            it('should return an order object', function (){
                $order = new Order();
                $factory = new InvoiceFactory();
                $invoice = $factory->createFromOrder($order);
                    expect($invoice)->to->be->instanceof(
                        'App\Domain\Entity\Invoice'
                    );
            });
            it('should set the total of the invoice', function (){
                $order = new Order();
                $order->setTotal(500);
                $factory = new InvoiceFactory();
                $invoice = $factory->createFromOrder($order);
                    expect($invoice->getOrder())->to->equal(500);
            });

            it('should associate the Order to the Invoice',function (){
                $order = new Order();
                $factory = new InvoiceFactory();
                $invoice = $factory->createFromOrder($order);
                expect($invoice->getOrder())->to->equal($order);
            });

            it('should set the date of the Invoice', function (){
                $order = new Order();
                $factory = new InvoiceFactory();
                $invoice = $factory->createFromOrder($order);
                expect($invoice->getInvoiceDate())->to->loosely->equal(new \DateTime());
            });
        });
    });*/
