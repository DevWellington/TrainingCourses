<?php

namespace CodeEducation\Sistema\Service;

use CodeEducation\Sistema\Entity\Cliente;
use CodeEducation\Sistema\Mapper\ClienteMapper;

class ClienteService
{
    private $cliente;
    private $clienteMapper;

    public function __construct(Cliente $cliente, ClienteMapper $clienteMapper)
    {
        $this->cliente = $cliente;
        $this->clienteMapper = $clienteMapper;
    }

    public function insert(array $data)
    {
        $clienteEntity = $this->cliente;
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);

        $mapper = $this->clienteMapper;
        $result = $mapper->insert($clienteEntity);

        return $result;
    }

    public function fetchAll()
    {
        return $this->clienteMapper->fetchAll();
    }

    public function update($id, array $array)
    {
        return $this->clienteMapper->update($id, $array);
    }

    public function delete($id)
    {
        return $this->clienteMapper->delete($id, $array);
    }

}