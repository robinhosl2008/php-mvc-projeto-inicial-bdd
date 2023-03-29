<?php

namespace Alura\Armazenamento\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use InvalidArgumentException;

#[Entity]
#[Table(name: "formacao")]
class Formacao
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private ?int $id = null;

    #[Column]
    private string $descricao = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        if (count(explode(" ", $descricao)) < 2) {
            throw new InvalidArgumentException(
                "Descrição precisa ter ao menos duas palavras"
            );
        }

        $this->descricao = $descricao;
    }
}
