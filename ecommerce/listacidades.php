<?php

    require_once("conexao.class.php");

    $id = $_GET['estado'];

    //echo "<script>alert('Entrou no listacidades.php');</script>";

    $sql = "SELECT * FROM cidades WHERE cidEstado = '$id' ORDER BY cidNome";
    $consulta = DB::PDO($sql);

    $consulta->execute();
    $consulta = $consulta->fetchAll();


    if($id == '') {
        echo "<option value=''>Primeiro selecione um Estado</option>";
    } else {
        echo "<option value=''>-- Selecione uma Cidade --</option>";
    }

    foreach($consulta as $var) {

        echo "<option value='".$var['idCidade']."'>".$var['cidNome']."</option>";
    }

    exit();