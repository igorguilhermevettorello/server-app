<?php

namespace App\Src\Domain\Services;

use App\Src\Domain\FactoryMethods\ClubeFactory;
use App\Src\Domain\Dto\ClubeDTO;
use App\Src\Infrastructure\Repositories\ClubeRepository;

class ClubeService
{
    private ClubeRepository $clubeRepository;

    public function __construct (
        ClubeRepository $clubeRepository
    ) {
        $this->clubeRepository = $clubeRepository;
    }

    public function save(ClubeDTO $clubeDTO) : array
    {

        $dados = ClubeFactory::validateRegisterClub($clubeDTO, false);

        if (!empty($dados["error"])) {
            return $dados;
        }

        $dados = $this->clubeRepository->save($dados["clube"]);

        return $dados;
    }

    public function getAll() : array
    {
        return $this->clubeRepository->all();
    }

    public function getById(int $id) : array
    {
        return $this->clubeRepository->findById($id);
    }

    public function update(ClubeDTO $clubeDTO) : array
    {
        $dados = ClubeFactory::validateRegisterClub($clubeDTO, true);

        if (!empty($dados["error"])) {
            return $dados;
        }

        $dados = $this->clubeRepository->update($dados["clube"]);

        return $dados;
    }

    public function delete(int $id) : array
    {
        return $this->clubeRepository->delete($id);
    }
}