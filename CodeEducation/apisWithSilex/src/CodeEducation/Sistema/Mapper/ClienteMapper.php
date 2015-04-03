<?php

namespace CodeEducation\Sistema\Mapper;

use CodeEducation\Sistema\Entity\Cliente;

class ClienteMapper
{

    public function insert(Cliente $cliente)
    {
        return [
            'nome' => 'Cliente XPTO',
            'email' => 'email@clientexpto.com'
        ];
    }



}