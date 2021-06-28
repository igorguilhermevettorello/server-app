<?php

namespace App\Src\Domain\FactoryMethods;

use App\Src\Domain\Dto\ClubeDTO;
use App\Src\Domain\Entities\Clube;

abstract class AbstractClubeFactoryMethod {
    abstract static function validateRegisterClub(ClubeDTO $clubeDTO, bool $option) : array;
}

class ClubeFactory extends AbstractClubeFactoryMethod {

    public static function validateRegisterClub(ClubeDTO $clubeDTO, bool $option) : array
    {
        $error = [];
        $clube = null;

        if ($option) {
            if (empty($clubeDTO->Id) || is_null($clubeDTO->Id)) {
                array_push($error, [
                    "field" => "Id",
                    "description" => "Código não identificado."
                ]);
            }
        }

        if (empty($clubeDTO->Nome) || is_null($clubeDTO->Nome)) {
            array_push($error, [
                "field" => "Nome",
                "description" => "Campo nome é obrigatório."
            ]);
        }

        if (empty($error)) {
            $clube = Clube::getInstance(
                $clubeDTO->Id,
                $clubeDTO->Nome
            );
        }

        return [
            "clube" => $clube,
            "error" => $error
        ];
    }
}
