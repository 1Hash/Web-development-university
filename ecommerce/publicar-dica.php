<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Publicar Dica - ELentes</title>
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

    $(function ($) {

        // Quando enviado o formulário
        $('#formulario').on('submit', function () {

                // Armazenando objetos em variáveis para utilizá-los posteriormente
                var formulario = $(this);
                var botao = $('#salvar');
                var mensagem = $('#mensagem');
                
                

                // Exibindo indicador de carregamento (Bootstrap)
                botao.button('Publicando...');
                
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
                    error: function (retorno) {

                        // Definindo estilo da mensagem (erro)
                        mensagem.attr('class', 'alert alert-danger alert-dismissable');
                        $('body,html').animate({scrollTop:0},500);

                        // Exibindo mensagem
                        mensagem.html(retorno.mensagem);

                        // Escondendo indicador de carregamento
                        botao.button('reset');
                    }
                });

                return false;
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
          <li class="active">Publicar Dica</li>
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
          <div class="title"><span>Publicar Dica</span></div>
          <div class="row">
            <form id="formulario" method="POST" action="./controls/controlDica.php">
              <div class="form-group col-sm-6">
                <label for="tituloDicaInput">Título</label>
                <input type="text" class="form-control" id="tituloDicaInput" name="tituloDicaInput" required="required" placeholder="Título">
              </div>
              <div class="form-group col-sm-12">
                <label for="descricaoDicaInput">Descrição</label>
                <textarea style="resize: none" class="form-control" rows="5" id="descricaoDicaInput" name="descricaoDicaInput" required="required"></textarea>
              </div>
                
            <div class="form-group col-sm-12">
                <label class="btn btn-theme">
                    <i class="fa fa-folder-open" aria-hidden="true"></i> &MediumSpace; Escolher imagem... <input type="file" id="foto" name="foto" hidden>
                </label>
            </div>
              
              <hr style="width: 96%;" />

              <div class="col-xs-12">
                <button id="salvar" type="submit" class="btn btn-theme"><i class="fa fa-long-arrow-right"></i> Publicar Dica</button>
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

if(isset($_GET['go'])) {
    
    if($_GET['go'] == 'sair') {
        
        unset($_SESSION['admin']);
        echo "<meta http-equiv='refresh' content='0, ./'>";
    }
}