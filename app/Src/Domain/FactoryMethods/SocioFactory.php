<?php

namespace App\Src\Domain\FactoryMethods;

use App\Src\Domain\Dto\SocioDTO;
use App\Src\Domain\Entities\Socio;

abstract class AbstractSocioFactoryMethod {
    abstract static function validateRegisterSocio(SocioDTO $socioDTO, bool $option) : array;
}

class SocioFactory extends AbstractSocioFactoryMethod {

    public static function validateRegisterSocio(SocioDTO $socioDTO, bool $option) : array
    {
        $error = [];
        $socio = null;

        if ($option) {
            if (empty($socioDTO->Id) || is_null($socioDTO->Id)) {
                array_push($error, [
                    "field" => "Id",
                    "description" => "Código não identificado."
                ]);
            }
        }

        if (empty($socioDTO->Nome) || is_null($socioDTO->Nome)) {
            array_push($error, [
                "field" => "Nome",
                "description" => "Campo nome é obrigatório."
            ]);
        }

        if (empty($error)) {
            $socio = Socio::getInstance(
                $socioDTO->Id,
                $socioDTO->Nome
            );
        }

        return [
            "socio" => $socio,
            "error" => $error
        ];
    }
}
