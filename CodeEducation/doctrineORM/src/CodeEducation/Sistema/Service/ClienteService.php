<?php

namespace CodeEducation\Sistema\Service;

use CodeEducation\Sistema\Entity\Cliente as ClienteEntity;

class ClienteService
{
    private $cliente;
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(array $data)
    {
        $clienteEntity = new ClienteEntity;
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);

        $this->em->persist($clienteEntity);
        $this->em->flush();

        return $clienteEntity;
    }

    public function fetchAll()
    {

    }

    public function update($id, array $array)
    {
        //$repository = $this->em->getRepository("Code\Sistema\Entity\Cliente");
        //$cliente = $repository->find($id);

        // Entidade Vazia - Objeto Proxy sem necessidade de consultar no banco de dados 
        $cliente = $this->em->getReference("Code\Sistema\Entity\Cliente", $id);

        $cliente->setNome($array['nome']);
        $cliente->setEmail($array['email']);

        $this->em->persist($cliente);
        $this->em->flush();

        return $cliente;
    }

    public function delete($id)
    {

    }

}