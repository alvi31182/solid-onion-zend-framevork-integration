<?php

declare(strict_types=1);

namespace App\Domain\Entity;


class Customer extends AbstractEntity
{
    protected $name;
    protected $email;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
}