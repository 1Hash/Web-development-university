<?php

    session_start();
    
    unset($_SESSION['listaEsferico']);
    unset($_SESSION['listaCilindro']);
    unset($_SESSION['listaEixo']);
    unset($_SESSION['listaCB']);
    unset($_SESSION['listaAdicao']);
    unset($_SESSION['listaDiametro']);
    unset($_SESSION['listaCor']);
    
    require_once("./conexao.class.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Registrar - ELentes</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/EL.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/style.teal.flat.css" rel="stylesheet" id="theme">
    
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/mask.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/jquery.form.js"></script>
    
    <script>
    
    $(document).ready(function(){

        $('#checkAnual').change(function(){
            
            document.getElementById("checkMensal").disabled = true;
            document.getElementById("checkDiaria").disabled = true;
            document.getElementById("checkQuinzenal").disabled = true;
            
            document.getElementById("checkMensal").checked = false;
            document.getElementById("checkDiaria").checked = false;
            document.getElementById("checkQuinzenal").checked = false;
            
            //$("#mensal").removeClass("active");
            $("#mensal").addClass("disabled btn nopadding");
            $("#diaria").addClass("disabled btn nopadding");
            $("#quinzenal").addClass("disabled btn nopadding");
            
        });
        
        $('#checkDescartavel').change(function(){
            
            document.getElementById("checkMensal").disabled = false;
            document.getElementById("checkDiaria").disabled = false;
            document.getElementById("checkQuinzenal").disabled = false;
            
            $("#mensal").removeClass("disabled btn nopadding");
            $("#diaria").removeClass("disabled btn nopadding");
            $("#quinzenal").removeClass("disabled btn nopadding");
            
        });
        
        $('#checkTorica').change(function(){
            
            $("#cilindro").removeClass("hidden");
            $("#eixo").removeClass("hidden");
            
            $("#adicao").addClass("hidden");
            $("#olho").addClass("hidden");
            
        });
        
        $('#checkMultifocal').change(function(){
            
            $("#adicao").removeClass("hidden");
            $("#olho").removeClass("hidden");
            
            $("#cilindro").addClass("hidden");
            $("#eixo").addClass("hidden");
            
        });
        
        $('#checkEsferica').change(function(){
            
            $("#cilindro").addClass("hidden");
            $("#eixo").addClass("hidden");
            $("#adicao").addClass("hidden");
            $("#olho").addClass("hidden");
            
        });
        
        $('#checkColorida').change(function(){
            
            if(document.getElementById("checkColorida").checked === true) {
                $("#cor").removeClass("hidden");
            }
            else {
                $("#cor").addClass("hidden");
            }
        });
        
        $('#checkCurvaBase').change(function(){
            
            if(document.getElementById("checkCurvaBase").checked === true) {
                $("#curvaBaseUnica").removeClass("hidden");
                $("#curvaBase").addClass("hidden");
            }
            else {
                $("#curvaBaseUnica").addClass("hidden");
                $("#curvaBase").removeClass("hidden");
            }
        });
        
        $('#checkDiametro').change(function(){
            
            if(document.getElementById("checkDiametro").checked === true) {
                $("#diametroPadrao").removeClass("hidden");
                $("#diam").addClass("hidden");
            }
            else {
                $("#diametroPadrao").addClass("hidden");
                $("#diam").removeClass("hidden");
            }
        });
        
    });
    
    //---- Variáveis globais ----//
    
    var inicioEsf;
    var fimEsf;
    var passosEsf;
    
    var inicioCB;
    var fimCB;
    var passosCB;
    
    var inicioDiametro;
    var fimDiametro;
    var passosDiametro;
    
    $(function ($) {
        
        // -------------------------------------------------[ ESFÉRICO ]------------------------------------------------- //
        
        $('#adicionarEsferico').click(function () {
            
            inicioEsf = $(deInputEsferico).val();
            fimEsf = $(ateInputEsferico).val();
            passosEsf = $(passosInputEsferico).val();
            
            $('#tabelaEsferico').load('./controls/controlProduto.php?inicioEsf='+inicioEsf+'&fimEsf='+fimEsf+'&passosEsf='+passosEsf+' #tabelaEsferico');
        });
        
        $('#removerTodosEsferico').click(function () {
            
            $('#tabelaEsferico').load('./controls/controlProduto.php?excluirTodosEsf='+true+' #tabelaEsferico');
        });
        
        // -------------------------------------------------[ CURVA BASE ]------------------------------------------------- //
        
        $('#adicionarCurvaBase').click(function () {
            
            inicioCB = $(deInputCurvaBase).val();
            fimCB = $(ateInputCurvaBase).val();
            passosCB = $(passosInputCurvaBase).val();
            
            $('#tabelaCurvaBase').load('./controls/controlProduto.php?inicioCB='+inicioCB+'&fimCB='+fimCB+'&passosCB='+passosCB+' #tabelaCurvaBase');
        });
        
        $('#removerTodosCurvaBase').click(function () {
            
            $('#tabelaCurvaBase').load('./controls/controlProduto.php?excluirTodosCB='+true+' #tabelaCurvaBase');
        });
        
        // -------------------------------------------------[ DIÂMETRO ]------------------------------------------------- //
        
        $('#adicionarDiametro').click(function () {
            
            inicioDiametro = $(deInputDiametro).val();
            fimDiametro = $(ateInputDiametro).val();
            passosDiametro = $(passosInputDiametro).val();
            
            $('#tabelaDiametro').load('./controls/controlProduto.php?inicioDiametro='+inicioDiametro+'&fimDiametro='+fimDiametro+'&passosDiametro='+passosDiametro+' #tabelaDiametro');
        });
        
        $('#removerTodosDiametro').click(function () {
            
            $('#tabelaDiametro').load('./controls/controlProduto.php?excluirTodosDiametro='+true+' #tabelaDiametro');
        });
        
        // -------------------------------------------------[ CILINDRO ]------------------------------------------------- //
        
        $('#adicionarCilindro').click(function () {
            
            inicioCilindro = $(deInputCilindro).val();
            fimCilindro = $(ateInputCilindro).val();
            passosCilindro = $(passosInputCilindro).val();
            
            $('#tabelaCilindro').load('./controls/controlProduto.php?inicioCilindro='+inicioCilindro+'&fimCilindro='+fimCilindro+'&passosCilindro='+passosCilindro+' #tabelaCilindro');
        });
        
        $('#removerTodosCilindro').click(function () {
            
            $('#tabelaCilindro').load('./controls/controlProduto.php?excluirTodosCilindro='+true+' #tabelaCilindro');
        });
        
        // -------------------------------------------------[ EIXO ]------------------------------------------------- //
        
        $('#adicionarEixo').click(function () {
            
            inicioEixo = $(deInputEixo).val();
            fimEixo = $(ateInputEixo).val();
            passosEixo = $(passosInputEixo).val();
            
            $('#tabelaEixo').load('./controls/controlProduto.php?inicioEixo='+inicioEixo+'&fimEixo='+fimEixo+'&passosEixo='+passosEixo+' #tabelaEixo');
        });
        
        $('#removerTodosEixo').click(function () {
            
            $('#tabelaEixo').load('./controls/controlProduto.php?excluirTodosEixo='+true+' #tabelaEixo');
        });
        
        // -------------------------------------------------[ ADIÇÃO ]------------------------------------------------- //
        
        $('#adicionarAdicao').click(function () {
            
            inicioAdicao = $(deInputAdicao).val();
            fimAdicao = $(ateInputAdicao).val();
            passosAdicao = $(passosInputAdicao).val();
            
            $('#tabelaAdicao').load('./controls/controlProduto.php?inicioAdicao='+inicioAdicao+'&fimAdicao='+fimAdicao+'&passosAdicao='+passosAdicao+' #tabelaAdicao');
        });
        
        $('#removerTodosAdicao').click(function () {
            
            $('#tabelaAdicao').load('./controls/controlProduto.php?excluirTodosAdicao='+true+' #tabelaAdicao');
        });
        
        // -------------------------------------------------[ COR ]------------------------------------------------- //
        
        $('#adicionarCor').click(function () {
            
            nomeCor = $(nomeInputCor).val();
            
            $('#tabelaCor').load('./controls/controlProduto.php?nomeCor='+nomeCor+' #tabelaCor');
        });
        
        $('#removerTodosCores').click(function () {
            
            $('#tabelaCor').load('./controls/controlProduto.php?excluirTodosCor='+true+' #tabelaCor');
        });
    });
    
    $(function ($) {

        // Quando enviado o formulário
        $('#formulario').on('submit', function () {

            /*if(!$("#formulario").valid()) {
                return false;
            }
            else {*/

                // Armazenando objetos em variáveis para utilizá-los posteriormente
                var formulario = $(this);
                var botao = $('#cadastrar');
                var textoBotao = $('#cadastrar').text();
                var mensagem = $('#mensagem');

                // Exibindo indicador de carregamento (Bootstrap)
                //botao.button('Alterando...');
                botao.text('Cadastrando Produto...');

                // Enviando formulário
                $(this).ajaxSubmit({

                    // Definindo tipo de retorno do servidor
                    dataType: 'json',

                    // Se a requisição foi um sucesso
                    success: function (retorno) {

                        // Se cadastrado com sucesso
                        if (retorno.sucesso) {
                            // Definindo estilo da mensagem (sucesso)
                            mensagem.attr('class', 'alert alert-success alert-dismissable');

                            // Limpando formulário
                            //formulario.resetForm();
                            
                            //$('#fornecedorInput').load('./controls/controlProduto.php?limparIntervalos='+true+' #retorno');
                            
                            document.getElementById("checkMensal").disabled = false;
                            document.getElementById("checkDiaria").disabled = false;
                            document.getElementById("checkQuinzenal").disabled = false;
                            
                            $("#mensal").removeClass("disabled btn nopadding");
                            $("#diaria").removeClass("disabled btn nopadding");
                            $("#quinzenal").removeClass("disabled btn nopadding");
                            
                            $('#formulario').each (function(){
                                this.reset();
                            });

                            $('select').val('');
                            $('#fornecedorInput option:selected').text('-- Selecione um fornecedor --');
                            $('#fornecedorInput').selectpicker('refresh');
                            
                            $('body,html').animate({scrollTop:0},500);
                        }
                        else {
                            // Definindo estilo da mensagem (erro)
                            mensagem.attr('class', 'alert alert-danger alert-dismissable');
                            $('body,html').animate({scrollTop:0},500);
                        }

                        // Exibindo mensagem
                        mensagem.html(retorno.mensagem);

                        // Escondendo indicador de carregamento
                        botao.text(textoBotao);

                    },

                    // Se houver algum erro na requisição
                    error: function (retorno) {

                        // Definindo estilo da mensagem (erro)
                        mensagem.attr('class', 'alert alert-danger alert-dismissable');
                        $('body,html').animate({scrollTop:0},500);

                        // Exibindo mensagem
                        mensagem.html(retorno.mensagem);

                        // Escondendo indicador de carregamento
                        botao.text(textoBotao);
                    }
                });

                return false;
            //}
        });
    });
    
    </script>
    
  </head>
  <body class="fade-down">

    <!-- Top Header -->
    <div class="top-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <ul class="list-inline pull-right">
              <li>
                <div class="dropdown">
                  <button class="btn dropdown-toggle" type="button" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-user"></i> Oi, Admin <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownUser">
                    <li><a href="?go=sair">Sair</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- End Top Header -->

    <!-- Middle Header -->
    <div class="middle-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3 logo">
            <a href="index-admin"><img alt="Logo" src="images/logo-teal.png" class="img-responsive" data-text-logo="ELentes-logo" /></a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Middle Header -->

    <!-- Navigation Bar -->
    <nav class="navbar navbar-default shadow-navbar" role="navigation">
      <div class="container">
          <div class="collapse navbar-collapse" id="navbar-ex1-collapse">
            <ul class="nav navbar-nav">
              <li><a href="index-admin">Home</a></li>
            </ul>
          </div>
      </div>
    </nav>
    <!-- End Navigation Bar -->

    <!-- Breadcrumbs -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index-admin">Home</a></li>
          <li class="active">Cadastro de Produto</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
      <div class="row">

        <!-- Register Form -->
        <div class="col-sm-12 m-b-3">
            <div class="row">
                <div class="col-xs-12">
                    <div id="mensagem"></div>
                </div>
            </div>
          <div class="title"><span>Cadastro de Produto</span></div>
          <div class="row">
              <form id="formulario" name="formProduto" method="POST" action="./controls/controlProduto.php">
                <div class="form-group col-sm-6">
                <label for="fornecedorInput">Fornecedor</label>
                <select class="form-control selectpicker" data-live-search="true" id="fornecedorInput" name="fornecedorInput">
                  <option value="">-- Selecione um fornecedor --</option>
                  <?php

                        $sql = "SELECT idFornecedor, razaoSocial FROM fornecedores";
                        $consulta = DB::PDO($sql);

                        $consulta->execute();
                        $consulta = $consulta->fetchAll();

                        foreach($consulta as $var) {
                            echo "<option value='".$var['idFornecedor']."'>".$var['razaoSocial']."</option>";
                        }
                    ?>
                </select>
                </div>

                <hr style="width: 97.5%;" />

                <div class="form-group col-sm-6">
                    <label for="nomeInput">Nome</label>
                    <input type="text" class="form-control" id="nomeInput" name="nomeInput" placeholder="Nome">
                  </div>
                <div class="form-group col-sm-6">
                    <label for="valorInput">Valor</label>
                    <input type="text" class="form-control" id="valorInput" name="valorInput" placeholder="Valor">
                </div>

                <hr style="width: 97.5%;" />

                <div class="form-group col-sm-12">
                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-4">
                            <label><input type="radio" name="uso" id="checkDescartavel" value="descartavel"><span> Descartável</span></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <label><input type="radio" name="uso" id="checkAnual" value="anual"><span> Anual</span></label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-4">
                            <label id="mensal"><input type="radio" name="troca" id="checkMensal" value="mensal"><span> Mensal</span></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <label id="diaria"><input type="radio" name="troca" id="checkDiaria" value="diaria"><span> Diária</span></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <label id="quinzenal"><input type="radio" name="troca" id="checkQuinzenal" value="quinzenal"><span> Quinzenal</span></label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-4">
                            <label><input type="radio" name="tipo" id="checkEsferica" value="esferica"><span> Esférica</span></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <label><input type="radio" name="tipo" id="checkTorica" value="torica"><span> Tórica</span></label>
                        </div>
                        <div class="form-group col-sm-4">
                            <label><input type="radio" name="tipo" id="checkMultifocal" value="multifocal"><span> Multifocal</span></label>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-4">
                            <label><input type="checkbox" id="checkColorida" name="checkColorida"><span> Colorida</span></label>
                        </div>
                    </div>
                </div>

                <hr style="width: 97.5%;" />

              <div class="form-group col-sm-12">
                  <b>Defina o intervalo de graduação da lente</b>
              </div>

                <hr style="width: 95%;" />

              <div class="form-group col-sm-12 nomarginbotton">
                <div class="form-group col-sm-12">
                    <b>Esférico</b>
                </div>
                <div class="form-group col-sm-4">
                    <label for="deInputEsferico">De</label>
                    <input type="text" class="form-control" id="deInputEsferico" name="deInputEsferico" placeholder="De">
                </div>
                <div class="form-group col-sm-4">
                    <label for="ateInputEsferico">Até</label>
                    <input type="text" class="form-control" id="ateInputEsferico" name="ateInputEsferico" placeholder="Até">
                </div>
                <div class="form-group col-sm-4">
                    <label for="passosInputEsferico">Passos</label>
                    <input type="text" class="form-control" id="passosInputEsferico" name="passosInputEsferico" placeholder="Passos">                 
                </div>
                <div class="form-group col-sm-12">
                    <button type="button" id="adicionarEsferico" class="btn btn-theme">Adicionar &MediumSpace;<i class="fa fa-plus-square" aria-hidden="true"></i></button>
                    <button type="button" id="removerTodosEsferico" class="btn btn-theme floatright">Remover tudo &MediumSpace;<i class="fa fa-minus-square" aria-hidden="true"></i></button>
                </div>
              </div>

            <div id="tabelaEsferico"></div>

              <div id="cilindro" class="hidden">
                <hr style="width: 95%;" />

                <div class="form-group col-sm-12 nomarginbotton">
                  <div class="form-group col-sm-12">
                      <b>Cilíndro</b>
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="deInputCilindro">De</label>
                      <input type="text" class="form-control" id="deInputCilindro" name="deInputCilindro" placeholder="De">
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="ateInputCilindro">Até</label>
                      <input type="text" class="form-control" id="ateInputCilindro" name="ateInputCilindro" placeholder="Até">
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="passosInputCilindro">Passos</label>
                      <input type="text" class="form-control" id="passosInputCilindro" name="passosInputCilindro" placeholder="Passos">
                  </div>
                <div class="form-group col-sm-12">
                      <button type="button" id="adicionarCilindro" class="btn btn-theme">Adicionar &MediumSpace;<i class="fa fa-plus-square" aria-hidden="true"></i></button>
                      <button type="button" id="removerTodosCilindro" class="btn btn-theme floatright">Remover tudo &MediumSpace;<i class="fa fa-minus-square" aria-hidden="true"></i></button>
                  </div>
                </div>

                <div id="tabelaCilindro"></div>
              </div>

              <div id="eixo" class="hidden">
                <hr style="width: 95%;" />

                <div class="form-group col-sm-12 nomarginbotton">
                  <div class="form-group col-sm-12">
                      <b>Eixo</b>
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="deInputEixo">De</label>
                      <input type="text" class="form-control" id="deInputEixo" name="deInputEixo" placeholder="De">
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="ateInputEixo">Até</label>
                      <input type="text" class="form-control" id="ateInputEixo" name="ateInputEixo" placeholder="Até">
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="passosInputEixo">Passos</label>
                      <input type="text" class="form-control" id="passosInputEixo" name="passosInputEixo" placeholder="Passos">
                  </div>
                <div class="form-group col-sm-12">
                      <button type="button" id="adicionarEixo" class="btn btn-theme">Adicionar &MediumSpace;<i class="fa fa-plus-square" aria-hidden="true"></i></button>
                      <button type="button" id="removerTodosEixo" class="btn btn-theme floatright">Remover tudo &MediumSpace;<i class="fa fa-minus-square" aria-hidden="true"></i></button>
                  </div>
                </div>
                
                <div id="tabelaEixo"></div>
              </div>

              <div id="adicao" class="hidden">
                <hr style="width: 95%;" />

                <div class="form-group col-sm-12 nomarginbotton">
                  <div class="form-group col-sm-12">
                      <b>Adição</b>
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="deInputAdicao">De</label>
                      <input type="text" class="form-control" id="deInputAdicao" name="deInputAdicao" placeholder="De">
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="ateInputAdicao">Até</label>
                      <input type="text" class="form-control" id="ateInputAdicao" name="ateInputAdicao" placeholder="Até">
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="passosInputAdicao">Passos</label>
                      <input type="text" class="form-control" id="passosInputAdicao" name="passosInputAdicao" placeholder="Passos">
                  </div>
                <div class="form-group col-sm-12">
                      <button type="button" id="adicionarAdicao" class="btn btn-theme">Adicionar &MediumSpace;<i class="fa fa-plus-square" aria-hidden="true"></i></button>
                      <button type="button" id="removerTodosAdicao" class="btn btn-theme floatright">Remover tudo &MediumSpace;<i class="fa fa-minus-square" aria-hidden="true"></i></button>
                  </div>
                </div>

                <div id="tabelaAdicao"></div>
              </div>

              <hr style="width: 95%;" />

              <div class="form-group col-sm-12 nomarginbotton">
                <div class="form-group col-sm-2">
                    <b>Curva Base</b>
                </div>
                <div class="form-group col-sm-10">
                    <label><input type="checkbox" id="checkCurvaBase" name="checkCurvaBase"><span> Curvatura única</span></label>
                </div>
                <div id="curvaBaseUnica" class="hidden">
                    <div class="form-group col-sm-4">
                        <label for="curvaUnicaInput">Curva única</label>
                        <input type="text" class="form-control" id="curvaUnicaInput" name="curvaUnicaInput" placeholder="Curva única">
                    </div>
                </div>
                <div id="curvaBase">
                    <div class="form-group col-sm-4">
                        <label for="deInputCurvaBase">De</label>
                        <input type="text" class="form-control" id="deInputCurvaBase" name="deInputCurvaBase" placeholder="De">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="ateInputCurvaBase">Até</label>
                        <input type="text" class="form-control" id="ateInputCurvaBase" name="ateInputCurvaBase" placeholder="Até">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="passosInputCurvaBase">Passos</label>
                        <input type="text" class="form-control" id="passosInputCurvaBase" name="passosInputCurvaBase" placeholder="Passos">
                    </div>                  
                    <div class="form-group col-sm-12">
                        <button type="button" id="adicionarCurvaBase" class="btn btn-theme">Adicionar &MediumSpace;<i class="fa fa-plus-square" aria-hidden="true"></i></button>
                        <button type="button" id="removerTodosCurvaBase" class="btn btn-theme floatright">Remover tudo &MediumSpace;<i class="fa fa-minus-square" aria-hidden="true"></i></button>
                    </div>
                </div>
              </div>

              <div id="tabelaCurvaBase"></div>

              <hr style="width: 95%;" />

              <div class="form-group col-sm-12 nomarginbotton">
                <div class="form-group col-sm-2">
                    <b>Diâmetro</b>
                </div>
                <div class="form-group col-sm-10">
                    <label><input type="checkbox" id="checkDiametro" name="checkDiametro"><span> Diâmetro padrão</span></label>
                </div>
                <div id="diametroPadrao" class="hidden">
                    <div class="form-group col-sm-4">
                        <label for="diametroInput">Diâmetro padrão</label>
                        <input type="text" class="form-control" id="diametroInput" name="diametroInput" placeholder="Diâmetro padrão">
                    </div>
                </div>
                <div id="diam">
                    <div class="form-group col-sm-4">
                        <label for="deInputDiametro">De</label>
                        <input type="text" class="form-control" id="deInputDiametro" name="deInputDiametro" placeholder="De">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="ateInputDiametro">Até</label>
                        <input type="text" class="form-control" id="ateInputDiametro" name="ateInputDiametro" placeholder="Até">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="passosInputDiametro">Passos</label>
                        <input type="text" class="form-control" id="passosInputDiametro" name="passosInputDiametro" placeholder="Passos">
                    </div>                  
                    <div class="form-group col-sm-12">
                        <button type="button" id="adicionarDiametro" class="btn btn-theme">Adicionar &MediumSpace;<i class="fa fa-plus-square" aria-hidden="true"></i></button>
                        <button type="button" id="removerTodosDiametro" class="btn btn-theme floatright">Remover tudo &MediumSpace;<i class="fa fa-minus-square" aria-hidden="true"></i></button>
                    </div>
                </div>
              </div>

              <div id="tabelaDiametro"></div>

              <div id="cor" class="hidden">
                <hr style="width: 95%;" />

                <div class="form-group col-sm-12 nomarginbotton">
                  <div class="form-group col-sm-12">
                      <b>Cor</b>
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="nomeInputCor">Nome</label>
                      <input type="text" class="form-control" id="nomeInputCor" name="nomeInputCor" placeholder="Cor">
                  </div>                
                <div class="form-group col-sm-12">
                      <button type="button" id="adicionarCor" class="btn btn-theme">Adicionar &MediumSpace;<i class="fa fa-plus-square" aria-hidden="true"></i></button>
                      <button type="button" id="removerTodosCores" class="btn btn-theme floatright">Remover tudo &MediumSpace;<i class="fa fa-minus-square" aria-hidden="true"></i></button>
                  </div>
                </div>

                <div id="tabelaCor"></div>
              </div>

              <div id="olho" class="hidden">
                <hr style="width: 97.5%;" />

                <div class="form-group col-sm-12 nomarginbotton">
                  <div class="form-group col-sm-12 nomarginbotton">
                      <div class="form-group col-sm-6">
                          <label><input name="olho" type="radio" id="radioOlhoDominante" value="dominante"><span> Olho Dominante</span></label>
                      </div>
                        <div class="form-group col-sm-6">
                          <label><input name="olho" type="radio" id="radioOlhoNaoDominante" value="ndominante"><span> Olho Não Dominante</span></label>
                      </div>
                  </div>
                </div>
              </div>

              <hr style="width: 97.5%;" />

              <div class="form-group col-sm-12">
                <label for="descricaoInput">Descrição</label>
                <textarea style="resize: none" class="form-control" rows="5" id="descricaoInput" name="descricaoInput"></textarea>
              </div>

              <hr style="width: 97.5%;" />

              <div class="form-group col-sm-2">
                  <b>Detalhes</b>
              </div>

              <hr style="width: 97.5%;" />

                <div class="form-group col-sm-6">
                    <label for="marcaInput">Marca</label>
                    <input type="text" class="form-control" id="marcaInput" name="marcaInput" placeholder="Marca">
                  </div>
                <div class="form-group col-sm-6">
                    <label for="tipoInput">Tipo</label>
                    <input type="text" class="form-control" id="tipoInput" name="tipoInput" placeholder="Tipo">
                </div>
                <div class="form-group col-sm-6">
                    <label for="materialInput">Material</label>
                    <input type="text" class="form-control" id="materialInput" name="materialInput" placeholder="Material">
                </div>
                <div class="form-group col-sm-6">
                    <label for="visitintInput">Visitint</label>
                    <input type="text" class="form-control" id="visitintInput" name="visitintInput" placeholder="Visitint">
                </div>

                <hr style="width: 97.5%;" />

                <div class="form-group col-sm-12">
                    <label class="btn btn-theme">
                        <i class="fa fa-folder-open" aria-hidden="true"></i> &MediumSpace; Escolher imagem do produto... <input type="file" id="foto" name="foto" hidden>
                    </label>
                </div>

                <hr style="width: 97.5%;" />

                <div class="col-xs-12">
                    <button id="cadastrar" type="submit" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> &MediumSpace; Cadastrar Produto</button>
                </div>
             </form>
          </div>
        </div>
        <!-- End Register Form -->

      </div>
    </div>
    <!-- End Main Content -->

    <!-- Footer -->
    <div class="footer">
      <div class="text-center copyright">
        Copyright &copy; 2017 ELentes Todos os direitos reservados
      </div>
    </div>
    <!-- End Footer -->

    <a href="#top" class="back-top text-center" onclick="$('body,html').animate({scrollTop:0},500); return false">
      <i class="fa fa-angle-double-up"></i>
    </a>

    <div class="chooser chooser-hide">
      <div class="chooser-toggle"><button class="btn btn-warning" type="button"><i class="fa fa-paint-brush bigger-130"></i></button></div>
      <div class="chooser-content">
        <label>Cor</label>
        <select name="color-chooser" id="color-chooser" class="form-control input-sm selectpicker">
          <option value="indigo">Roxo</option>
          <option value="red">Vermelho</option>
          <option value="teal">Turquesa</option>
          <option value="brown">Marrom</option>
        </select>
        <label class="m-t-1">Style</label>
        <select name="style-chooser" id="style-chooser" class="form-control input-sm selectpicker">
          <option value="flat">Quadrado</option>
          <option value="rounded">Arredondado</option>
        </select>
      </div>
    </div>

    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap3-typeahead.js"></script>
    <script src="js/bootstrap-toolkit.js"></script>
    <script src="js/mimity.js"></script>
  </body>
</html>
<?php

if(isset($_GET['go'])) {
    
    if($_GET['go'] == 'sair') {
        
        unset($_SESSION['admin']);
        echo "<meta http-equiv='refresh' content='0, ./'>";
    }
}