<?php
require __DIR__ . "/../config.php";
require __DIR__ . "/dao/LembreteDAOMySql.php";

use Applembretes\Dao\LembreteDAOMySql;
 
$metodo = strtoupper($_SERVER['REQUEST_METHOD']);


try {

if ($metodo === 'DELETE') {
 
    parse_str(file_get_contents("php://input"),$delete);
 
    $id = $delete['id'] ?? null;
 
    $id = filter_var($id,FILTER_VALIDATE_INT);
   
    if ($id) {   
            
        $sql = $pdo->prepare("SELECT * FROM lembrete WHERE idLembrete=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();
       
        if ($sql->rowCount() > 0) {
           
            $meuLembreteDAOMySql = new LembreteDAOMySql($pdo);
            $meuLembreteDAOMySql->removeLembrete($id);
 
            $array['result']='Item excluído com sucesso!';
       
        }else {
            $array['error'] = 'Erro: Id Inexistente!';    
        }
    } else {
        $array['error'] = 'Erro: Id nulo ou inválido!';
    }
} else {
    $array['error'] = 'Erro: Ação inválida - método permitido apenas DELETE';
}

} catch (\Throwable $th) {
    $array['error'] = $th->getMessage();
}finally{
    require __DIR__ . "/../return.php";
}




