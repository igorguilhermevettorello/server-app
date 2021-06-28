<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function pr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    public function isDate($date) {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            $dt = explode("-", $date);
            return checkdate(intval($dt[1]), intval($dt[2]), intval($dt[0]));
        } else {
            return false;
        }
    }

    public function isInteger($input){
        return(ctype_digit(strval($input)));
    }

    public function beforeSave($aluno) {
        $error = [];

        if (empty($aluno["nome"])) {
            array_push($error, [
                "campo" => "nome",
                "descricao" => "O campo nome é obrigatório."
            ]);
        }

        if (strlen($aluno["sexo"]) == 0) {
            array_push($error, [
                "campo" => "sexo",
                "descricao" => "O campo nome é obrigatório."
            ]);
        } else if (strlen($aluno["sexo"]) >= 2) {
            array_push($error, [
                "campo" => "sexo",
                "descricao" => "Dado de entrada inválido."
            ]);
        } else if (!in_array(strtoupper($aluno["sexo"]), ["F", "M"])) {
            array_push($error, [
                "campo" => "sexo",
                "descricao" => "Dado de entrada inválido."
            ]);
        }

        if (empty($aluno["nascimento"])) {
            array_push($error, [
                "campo" => "nascimento",
                "descricao" => "O campo data nascimento é obrigatório."
            ]);
        } else if (!$this->isDate($aluno["nascimento"])) {
            array_push($error, [
                "campo" => "nascimento",
                "descricao" => "Data inválida."
            ]);
        }

        return $error;
    }

    public function beforeSaveTurma($turma) {
        $error = [];

        if (empty($turma["nome"])) {
            array_push($error, [
                "campo" => "nome",
                "descricao" => "O campo nome é obrigatório."
            ]);
        }

        return $error;
    }


    public function beforeSaveMatricula($matricula) {
        $error = [];

        if (empty($matricula["aluno_id"]) || !$this->isInteger($matricula["aluno_id"])) {
            array_push($error, [
                "campo" => "aluno_id",
                "descricao" => "O campo aluno é obrigatório."
            ]);
        }

        if (empty($matricula["turma_id"]) || !$this->isInteger($matricula["turma_id"])) {
            array_push($error, [
                "campo" => "turma_id",
                "descricao" => "O campo turma é obrigatório."
            ]);
        }

        return $error;
    }

    public function getMessageError($msg) {
        $error = [];

        $pos = strpos($msg, "uc_turmas_nome");
        if ($pos === false) {
            $msg = "Erro não identificado. Entre em contato com o Admistrador.";
        } else {
            $msg = "Nome já está sendo utilizado.";
        }

        array_push($error, [
            "campo" => "nome",
            "descricao" => $msg
        ]);

        return $error;
    }

}
