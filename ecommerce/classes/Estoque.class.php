<?php

class Estoque extends ModelEstoque {

    private $id;
    private $grauEsferico;
    private $grauCilindro;
    private $eixo;
    private $curvaBase;
    private $diametro;
    private $grauAdicao;
    private $cor;
    private $olho;
    private $quantidade;
    private $idProduto;
    
    function __construct($id, $grauEsferico, $grauCilindro, $eixo, $curvaBase, $diametro, $grauAdicao, $cor, $olho, $quantidade, $idProduto) {
        $this->id = $id;
        $this->grauEsferico = $grauEsferico;
        $this->grauCilindro = $grauCilindro;
        $this->eixo = $eixo;
        $this->curvaBase = $curvaBase;
        $this->diametro = $diametro;
        $this->grauAdicao = $grauAdicao;
        $this->cor = $cor;
        $this->olho = $olho;
        $this->quantidade = $quantidade;
        $this->idProduto = $idProduto;
    }
    
    function getCor() {
        return $this->cor;
    }

    function setCor($cor) {
        $this->cor = $cor;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
    
    function getId() {
        return $this->id;
    }

    function getGrauEsferico() {
        return $this->grauEsferico;
    }

    function getGrauCilindro() {
        return $this->grauCilindro;
    }

    function getEixo() {
        return $this->eixo;
    }

    function getCurvaBase() {
        return $this->curvaBase;
    }

    function getDiametro() {
        return $this->diametro;
    }

    function getGrauAdicao() {
        return $this->grauAdicao;
    }

    function getOlho() {
        return $this->olho;
    }

    function getIdProduto() {
        return $this->idProduto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setGrauEsferico($grauEsferico) {
        $this->grauEsferico = $grauEsferico;
    }

    function setGrauCilindro($grauCilindro) {
        $this->grauCilindro = $grauCilindro;
    }

    function setEixo($eixo) {
        $this->eixo = $eixo;
    }

    function setCurvaBase($curvaBase) {
        $this->curvaBase = $curvaBase;
    }

    function setDiametro($diametro) {
        $this->diametro = $diametro;
    }

    function setGrauAdicao($grauAdicao) {
        $this->grauAdicao = $grauAdicao;
    }

    function setOlho($olho) {
        $this->olho = $olho;
    }

    function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }
}