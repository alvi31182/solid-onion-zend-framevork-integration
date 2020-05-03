<?php


namespace App\Domain\Service\InputFilter;

use Laminas\InputFilter\InputFilter;
use Laminas\I18n\Validator\IsFloat;
use Laminas\InputFilter\Input;

class OrderInputFilter extends InputFilter
{
    public function __construct()
    {
        $customer = (new InputFilter());
        $id = (new Input('id'))->setRequired(true);
        $customer->add($id);

        $orderNumber = (new Input('order_number'))->setRequired(true);
        $description = (new Input('description'))->setRequired(true);
        $total = (new Input('total'))->setRequired(true);
        $total->getValidatorChain()->attach(new IsFloat());

        $this->add($customer,'customer');
        $this->add($orderNumber);
        $this->add($description);
        $this->add($total);
    }
}