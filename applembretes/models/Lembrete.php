<?php

namespace Applembretes\Models;

class Lembrete {

    private ?int $id;
    private ?string $titulo;
    private string $corpo;

    public function __construct(int $pId = null, string $pTitulo, string $pCorpo){

        $this->setId($pId);
        $this->setTitulo($pTitulo);
        $this->setCorpo($pCorpo);

    }

    // Getters e setters para todos os atributos

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id = null): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function getCorpo(): string
    {
        return $this->corpo;
    }

    public function setCorpo(string $corpo): self
    {
        $this->corpo = $corpo;
        return $this;
    }

}

