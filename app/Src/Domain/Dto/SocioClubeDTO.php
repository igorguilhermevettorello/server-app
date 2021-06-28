<?php

namespace App\Src\Domain\Dto;

class SocioClubeDTO
{
    public int $SocioId;
    public int $ClubeId;

    public function __construct (
        int $SocioId,
        int $ClubeId
    ) {
        $this->SocioId = $SocioId;
        $this->ClubeId = $ClubeId;
    }

    public function expose()
    {
        return get_object_vars($this);
    }
}