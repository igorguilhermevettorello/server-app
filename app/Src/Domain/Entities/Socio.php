<?php

namespace App\Src\Domain\Entities;

class Socio {

    private static ?self $instance = null;

    public ?int   $Id;
    public string $Nome;

    private function __construct (
        ?int   $Id,
        string $Nome,
    ) {
        $this->Id      = $Id;
        $this->Nome    = $Nome;
    }

    public static function getInstance(
        ?int   $Id,
        string $Nome
    ) {
        self::$instance = new static(
            $Id,
            $Nome
        );

        return self::$instance;
    }

    public function setId(int $Id) : self
    {
        $this->Id = $Id;
        return $this;
    }

    public function getDataSave() : array
    {
        return [
            "Id"   => $this->Id,
            "Nome" => $this->Nome
        ];
    }
}