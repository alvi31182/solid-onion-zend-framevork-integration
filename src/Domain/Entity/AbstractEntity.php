<?php

declare(strict_types=1);

namespace App\Domain\Entity;


abstract class AbstractEntity
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }
}