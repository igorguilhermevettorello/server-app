<?php

namespace App\Src\Domain\Interfaces\Repositories;

use App\Src\Domain\Entities\Socio;

interface ISocioRepository
{
    public function save(Socio $socio) : array;
    public function update(Socio $socio) : array;
    public function delete(int $id) : array;
    public function findById(int $id) : ?array;
    public function all() : array;
}