<?php

namespace App\Src\Domain\Entities;

class SocioClube {

    private static ?self $instance = null;


    public int $SocioId;
    public int $ClubeId;

    private function __construct (
        int $SocioId,
        int $ClubeId
    ) {
        $this->SocioId = $SocioId;
        $this->ClubeId = $ClubeId;
    }

    public static function getInstance(
        int $SocioId,
        int $ClubeId
    ) {
        self::$instance = new static(
            $SocioId,
            $ClubeId
        );

        return self::$instance;
    }

    public function getDataSave() : array
    {
        return [
            "SocioId" => $this->SocioId,
            "ClubeId" => $this->ClubeId
        ];
    }
}