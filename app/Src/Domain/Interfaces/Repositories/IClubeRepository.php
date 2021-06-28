<?php

namespace App\Src\Domain\Interfaces\Repositories;

use App\Src\Domain\Entities\Clube;

interface IClubeRepository
{
    public function save(Clube $clube) : array;
    public function update(Clube $clube) : array;
    public function delete(int $id) : array;
    public function findById(int $id) : ?array;
    public function all() : array;
}