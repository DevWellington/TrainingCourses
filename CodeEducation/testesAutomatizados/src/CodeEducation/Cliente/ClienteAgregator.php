<?php

namespace CodeEducation\Cliente;

class ClienteAgregator
{

    private $clientes = [];

    public function addCliente(Cliente $cliente)
    {
        $this->clientes[] = $cliente;
    }

    public function getClientes()
    {
        return $this->clientes;
    }

}