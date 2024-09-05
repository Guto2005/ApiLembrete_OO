<?php

require __DIR__ . "/../config.php";
require __DIR__ . "/dao/LembreteDAOMySql.php";

use Applembretes\Models\Lembrete;
use Applembretes\Dao\LembreteDAOMySql;

$metodo= strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo==='POST') {

    $titulo = filter_input(INPUT_POST,'titulo');
    $corpo = filter_input(INPUT_POST,'corpo');

    if ($titulo && $corpo) {

        try {

            $MeuLembrete = new Lembrete(null,$titulo, $corpo);
            $MeuLembreteDAOMySql = new LembreteDAOMySql($PDO);
            $novoLembrete=$meuLembreteDAOMySql->addLembrete($MeuLembrete);
     
             $array['result'] = [
                 "id" => $id,
                 "tituloLembrete" => $titulo,
                 "corpoLembrete" => $corpo
             ];


        } catch (\Throwable $th) {
            $array["error"] = $th->getMessage();
        }

    } else {
        $array['error'] = 'Erro: Valores nulos ou inválidos';
    }

} else {
    $array['error'] = "Erro: Ação inválida - método permitido apenas POST";
}

require('./../return.php');

/* DESAFIOS para 07AGO
- Corrigir o problema com acentuação no retorno do JSON - Problema de Enconde
- Como faço para pegar o id do último item inserido na tabela através do PDO (create)
- Como retornar um array(json) contendo os dados do último elemento inserido
*/