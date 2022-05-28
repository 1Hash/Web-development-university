<?php

class Produto extends ModelProduto {
  
    private $idProduto;
    private $nome;
    private $valorUnit;
    private $idFornecedor;
    private $descartavel;
    private $anual;
    private $mensal;
    private $diaria;
    private $quinzenal;
    private $esferica;
    private $torica;
    private $multifocal;
    private $colorida;
    private $curvaUnica;
    private $diametroPadrao;
    private $olho;
    private $descricao;
    private $marca;
    private $tipo;
    private $material;
    private $visitint;
    private $imagem;
    private $tipoImagem;
    private $intervaloEsferico;
    private $intervaloCilindro;
    private $intervaloEixo;
    private $intervaloCurvaBase;
    private $intervaloDiametro;
    private $intervaloAdicao;
    private $intervaloCor;
    
    function __construct($idProduto, $nome, $valorUnit, $idFornecedor, $descartavel, $anual, $mensal, $diaria, $quinzenal, $esferica, $torica, $multifocal, $colorida, $curvaUnica, $diametroPadrao, $olho, $descricao, $marca, $tipo, $material, $visitint, $imagem, $tipoImagem, $intervaloEsferico, $intervaloCilindro, $intervaloEixo, $intervaloCurvaBase, $intervaloDiametro, $intervaloAdicao, $intervaloCor) {
        $this->idProduto = $idProduto;
        $this->nome = $nome;
        $this->valorUnit = $valorUnit;
        $this->idFornecedor = $idFornecedor;
        $this->descartavel = $descartavel;
        $this->anual = $anual;
        $this->mensal = $mensal;
        $this->diaria = $diaria;
        $this->quinzenal = $quinzenal;
        $this->esferica = $esferica;
        $this->torica = $torica;
        $this->multifocal = $multifocal;
        $this->colorida = $colorida;
        $this->curvaUnica = $curvaUnica;
        $this->diametroPadrao = $diametroPadrao;
        $this->olho = $olho;
        $this->descricao = $descricao;
        $this->marca = $marca;
        $this->tipo = $tipo;
        $this->material = $material;
        $this->visitint = $visitint;
        $this->imagem = $imagem;
        $this->tipoImagem = $tipoImagem;
        $this->intervaloEsferico = $intervaloEsferico;
        $this->intervaloCilindro = $intervaloCilindro;
        $this->intervaloEixo = $intervaloEixo;
        $this->intervaloCurvaBase = $intervaloCurvaBase;
        $this->intervaloDiametro = $intervaloDiametro;
        $this->intervaloAdicao = $intervaloAdicao;
        $this->intervaloCor = $intervaloCor;
    }
    
    function getIdProduto() {
        return $this->idProduto;
    }

    function getNome() {
        return $this->nome;
    }

    function getValorUnit() {
        return $this->valorUnit;
    }

    function getIdFornecedor() {
        return $this->idFornecedor;
    }

    function getDescartavel() {
        return $this->descartavel;
    }

    function getAnual() {
        return $this->anual;
    }

    function getMensal() {
        return $this->mensal;
    }

    function getDiaria() {
        return $this->diaria;
    }

    function getQuinzenal() {
        return $this->quinzenal;
    }

    function getEsferica() {
        return $this->esferica;
    }

    function getTorica() {
        return $this->torica;
    }

    function getMultifocal() {
        return $this->multifocal;
    }

    function getColorida() {
        return $this->colorida;
    }

    function getCurvaUnica() {
        return $this->curvaUnica;
    }

    function getDiametroPadrao() {
        return $this->diametroPadrao;
    }

    function getOlho() {
        return $this->olho;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getMarca() {
        return $this->marca;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getMaterial() {
        return $this->material;
    }

    function getVisitint() {
        return $this->visitint;
    }

    function getImagem() {
        return $this->imagem;
    }

    function getTipoImagem() {
        return $this->tipoImagem;
    }

    function getIntervaloEsferico() {
        return $this->intervaloEsferico;
    }

    function getIntervaloCilindro() {
        return $this->intervaloCilindro;
    }

    function getIntervaloEixo() {
        return $this->intervaloEixo;
    }

    function getIntervaloCurvaBase() {
        return $this->intervaloCurvaBase;
    }

    function getIntervaloDiametro() {
        return $this->intervaloDiametro;
    }

    function getIntervaloAdicao() {
        return $this->intervaloAdicao;
    }

    function getIntervaloCor() {
        return $this->intervaloCor;
    }

    function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setValorUnit($valorUnit) {
        $this->valorUnit = $valorUnit;
    }

    function setIdFornecedor($idFornecedor) {
        $this->idFornecedor = $idFornecedor;
    }

    function setDescartavel($descartavel) {
        $this->descartavel = $descartavel;
    }

    function setAnual($anual) {
        $this->anual = $anual;
    }

    function setMensal($mensal) {
        $this->mensal = $mensal;
    }

    function setDiaria($diaria) {
        $this->diaria = $diaria;
    }

    function setQuinzenal($quinzenal) {
        $this->quinzenal = $quinzenal;
    }

    function setEsferica($esferica) {
        $this->esferica = $esferica;
    }

    function setTorica($torica) {
        $this->torica = $torica;
    }

    function setMultifocal($multifocal) {
        $this->multifocal = $multifocal;
    }

    function setColorida($colorida) {
        $this->colorida = $colorida;
    }

    function setCurvaUnica($curvaUnica) {
        $this->curvaUnica = $curvaUnica;
    }

    function setDiametroPadrao($diametroPadrao) {
        $this->diametroPadrao = $diametroPadrao;
    }

    function setOlho($olho) {
        $this->olho = $olho;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setMaterial($material) {
        $this->material = $material;
    }

    function setVisitint($visitint) {
        $this->visitint = $visitint;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setTipoImagem($tipoImagem) {
        $this->tipoImagem = $tipoImagem;
    }

    function setIntervaloEsferico($intervaloEsferico) {
        $this->intervaloEsferico = $intervaloEsferico;
    }

    function setIntervaloCilindro($intervaloCilindro) {
        $this->intervaloCilindro = $intervaloCilindro;
    }

    function setIntervaloEixo($intervaloEixo) {
        $this->intervaloEixo = $intervaloEixo;
    }

    function setIntervaloCurvaBase($intervaloCurvaBase) {
        $this->intervaloCurvaBase = $intervaloCurvaBase;
    }

    function setIntervaloDiametro($intervaloDiametro) {
        $this->intervaloDiametro = $intervaloDiametro;
    }

    function setIntervaloAdicao($intervaloAdicao) {
        $this->intervaloAdicao = $intervaloAdicao;
    }

    function setIntervaloCor($intervaloCor) {
        $this->intervaloCor = $intervaloCor;
    }    
}