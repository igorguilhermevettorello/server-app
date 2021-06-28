<?php

namespace App\Src\Domain\Services;

use App\Src\Domain\FactoryMethods\SocioFactory;
use App\Src\Domain\Dto\SocioDTO;
use App\Src\Infrastructure\Repositories\SocioRepository;

class SocioService
{
    private SocioRepository $socioRepository;

    public function __construct (
        SocioRepository $socioRepository
    ) {
        $this->socioRepository = $socioRepository;
    }

    public function save(SocioDTO $socioDTO) : array
    {

        $dados = SocioFactory::validateRegisterSocio($socioDTO, false);

        if (!empty($dados["error"])) {
            return $dados;
        }

        $dados = $this->socioRepository->save($dados["socio"]);

        return $dados;
    }

    public function getAll() : array
    {
        return $this->socioRepository->all();
    }

    public function getById(int $id) : array
    {
        return $this->socioRepository->findById($id);
    }

    public function update(SocioDTO $socioDTO) : array
    {
        $dados = SocioFactory::validateRegisterSocio($socioDTO, true);

        if (!empty($dados["error"])) {
            return $dados;
        }

        $dados = $this->socioRepository->update($dados["socio"]);

        return $dados;
    }

    public function delete(int $id) : array
    {
        return $this->socioRepository->delete($id);
    }
}