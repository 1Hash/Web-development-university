<?php

session_start();

require_once("./conexao.class.php");

require_once("./models/ModelFornecedor.class.php");
require_once("./models/ModelEC.class.php");

require_once("./classes/Fornecedor.class.php");
require_once("./classes/EC.class.php");

if (!isset($_SESSION['admin'])) {
    header('Location: ./index.php');
}
else {

    $id = $_POST['idFornecedor'];
    
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Alterar Fornecedor - ELentes</title>
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
    
    <script type="text/javascript">
        
    jQuery.validator.addMethod("cnpj", function(cnpj, element) {
        cnpj = jQuery.trim(cnpj);

             // DEIXA APENAS OS NÚMEROS
        cnpj = cnpj.replace('/','');
        cnpj = cnpj.replace('.','');
        cnpj = cnpj.replace('.','');
        cnpj = cnpj.replace('-','');

        var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
        digitos_iguais = 1;

        if (cnpj.length < 14 && cnpj.length < 15){
           return this.optional(element) || false;
        }
        for (i = 0; i < cnpj.length - 1; i++){
           if (cnpj.charAt(i) != cnpj.charAt(i + 1)){
              digitos_iguais = 0;
              break;
           }
        }

        if (!digitos_iguais){
           tamanho = cnpj.length - 2
           numeros = cnpj.substring(0,tamanho);
           digitos = cnpj.substring(tamanho);
           soma = 0;
           pos = tamanho - 7;

           for (i = tamanho; i >= 1; i--){
              soma += numeros.charAt(tamanho - i) * pos--;
              if (pos < 2){
                 pos = 9;
              }
           }
           resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
           if (resultado != digitos.charAt(0)){
              return this.optional(element) || false;
           }
           tamanho = tamanho + 1;
           numeros = cnpj.substring(0,tamanho);
           soma = 0;
           pos = tamanho - 7;
           for (i = tamanho; i >= 1; i--){
              soma += numeros.charAt(tamanho - i) * pos--;
              if (pos < 2){
                 pos = 9;
              }
           }
           resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
           if (resultado != digitos.charAt(1)){
              return this.optional(element) || false;
           }
           return this.optional(element) || true;
        }else{
           return this.optional(element) || false;
        }
     }, "Informe um CNPJ válido."); // Mensagem padrão


    $(document).ready(function(){

        $('#estadoInput').change(function(){

            $('#cidadeInput').load('listacidades.php?estado='+$('#estadoInput').val());
            getCidades();
            
        });
        
        $("#formulario").validate({
            rules: {
                razaoSocialInput: {
                    required: true,
                    minlength: 3
                },
                cnpjInput: {
                    required: true,
                    cnpj: true
                },
                inscricaoEstadualInput: {
                    required: true
                },
                telefoneInput: {
                    required: true
                },
                emailInput: {
                    required: true,
                    minlength: 3,
                    email: true
                },
                cepInput: {
                    required: true
                },
                enderecoInput: {
                    required: true,
                    maxlength: 100,
                    minlength: 5
                },
                numeroInput: {
                    required: true,
                    number: true,
                    maxlength: 10,
                    minlength: 1
                },
                complementoInput: {
                    maxlength: 50
                },
                bairroInput: {
                    required: true,
                    maxlength: 50,
                    minlength: 3
                },
                estadoInput: {
                    required: true
                },
                cidadeInput: {
                    required: true
                }
            },
            messages: {
                razaoSocialInput: {
                    required: "Insira uma Razão Social!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                cnpjInput: {
                    required: "Insira um CNPJ!",
                    cnpj: "CNPJ inválido!"
                },
                inscricaoEstadualInput: {
                    required: "Insira uma Inscrição Estadual!"
                },
                telefoneInput: {
                    required: "Insira seu telefone!",
                    number: "Utilize apenas números!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                emailInput: {
                    required: "Insira seu e-mail!",
                    minlength: "Por favor, utilize mais caracteres!",
                    email: "Insira um e-mail válido!"
                },
                cepInput: {
                    required: "Insira seu CEP!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                enderecoInput: {
                    required: "Insira seu endereço!",
                    maxlength: "Por favor, utilize menos caracteres!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                numeroInput: {
                    required: "Insira seu número de endereço!",
                    number: "Utilize apenas números!",
                    maxlength: "Por favor, utilize menos caracteres!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                complementoInput: {
                    maxlength: "Por favor, utilize menos caracteres!"
                },
                bairroInput: {
                    required: "Insira seu bairro!",
                    maxlength: "Por favor, utilize menos caracteres!",
                    minlength: "Por favor, utilize mais caracteres!"
                },
                estadoInput: {
                    required: "Selecione um Estado!"
                },
                cidadeInput: {
                    required: "Selecione uma Cidade!"
                }
            }
        });
    });
       
    function getCidades(){        
        $.ajax({
            url: 'listacidades.php?estado='+$('#estadoInput').val(),
            type: 'GET',
            error: function(){
            },
            success: function(){
                $('#cidadeInput').selectpicker('refresh');
            }
        });
    };

    jQuery(function($){
        $("#telefoneInput").mask("(99) 9999-9999");
    });
    
    jQuery(function($){
        $("#cnpjInput").mask("99.999.999/9999-99");
    });
    
    jQuery(function($){
        $("#cepInput").mask("99999-999");
    });

    // Quando carregado a página
    $(function ($) {

        // Quando enviado o formulário
        $('#formulario').on('submit', function () {

            if(!$("#formulario").valid()) {
                return false;
            }
            else {

                // Armazenando objetos em variáveis para utilizá-los posteriormente
                var formulario = $(this);
                var botao = $('#salvar');
                var mensagem = $('#mensagem');

                // Exibindo indicador de carregamento (Bootstrap)
                botao.button('Alterando...');

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
                        botao.button('reset');

                    },

                    // Se houver algum erro na requisição
                    error: function () {

                        // Definindo estilo da mensagem (erro)
                        mensagem.attr('class', 'alert alert-danger alert-dismissable');
                        $('body,html').animate({scrollTop:0},500);

                        // Exibindo mensagem
                        mensagem.html('Ops, ocorreu um erro');

                        // Escondendo indicador de carregamento
                        botao.button('reset');
                    }
                });

                return false;
            }
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
          <li><a href="consultar-fornecedor">Consultar Fornecedor</a></li>
          <li class="active">Alterar Fornecedor</li>
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
          <div class="title"><span>Alterar Fornecedor</span></div>
          <div class="row">
              <form id="formulario" method="POST" action="./controls/controlFornecedor.php">
                  
                <?php                  
                $fornecedor = new Fornecedor(null, null, null, null, null, null, null, null, null, null, null, null, null);

                foreach($fornecedor->getFornecedor($id) as $var) {
                ?>
              <input type="text" class="hidden" id="idFornecedorInput" name="idFornecedorInput" value="<?php echo $var['idFornecedor']; ?>">
              <div class="form-group col-sm-6">
                <label for="razaoSocialInput">Razão Social</label>
                <input type="text" class="form-control" id="razaoSocialInput" name="razaoSocialInputEdit" value="<?php echo $var['razaoSocial']; ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="cnpjInput">CNPJ</label>
                <input type="text" class="form-control" id="cnpjInput" name="cnpjInput" value="<?php echo $var['cnpj']; ?>">
              </div>
              <hr style="width: 98%;" />
              <div class="form-group col-sm-6">
                <label for="inscricaoEstadualInput">Inscrição Estadual</label>
                <input type="text" class="form-control" id="inscricaoEstadualInput" name="inscricaoEstadualInput" value="<?php echo $var['inscricaoEstadual']; ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="telefoneInput">Telefone</label>
                <input type="text" class="form-control" id="telefoneInput" name="telefoneInput" value="<?php echo $var['telefone']; ?>">
              </div>
              <hr style="width: 98%;" />
              <div class="form-group col-sm-6">
                <label for="estadosInput">Estado</label>
                <select class="form-control selectpicker" id="estadoInput" name="estadoInput">
                  <?php
                    
                        $ec = new EC();

			foreach($ec->ConsultarEstadoSelecionado($var['idEstado']) as $varEC) {
                            echo "<option value='".$varEC['idEstado']."'>".$varEC['estNome']."</option>";
			}	

			foreach($ec->ConsultarEstados($var['idEstado']) as $varEC) {
                            echo "<option value='".$varEC['idEstado']."'>".$varEC['estNome']."</option>";
			}
                    ?>
                </select>
              </div>
              <div class="form-group col-sm-6">
                <label for="cidadeInput">Cidade</label>
                <select class="form-control selectpicker" id="cidadeInput" name="cidadeInput">
                  <?php
                    
                        $ec = new EC();

			foreach($ec->ConsultarCidadeSelecionada($var['idCidade']) as $varEC) {
                            echo "<option value='".$varEC['idCidade']."'>".$varEC['cidNome']."</option>";
			}	

			foreach($ec->ConsultarCidades($var['idEstado'], $var['idCidade']) as $varEC) {
                            echo "<option value='".$varEC['idCidade']."'>".$varEC['cidNome']."</option>";
			}
                    ?>
                </select>
              </div>
              <hr style="width: 98%;" />
              <div class="form-group col-sm-6">
                <label for="emailInput">E-mail</label>
                <input type="email" class="form-control" id="emailInput" name="emailInput" value="<?php echo $var['e-mail']; ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="cepInput">CEP</label>
                <input type="text" class="form-control" id="cepInput" name="cepInput" value="<?php echo $var['cep']; ?>">
              </div>
              <hr style="width: 98%;" />
              <div class="form-group col-sm-6">
                <label for="enderecoInput">Endereço</label>
                <input type="text" class="form-control" id="enderecoInput" name="enderecoInput" value="<?php echo $var['endereco']; ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="numeroInput">Número</label>
                <input type="text" class="form-control" id="numeroInput" name="numeroInput" value="<?php echo $var['numero']; ?>">
              </div>
              <hr style="width: 98%;" />
              <div class="form-group col-sm-6">
                <label for="complementoInput">Complemento</label>
                <input type="text" class="form-control" id="complementoInput" name="complementoInput" value="<?php echo $var['complemento']; ?>">
              </div>
              <div class="form-group col-sm-6">
                <label for="bairroInput">Bairro</label>
                <input type="text" class="form-control" id="bairroInput" name="bairroInput" value="<?php echo $var['bairro']; ?>">
              </div>
              
              <?php } ?>
              
              <hr style="width: 98%;" />
                
              <div class="form-group col-sm-6"></div>               
                <div class="col-xs-12">
                    <button type="submit" id="salvar" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> &MediumSpace; Salvar</button>
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
}

if(isset($_GET['go'])) {
    
    if($_GET['go'] == 'sair') {
        
        unset($_SESSION['admin']);
        echo "<meta http-equiv='refresh' content='0, ./'>";
    }
}