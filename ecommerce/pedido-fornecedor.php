<?php
    session_start();
    
    $_SESSION['listaProdutos'] = array();
    
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
    <title>Fazer Pedido ao Fornecedor - ELentes</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Plugins -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.css" rel="stylesheet">
    <link href="css/owl.theme.default.css" rel="stylesheet">
    <link href="css/EL.css" rel="stylesheet">
    <link href="css/style.teal.flat.css" rel="stylesheet" id="theme">
    
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/mask.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/modal.js"></script>
    
    <script type="text/javascript">

    var torica;
    var multifocal;
    var colorida;

    $(document).ready(function(){

        //-------------------------------- Select fornecedor --------------------------------//

        $('#fornecedorInput').change(function(){
            
            $('#tabelaProdutos').load('./controls/controlProduto.php?excluirTodosProdutos='+true+' #tabelaProdutos');
            
            $('#selectEsferico').empty();
            $('#selectEsferico').html('<option>-- Esférico --</option>');
            $('#selectEsferico').val('');
            $('#selectEsferico').selectpicker('refresh');
            
            $('#selectCurvaBase').empty();
            $('#selectCurvaBase').html('<option>-- Curva Base --</option>');
            $('#selectCurvaBase').val('');
            $('#selectCurvaBase').selectpicker('refresh');
            
            $('#selectDiametro').empty();
            $('#selectDiametro').html('<option>-- Diâmetro --</option>');
            $('#selectDiametro').val('');
            $('#selectDiametro').selectpicker('refresh');
            
            $('#selectCilindro').empty();
            $('#selectCilindro').html('<option>-- Cilindro --</option>');
            $('#selectCilindro').val('');
            $('#selectCilindro').selectpicker('refresh');
            
            $('#selectEixo').empty();
            $('#selectEixo').html('<option>-- Eixo --</option>');
            $('#selectEixo').val('');
            $('#selectEixo').selectpicker('refresh');
            
            $('#selectAdicao').empty();
            $('#selectAdicao').html('<option>-- Adição --</option>');
            $('#selectAdicao').val('');
            $('#selectAdicao').selectpicker('refresh');
            
            $('#selectCor').empty();
            $('#selectCor').html('<option>-- Cor --</option>');
            $('#selectCor').val('');
            $('#selectCor').selectpicker('refresh');
            
            $("#cilindro").addClass("hidden");
            $("#eixo").addClass("hidden");
            $("#adicao").addClass("hidden");
            
            $('#inputQuantidade').val('');

            $('#produtoInput').load('./controls/controlFornecedor.php?fornecedor='+$('#fornecedorInput').val());
            getProdutos();
        });
        
        $('#produtoInput').on('click', function(event) {
            event.stopPropagation();
        });
        
        //-------------------------------- Select produto --------------------------------//
        
        $('#produtoInput').change(function(){
            
            $('#selectEsferico').load('./controls/controlFornecedor.php?esferico='+$('#produtoInput').val());
            getEsferico();
            $('#selectCurvaBase').load('./controls/controlFornecedor.php?curvabase='+$('#produtoInput').val());
            getCurvaBase();
            $('#selectDiametro').load('./controls/controlFornecedor.php?diametro='+$('#produtoInput').val());
            getDiametro();
            
            var idProduto = $('#produtoInput').val();
            
            $.post('./controls/controlFornecedor.php', { torica : idProduto },
                function(retorno) {
                    torica = retorno;
                    
                    $.post('./controls/controlFornecedor.php', { multifocal : idProduto },
                        function(retorno) {
                            multifocal = retorno;
                            
                            $.post('./controls/controlFornecedor.php', { cor : idProduto },
                                function(retorno) {
                                    colorida = retorno;
                                    
                                    if (torica === "1") {
                
                                        $("#cilindro").removeClass("hidden");
                                        $("#eixo").removeClass("hidden");

                                        $('#selectCilindro').load('./controls/controlFornecedor.php?cilindro='+$('#produtoInput').val());
                                        getCilindro();
                                        $('#selectEixo').load('./controls/controlFornecedor.php?eixo='+$('#produtoInput').val());
                                        getEixo();
                                    }
                                    else {
                                        
                                        $("#cilindro").addClass("hidden");
                                        $("#eixo").addClass("hidden");
                                    }
                                    
                                    if (multifocal === "1") {
                                        
                                        $("#adicao").removeClass("hidden");
                                        
                                        $('#selectAdicao').load('./controls/controlFornecedor.php?adicao='+$('#produtoInput').val());
                                        getAdicao();
                                    }
                                    else {
                                        
                                        $("#adicao").addClass("hidden");
                                    }
                                    
                                    if (colorida === "1") {
                                        
                                        $("#cor").removeClass("hidden");
                                        
                                        $('#selectCor').load('./controls/controlFornecedor.php?cor='+$('#produtoInput').val());
                                        getCor();
                                    }
                                    else {
                                        
                                        $("#cor").addClass("hidden");
                                    }
                            });
                    });
            });
        });
            
        $('#selectEsferico').on('click', function(event) {
            event.stopPropagation();
        });       

        $('.selectpicker').selectpicker({
            container: 'body'
        });
        
    });
    
    function getProdutos(){        
        $.ajax({
            url: './controls/controlFornecedor.php?fornecedor='+$('#fornecedorInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#produtoInput').selectpicker('refresh');
            }
        });
    };
    
    function getEsferico(){        
        $.ajax({
            url: './controls/controlFornecedor.php?esferico='+$('#produtoInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#selectEsferico').selectpicker('refresh');
            }
        });
    };
    
    function getCurvaBase(){        
        $.ajax({
            url: './controls/controlFornecedor.php?curvabase='+$('#produtoInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#selectCurvaBase').selectpicker('refresh');
            }
        });
    };
    
    function getDiametro(){        
        $.ajax({
            url: './controls/controlFornecedor.php?diametro='+$('#produtoInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#selectDiametro').selectpicker('refresh');
            }
        });
    };
    
    function getCilindro(){        
        $.ajax({
            url: './controls/controlFornecedor.php?cilindro='+$('#produtoInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#selectCilindro').selectpicker('refresh');
            }
        });
    };
    
    function getEixo(){        
        $.ajax({
            url: './controls/controlFornecedor.php?eixo='+$('#produtoInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#selectEixo').selectpicker('refresh');
            }
        });
    };
    
    function getAdicao(){        
        $.ajax({
            url: './controls/controlFornecedor.php?multifocal='+$('#produtoInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#selectAdicao').selectpicker('refresh');
            }
        });
    };
    
    function getCor(){        
        $.ajax({
            url: './controls/controlFornecedor.php?cor='+$('#produtoInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#selectCor').selectpicker('refresh');
            }
        });
    };
    
    $(function ($) {
        
        // -------------------------------------------------[ ESFÉRICO ]------------------------------------------------- //
        
        $('#adicionarPedidoFornecedor').click(function () {
            
            var idProduto = $('#produtoInput').val();
            var esferico = $('#selectEsferico').val();
            var curvaBase = $('#selectCurvaBase').val();
            var diametro = $('#selectDiametro').val();
            var cilindro;
            var eixo;
            var adicao;
            var cor;
            var quantidade = $('#inputQuantidade').val();
            
            if(torica === "1") {
                
                cilindro = $('#selectCilindro').val();
                eixo = $('#selectEixo').val();
            }
            
            if(multifocal === "1") {
                
                adicao = $('#selectAdicao').val();
            }
            
            if(colorida === "1") {
                
                cor = $('#selectCor').val();
            }

            $('#tabelaProdutos').load('./controls/controlProduto.php?produtoSession='+idProduto+'&esferico='+esferico+'&curvaBase='+curvaBase+'&diametro='+diametro+'&cilindro='+cilindro+'&eixo='+eixo+'&adicao='+adicao+'&cor='+cor+'&quantidade='+quantidade+' #tabelaProdutos');
    
        });
        
        $('#removerTodosPedidosFornecedor').click(function () {
            
            $('#tabelaProdutos').load('./controls/controlProduto.php?excluirTodosProdutos='+true+' #tabelaProdutos');
        });
        
        $(window).load(function() {
            <?php
                
               if (isset($_GET['el'])) {
                   ?>
                        $('#modalel').modal('show');
                   <?php
               }
            
            ?>
        });
        
        $('#modalel').on('hide.bs.modal', function () {
            window.location.href = 'consultar-estoque';
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
                    <li><a href="alterar-senha-admin.html">Alterar Senha</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Sair</a></li>
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
          <li><a href="consultar-estoque">Consultar Estoque</a></li>
          <li class="active">Fazer Pedido ao Fornecedor</li>
        </ol>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Main Content -->
    <div class="container m-t-3">
        
        <div id="modalel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modaleltext">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>                
                <div class="modal-body">
                    <h5>O seu pedido foi enviado para o fornecedor!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-theme" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
        </div>
        
      <div class="row">

        <!-- Register Form -->
        <div class="col-sm-12 m-b-3">
          <div class="title"><span>Fazer Pedido ao Fornecedor</span></div>
          <div class="row">
              <form id="formulario" method="POST" action="./controls/controlFornecedor.php">
                <div class="form-group col-sm-6">
                <label for="fornecedorInput">Fornecedor</label>
                <select class="form-control selectpicker" id="fornecedorInput" name="fornecedorInput" data-size="10" data-live-search="true">
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
                <div class="form-group col-sm-6">
                <label for="produtoInput">Produto</label>
                <select class="form-control selectpicker" id="produtoInput" name="produtoInput" data-size="10" data-live-search="true">
                  <option value="">Primeiro selecione um fornecedor</option>
                </select>
                </div>
                
                <div class="form-group col-sm-6">
                    <label for="selectEsferico">Esférico</label>
                    <select id="selectEsferico" class="form-control selectpicker" name="selectEsferico" data-size="10" data-live-search="true">
                      <option value="">-- Esférico --</option>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="selectCurvaBase">Curva Base</label>
                    <select id="selectCurvaBase" class="form-control selectpicker" name="selectCurvaBase" data-size="10" data-live-search="true">
                      <option value="">-- Curva Base --</option>
                    </select>
                </div>
                  
                <div class="form-group col-sm-6">
                    <label for="selectDiametro">Diâmetro</label>
                    <select id="selectDiametro" class="form-control selectpicker" name="selectDiametro" data-size="10" data-live-search="true">
                      <option value="">-- Diâmetro --</option>
                    </select>
                </div>
              
                <div id="eixo" class="form-group col-sm-6 hidden">
                    <label for="selectEixo">Eixo</label>
                    <select id="selectEixo" class="form-control selectpicker" name="selectEixo" data-size="10" data-live-search="true">
                      <option value="">-- Eixo --</option>
                    </select>
                </div>
              
                <div id="cilindro" class="form-group col-sm-6 hidden">
                    <label for="selectCilindro">Cilíndro</label>
                    <select id="selectCilindro" class="form-control selectpicker" name="selectCilindro" data-size="10" data-live-search="true">
                      <option value="">-- Cilíndro --</option>
                    </select>
                </div>             
                <div id="adicao" class="form-group col-sm-6 hidden">
                    <label for="selectAdicao">Adição</label>
                    <select id="selectAdicao" class="form-control selectpicker" name="selectAdicao" data-size="10" data-live-search="true">
                      <option value="">-- Adição --</option>
                    </select>
                </div>
              
                <div id="cor" class="form-group col-sm-6 hidden">
                    <label for="selectCor">Cor</label>
                    <select id="selectCor" class="form-control selectpicker" name="selectCor" data-size="10" data-live-search="true">
                      <option value="">-- Cor --</option>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="inputQuantidade">Quantidade</label>
                    <input class="form-control" id="inputQuantidade" name="inputQuantidade" type="text" maxlength="2" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Quantidade">
                </div>
              
              <hr style="width: 97.5%;" />
              
              <div class="form-group col-sm-12">
                    <button type="button" id="adicionarPedidoFornecedor" class="btn btn-theme">Adicionar &MediumSpace;<i class="fa fa-plus-square" aria-hidden="true"></i></button>
                    <button type="button" id="removerTodosPedidosFornecedor" class="btn btn-theme floatright">Remover tudo &MediumSpace;<i class="fa fa-minus-square" aria-hidden="true"></i></button>
                </div>

                <div id="tabelaProdutos"></div>
          
            <hr style="width: 97.5%;" />
            
            <div class="form-group col-sm-12">
                <label for="obsPedidoFornecedor">Observação</label>
                <textarea style="resize: none" class="form-control" rows="5" id="obsPedidoFornecedor" name="obsPedidoFornecedor"></textarea>
              </div>
              
            <div class="col-xs-12">
              <button type="submit" id="enviarPedido" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> &MediumSpace; Enviar Pedido</button>
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
        <label>Color</label>
        <select name="color-chooser" id="color-chooser" class="form-control input-sm selectpicker">
          <option value="indigo">Indigo</option>
          <option value="red">Red</option>
          <option value="teal">Teal</option>
          <option value="brown">Brown</option>
        </select>
        <label class="m-t-1">Style</label>
        <select name="style-chooser" id="style-chooser" class="form-control input-sm selectpicker">
          <option value="flat">Flat</option>
          <option value="rounded">Rounded</option>
        </select>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.js"></script>
    <!-- Plugins -->
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap3-typeahead.js"></script>
    <script src="js/bootstrap-toolkit.js"></script>
    <script src="js/mimity.js"></script>
  </body>
</html>
<?php

