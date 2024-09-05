<?php

require('./../config.php');
use Applembretes\Dao\LembreteDAOMySql;
use Applembretes\Models\Lembrete;

$metodo = strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo === 'PUT') {

    parse_str(file_get_contents("php://input"), $data);

    $id = $data['id'] ?? null;
    $titulo = $data['titulo'] ?? null;
    $corpo = $data['corpo'] ?? null;

    $id = filter_var($id, FILTER_VALIDATE_INT);
    $titulo = filter_var($titulo,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $corpo = filter_var($corpo,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($id && $titulo && $corpo) {
        $sql = $pdo->prepare("SELECT * FROM lembrete WHERE idLembrete = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $meuLembrete = new Lembrete($id,$titulo,$corpo);
            $meuLembreteDAOMySql = new LembreteDAOMySql($pdo);
            $meuLembreteDAOMySql->updateLembrete($lembrete);

            $meuLembreteDAOMySql->getLembrete()

            $array['result'] = 'Item atualizado com sucesso!';
        } else {
            $array['error'] = 'Erro: Id inexistente!';
        }
    } else {
        $array['error'] = 'Erro: Dados inválidos!';
    }
} else {
    $array['error'] = 'Erro: Ação inválida - método permitido apenas PUT';
}

require('./../return.php');
