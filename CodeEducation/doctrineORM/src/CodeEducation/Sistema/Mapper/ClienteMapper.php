<?php

namespace CodeEducation\Sistema\Mapper;

use CodeEducation\Sistema\Entity\Cliente;
use Doctrine\ORM\EntityManager;

class ClienteMapper
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function insert(Cliente $cliente)
    {
        // Vai pra fila para ser inserido no banco de dados
        $this->em->persist($cliente);
        
        // Concretiza os dados no banco;
        $this->em->flush();

        return [
            'success' => true,
            'data' => [
                'id' => $cliente->getId(),
                'nome' => $cliente->getNome(),
                'email' => $cliente->getEmail()
            ]
        ];
    }

    public function fetchAll()
    {
        $dados[0]['nome'] = 'Cliente XPTO';
        $dados[0]['email'] = 'cliente@xpto.com';

        $dados[1]['nome'] = 'Cliente Y';
        $dados[1]['email'] = 'cliente@y.com';

        return $dados;
    }

    public function update($id, array $array)
    {
        return [
            'success' => true
        ];
    }
        
    public function delete($id)
    {
        return [
            'success' => true
        ];
    } 
}