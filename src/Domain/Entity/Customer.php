<?php declare(strict_types=1);

namespace App\Domain\Entity;

final class Customer extends AbstractEntity
{
    private string $name;
    private string $email;

    public function getName(): string
    {
        return (string) $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return (string) $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }
}