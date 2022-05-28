<?php

require_once ('C:\wamp64\www\ecommerce\conexao.class.php');

abstract class ModelEC extends DB {
    
    public function ConsultarNomeEstado($id) {
        
        try {

            $sql = "SELECT idEstado, estNome FROM estados WHERE idEstado = '$id'";
            $consulta = DB::PDO($sql);

            $consulta->execute();
            $ret = $consulta->fetchAll();
            return $ret;
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    public function ConsultarNomeCidade($id) {

        try {
            
            $sql = "SELECT idCidade, cidNome FROM cidades WHERE idCidade = '$id'";
            $consulta = DB::PDO($sql);

            $consulta->execute();
            $ret = $consulta->fetchAll();
            return $ret;
        }
        catch(Exception $e) {
            echo $e;
        }
    }
    
    public function ConsultarEstadoSelecionado($id) {

        try
        {
            $sql = "SELECT idEstado, estNome FROM estados WHERE idEstado = '$id'";
            $consulta = DB::PDO($sql);

            $consulta->execute();
            $ret = $consulta->fetchAll();
            return $ret;
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    public function ConsultarCidadeSelecionada($id) {

        try
        {
            $sql = "SELECT idCidade, cidNome FROM cidades WHERE idCidade = '$id'";
            $consulta = DB::PDO($sql);

            $consulta->execute();
            $ret = $consulta->fetchAll();
            return $ret;
        }
        catch(Exception $e) {
            echo $e;
        }
    }
    
    public function ConsultarEstados($id) {

        try
        {
            $sql = "SELECT idEstado, estNome FROM estados WHERE idEstado <> '$id'";
            $consulta = DB::PDO($sql);

            $consulta->execute();
            $ret = $consulta->fetchAll();
            return $ret;
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    public function ConsultarCidades($idEstado, $idCidade) {
        
        try
        {
            $sql = "SELECT idCidade, cidNome, cidEstado FROM cidades WHERE cidEstado = '$idEstado' AND idCidade <> '$idCidade' ORDER BY cidNome";
            $consulta = DB::PDO($sql);

            $consulta->execute();
            $ret = $consulta->fetchAll();
            return $ret;
        }
        catch(Exception $e) {
            echo $e;
        }
    }
    
}
