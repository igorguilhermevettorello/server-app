<?php

namespace App\Src\Domain\Interfaces\Repositories;

use App\Src\Domain\Entities\SocioClube;

interface ISocioClubeRepository
{
    public function save(SocioClube $socioClube) : array;
}