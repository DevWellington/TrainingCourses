<?php

namespace CodeEducation\Produto;

use SplObserver;

class Produto implements \SplSubject
{
    private $id;
    private $nome;
    private $nomeCategoria;
    private $nomeMarca;

    /**
     * @var \SplObserver
     */
    private $observadores = [];

    public function __construct($id, $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function setId($id) { $this->id = $id; }

    public function setNome($nome)
    {
        $this->nome = $nome;
        $this->notify();
    }

    public function setNomeCategoria($nomeCategoria) { $this->nomeCategoria = $nomeCategoria;}

    public function setNomeMarca($nomeMarca) { $this->nomeMarca = $nomeMarca; }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Attach an SplObserver
     * @link http://php.net/manual/en/splsubject.attach.php
     * @param SplObserver $observer <p>
     * The <b>SplObserver</b> to attach.
     * </p>
     * @return void
     */
    public function attach(SplObserver $observer)
    {
        $this->observadores[] = $observer;
    }

    public function detach(SplObserver $observer) {
        // TODO: Implement detach() method.
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Notify an observer
     * @link http://php.net/manual/en/splsubject.notify.php
     * @return void
     */
    public function notify()
    {
        foreach($this->observadores as $observador)
            $observador->update($this);
    }


}