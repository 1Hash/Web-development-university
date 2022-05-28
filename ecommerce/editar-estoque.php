<?php

    session_start();

    require_once("./models/ModelEstoque.class.php");
    require_once("./classes/Estoque.class.php");
    
    require_once("./models/ModelProduto.class.php");
    require_once("./classes/Produto.class.php");
    
    $produto = new Produto(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

    $estoque = new Estoque(null, null, null, null, null, null, null, null, null, null, null);
    
    $idEstoque = $_POST['idEstoque'];
    
    $idProduto = 0;
    
    foreach ($estoque->funcaoGetEstoque($idEstoque) as $var) {
        $idProduto = $var['idProduto'];
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Adicionar ao Estoque - ELentes</title>
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
        
        var idEstoque = <?php echo $idEstoque; ?>;
        
        $(document).ready(function(){
            $('#produtoInputEstoque').change(function(){

                var idProduto = $('#produtoInputEstoque').val();

                $('#parametrosEstoque2').load('./controls/controlEstoque.php?carregarParametros='+idProduto+'&idEstoque='+idEstoque+' #parametrosEstoque2');
            });
            
            $(window).load(function() {
                               
                var idProduto = <?php echo $idProduto; ?>

                $('#parametrosEstoque2').load('./controls/controlEstoque.php?carregarParametros2='+idProduto+'&idEstoque='+idEstoque+' #parametrosEstoque2');
            });
        
        $(function ($) {
            
            $('#formulario').on('submit', function () {


                        // Armazenando objetos em variáveis para utilizá-los posteriormente
                        var formulario = $(this);
                        var botao = $('#btnEditarEstoque');
                        var textoBotao = $('#btnEditarEstoque').text();
                        var mensagem = $('#mensagem');

                        // Exibindo indicador de carregamento (Bootstrap)
                        botao.button('...');

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
                                botao.button(textoBotao);

                            },

                            // Se houver algum erro na requisição
                            error: function () {

                                // Definindo estilo da mensagem (erro)
                                mensagem.attr('class', 'alert alert-danger alert-dismissable');
                                $('body,html').animate({scrollTop:0},500);

                                // Exibindo mensagem
                                mensagem.html('Ops, ocorreu um erro');

                                // Escondendo indicador de carregamento
                                botao.button(textoBotao);
                            }
                        });

                        return false;
                    //}
                });
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
            <a href="index-admin.html"><img alt="Logo" src="images/logo-teal.png" class="img-responsive" data-text-logo="ELentes-logo" /></a>
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
              <li><a href="index-admin.html">Home</a></li>
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
          <li class="active">Editar Estoque</li>
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
          <div class="title"><span>Editar Estoque</span></div>
          <div class="row">
            <form id="formulario" method="POST" action="./controls/controlEstoque.php">
              <div class="form-group col-sm-6">
                  
                  <input type="text" id="idEstoque" name="idEstoque" class="hidden" value="<?php echo $idEstoque; ?>"/>
                  
                <label for="produtoInputEstoqueEdit">Produto</label>
                <select class="form-control selectpicker" id="produtoInputEstoqueEdit" name="produtoInputEstoqueEdit" disabled>                 
                  <?php                     
                    foreach ($produto->getProduto($idProduto) as $var) {
                        echo "<option value=".$var['idProduto'].">".$var['nome']."</option>";
                    }                  
                  ?>                  
                </select>
                
                <select class="form-control selectpicker hidden" id="produtoInputEstoqueE" name="produtoInputEstoqueE">                 
                  <?php                     
                    foreach ($produto->getProduto($idProduto) as $var) {
                        echo "<option value=".$var['idProduto'].">".$var['nome']."</option>";
                    }                  
                  ?>                  
                </select>
              </div>
              <div id="parametrosEstoque2"></div>
              
                <div class="form-group col-sm-6">
                    <label for="inputQuantidadeEstoque">Quantidade</label>
                    <input type="text" class="form-control" id="inputQuantidadeEstoque" name="inputQuantidadeEstoque" <?php foreach ($estoque->funcaoGetEstoque($idEstoque) as $var) { echo "value=".$var['quantidade'].""; } ?> placeholder="Quantidade">
                </div>
              
              <hr style="width: 97.5%;" />

              <div class="col-xs-12">
                <button type="submit" id="btnEditarEstoque" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> &MediumSpace; Salvar</button>
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

    <script src="bootstrap/js/bootstrap.js"></script>
    <!-- Plugins -->
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap3-typeahead.js"></script>
    <script src="js/bootstrap-toolkit.js"></script>
    <script src="js/mimity.js"></script>
  </body>
</html>
<?php

function retirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}