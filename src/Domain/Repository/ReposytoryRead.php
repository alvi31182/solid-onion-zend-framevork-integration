<?php


namespace App\Domain\Repository;


interface ReposytoryRead
{
    public function getById($id);
    public function getAll();
}