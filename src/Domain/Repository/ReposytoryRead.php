<?php
declare(strict_types=1);

namespace App\Domain\Repository;


interface ReposytoryRead
{
    public function getById($id);

    public function getAll();
}