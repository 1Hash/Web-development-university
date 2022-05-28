<?php

class Fornecedor extends ModelFornecedor {
    
    private $id;
    private $razaoSocial;
    private $cnpj;
    private $inscricaoEstadual;
    private $telefone;
    private $email;
    private $cep;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $estado;
    private $cidade;
    
    function __construct($id, $razaoSocial, $cnpj, $inscricaoEstadual, $telefone, $email, $cep, $endereco, $numero, $complemento, $bairro, $estado, $cidade) {
        $this->id = $id;
        $this->razaoSocial = $razaoSocial;
        $this->cnpj = $cnpj;
        $this->inscricaoEstadual = $inscricaoEstadual;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->cep = $cep;
        $this->endereco = $endereco;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->estado = $estado;
        $this->cidade = $cidade;
    }
    
    function getId() {
        return $this->id;
    }

    function getRazaoSocial() {
        return $this->razaoSocial;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getInscricaoEstadual() {
        return $this->inscricaoEstadual;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
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

    function setId($id) {
        $this->id = $id;
    }

    function setRazaoSocial($razaoSocial) {
        $this->razaoSocial = $razaoSocial;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setInscricaoEstadual($inscricaoEstadual) {
        $this->inscricaoEstadual = $inscricaoEstadual;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
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

}
