<?php

class Dica extends ModelDica {
    
    private $titulo;
    private $descricao;
    private $data;
    
    function __construct($titulo, $descricao, $data) {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->data = $data;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getData() {
        return $this->data;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setData($data) {
        $this->data = $data;
    }
}
