<?php

namespace Applembretes\Dao;

require __DIR__ . "/../models/Lembrete.php";
require __DIR__ ."/ILembreteDao.php";

use Applembretes\Dao\ILembreteDao;
use Applembretes\Models\Lembrete;
use PDO;

class LembreteDAOMySql implements ILembreteDao
{
    private $pdo;

    public function __construct(PDO $pdoParametro)
    {
        $this->pdo = $pdoParametro;
    }

    public function addLembrete(Lembrete $lembrete): Lembrete
    {
        $sql = $this->pdo->prepare("INSERT INTO lembrete (tituloLembrete, corpoLembrete) VALUES (:titulo, :corpo)");
        $sql->bindValue(':titulo', $lembrete->getTitulo());
        $sql->bindValue(':corpo', $lembrete->getCorpo());
        $sql->execute();
        $lembrete->setId($this->pdo->lastInsertId());
        return $lembrete;
    }

    public function removeLembrete(int $id): bool
    {
        $sql = $this->pdo->prepare("DELETE FROM lembrete WHERE idLembrete = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return true;
    }

    public function updateLembrete(Lembrete $lembrete) : Lembrete{
        $sql = $this->pdo->prepare("UPDATE lembrete SET tituloLembrete = :titulo, corpoLembrete = :corpo WHERE idLembrete = :id");
        $sql->bindValue(':titulo', $lembrete->getTitulo());
        $sql->bindValue(':corpo', $lembrete->getCorpo());
        $sql->bindValue(':id', $lembrete->getId());
        $sql->execute();
        return $lembrete;
    }

    public function getLembrete(int $id): mixed{

        $sql = $this->$pdo->prepare("SELECT * FROM lembrete WHERE idLembrete = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {



    } else {
        return false;
    }
    
    return $lembrete;
    }
}


 
 