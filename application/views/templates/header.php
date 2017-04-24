<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Projeto Ecopontos</title>

        <link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.2.0.min.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Projeto Ecopontos</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li <?php
                        if ($this->uri->segment(1) === null) {
                            echo 'class="active"';
                        }
                        ?>>
                            <a href="<?php echo base_url() ?>">Início</a>
                        </li>

                        <li class="dropdown <?php
                        if ($this->uri->segment(1) == "usuario") {
                            echo 'active';
                        }
                        ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url() . 'index.php/usuario/cadastrar' ?>">Cadastro de usuario</a></li>
                                <?php if ($this->session->userdata('tipo') == 1) { ?>
                                    <li><a href="<?php echo base_url() . 'index.php/usuario/listar' ?>">Listagem de usuarios</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="dropdown <?php
                        if ($this->uri->segment(1) == "pontoColeta") {
                            echo 'active';
                        }
                        ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pontos de coleta <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php if ($this->session->userdata('tipo') == 1) { ?>
                                    <li><a href="<?php echo base_url() . 'index.php/pontoColeta/cadastrar' ?>">Cadastrar pontos de coleta</a></li>
                                    <li><a href="<?php echo base_url() . 'index.php/pontoColeta/listar' ?>">Listar pontos de coleta</a></li>
                                <?php } ?>
                                <li><a href="<?php echo base_url() . 'index.php/pontoColeta/view' ?>">Visualizar pontos de coleta</a></li>
                            </ul>
                        </li>
                        <?php if ($this->session->userdata('tipo') == 1) { ?>
                            <li class="dropdown <?php
                            if ($this->uri->segment(1) == "tipoResiduo") {
                                echo 'active';
                            }
                            ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tipos de res&iacute;duo<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url() . 'index.php/tipoResiduo/cadastrar' ?>">Cadastrar tipos de res&iacute;duo</a></li>
                                    <li><a href="<?php echo base_url() . 'index.php/tipoResiduo/listar' ?>">Listar tipos de res&iacute;duo</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                        <li><?php
                            if (null !== $this->session->userdata('nome')) {
                                echo "<a>Bem vindo, " . $this->session->userdata('nome') . '</a></li>';
                                echo '<li><a href="' . base_url() . 'index.php/login/logout ">Logout</a>';
                            } else {
                                echo '<li><a href="' . base_url() . 'index.php/login ">Login</a></li>';
                            }
                            ?></li>
                    </ul>
                </div>
            </div>
        </nav>