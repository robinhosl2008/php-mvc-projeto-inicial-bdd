<?php

namespace Alura\Armazenamento\Controller;

use Alura\Armazenamento\Entity\Formacao;
use Alura\Armazenamento\Helper\MensagemFlash;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistenciaFormacao implements RequestHandlerInterface
{
    use MensagemFlash;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $formacao = new Formacao();
        $formacao->setDescricao($request->getParsedBody()['descricao']);

        if (array_key_exists('id', $request->getQueryParams())) {
            $formacao->setId($request->getQueryParams()['id']);
            // $this->entityManager->persist($formacao);
            $this->entityManager->merge($formacao);
            $mensagem = 'Formacao atualizado com sucesso';
        } else {
            $this->entityManager->persist($formacao);
            $mensagem = 'Formacao cadastrado com sucesso';
        }
        $this->entityManager->flush();
        $this->adicionaMensagemFlash('success', $mensagem);

        return new Response(302, ['Location' => '/listar-formacoes']);
    }
}
