<?php

namespace App\Src\Domain\Dto;

class SocioDTO
{
    public ?int   $Id;
    public string $Nome;

    public function __construct (
        ?int   $Id,
        string $Nome
    ) {
        $this->Id      = $Id;
        $this->Nome    = $Nome;
    }

    public function expose()
    {
        return get_object_vars($this);
    }
}