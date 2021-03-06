<?php declare(strict_types=1);

namespace App\Domain\Service\InputFilter;

use Laminas\InputFilter\Input;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\EmailAddress;

class CustomerInputFilter extends InputFilter
{
    public function __construct()
    {
        $name  = (new Input('name'))->setRequired(true);
        $email = (new Input('email'))->setRequired(true);
        $email->getValidatorChain()->attach(new EmailAddress());

        $this->add($name);
        $this->add($email);
    }


}