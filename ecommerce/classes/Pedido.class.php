<?php

class Pedido extends ModelPedido {
   
    private $id;
    private $cep;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $estado;
    private $cidade;
    private $entregaFinal;
    private $parcela;
    private $total;
    private $data;
    private $usuario;
    
    function __construct($id, $cep, $endereco, $numero, $complemento, $bairro, $estado, $cidade, $entregaFinal, $parcela, $total, $data, $usuario) {
        $this->id = $id;
        $this->cep = $cep;
        $this->endereco = $endereco;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->entregaFinal = $entregaFinal;
        $this->parcela = $parcela;
        $this->total = $total;
        $this->data = $data;
        $this->usuario = $usuario;
    }
    
    function getUsuario() {
        return $this->usuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
  
    function getId() {
        return $this->id;
    }

    function getCep() {
        return $this->cep;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getNumero() {
        return $this->numero;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getEstado() {
        return $this->estado;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getEntregaFinal() {
        return $this->entregaFinal;
    }

    function getParcela() {
        return $this->parcela;
    }

    function getTotal() {
        return $this->total;
    }

    function getData() {
        return $this->data;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEntregaFinal($entregaFinal) {
        $this->entregaFinal = $entregaFinal;
    }

    function setParcela($parcela) {
        $this->parcela = $parcela;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    function setData($data) {
        $this->data = $data;
    }
}