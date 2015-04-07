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

    public function fetchAll()
    {
        $dados[0]['nome'] = 'Cliente XPTO';
        $dados[0]['email'] = 'cliente@xpto.com';

        $dados[1]['nome'] = 'Cliente Y';
        $dados[1]['email'] = 'cliente@y.com';

        return $dados;
    }

}