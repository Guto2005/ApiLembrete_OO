<?php

require('./../config.php');

$metodo= strtoupper($_SERVER['REQUEST_METHOD']);

if ($metodo==='PUT') {

    parse_str(file_get_contents("php://input"),$delete); 

    $id = $UPDATE['id'] ?? null;

    //para proteger o id de colocarem letras//
    $id = filter_var($id,FILTER_VALIDATE_INT);
        //código delete
        if ($id) {
            $sql=$pdo->prepare("SELECT * FROM lembrete WHERE idLembrete=:id");
            $sql->bindValue(":id",$id);
            $sql->execute();
    
            if ($sql->rowCount()>0) {
        
                $sql = $pdo->prepare("UPDATE FROM lembrete WHERE idLembrete=:id");
                $sql->bindValue(":id", $id);
                $sql->execute();
                
                $array['result']='Item atualizado com sucesso!';

        }
        else {
            $array['error'] = "Erro: Id inexistente!";
        }
    } else {

        $array['error'] = "Erro: Id Inválido";
    }
 
} else {
    $array['error'] = "Erro: Ação inválida - método permitido apenas PUT";
}

require('./../return.php');

/*
ATIVIDADE UC09-001 - Criar a rota de atualizar UPDATE.php
Executar os seguintes testes:
1-chamada com metodo errado
2-chamar sem enviar parâmetro ou todos os parâmetros
3-chamar enviando id que não exista na tabela
4-usar getall para ver o que foi atualizado na lista
5-usar get para ver apenas o que foi atualizado
6-mostrar no BD o que foi atualizado via API
*/