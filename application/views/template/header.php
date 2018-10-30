<?php defined('BASEPATH') OR exit('No direct script access allowed');
$pagina = ($this->uri->segment(1)) ? $this->uri->segment(1): "dashboard";
$metodo = $this->uri->segment(2);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chamados | <?=ucfirst($pagina) ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/Ionicons/css/ionicons.min.css')?>">
  <!-- DataTable -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')?>">
  <!-- Select 2 -->
  <link rel="stylesheet" href="<?=base_url("assets/bower_components/select2/dist/css/select2.min.css")?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/dist/css/AdminLTE.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url('assets/dist/css/skins/_all-skins.min.css')?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/morris.js/morris.css')?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/jvectormap/jquery-jvectormap.css')?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url()?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Chamados</b>Telecom</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a> -->
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url('assets/dist/img/avatar.png')?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url('assets/dist/img/user3-128x128.jpg')?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url('assets/dist/img/user4-128x128.jpg')?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url('assets/dist/img/user3-128x128.jpg')?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=base_url('assets/dist/img/user4-128x128.jpg')?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a> -->
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a> -->
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url('assets/dist/img/avatar.png')?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Ramon Lima</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url('assets/dist/img/avatar.png')?>" class="img-circle" alt="User Image">

                <p>
                  <?=$this->session->usu_nome?>
                  <small><?=$this->session->usu_perfil?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="text-center">
                  <a href="<?=base_url('login/deslogar')?>" class="btn btn-default btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url('assets/dist/img/avatar.png')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->usu_nome?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?=$this->session->usu_perfil?></a>
        </div>
      </div>
      <a href="<?=base_url('chamado')?>" class="btn btn-block btn-primary" >Novo Chamado</a>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu de Navegação</li>
        <li class="<?=($pagina == "dashboard") ? "active" : null?>">
          <a href="<?=base_url()?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview <?=($pagina !== "dashboard" && $pagina !== "chamado" && $pagina !== "ChamadoInterno") ? "active menu-open" : null?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Cadastros</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?=($pagina == "usuario") ? "active" : null?>"><a href="<?=base_url("usuario")?>"><i class="fa fa-circle-o"></i> Usuário</a></li>
            <li class="<?=($pagina == "sintoma") ? "active" : null?>"><a href="<?=base_url("sintoma")?>"><i class="fa fa-circle-o"></i> Sintoma</a></li>
            <li class="<?=($pagina == "filial") ? "active" : null?>"><a href="<?=base_url("filial")?>"><i class="fa fa-circle-o"></i> Filial</a></li>
            <li class="<?=($pagina == "cidade") ? "active" : null?>"><a href="<?=base_url("cidade")?>"><i class="fa fa-circle-o"></i> Cidade</a></li>
            <li class="<?=($pagina == "estado") ? "active" : null?>"><a href="<?=base_url("estado")?>"><i class="fa fa-circle-o"></i> Estado</a></li>
            <li class="<?=($pagina == "empresa") ? "active" : null?>"><a href="<?=base_url("empresa")?>"><i class="fa fa-circle-o"></i> Empresa</a></li>
            <li class="<?=($pagina == "setor") ? "active" : null?>"><a href="<?=base_url("setor")?>"><i class="fa fa-circle-o"></i> Setor</a></li>
          </ul>
        </li>
        <li class="treeview <?=($pagina !== "dashboard" && $pagina == "chamado") ? "active menu-open" : null?>">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Chamados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?=($pagina == "") ? "active" : null?>"><a href="<?=base_url("usuario")?>"><i class="fa fa-circle-o"></i> Aberto/Andamento</a></li>
            <li class="<?=($pagina == "") ? "active" : null?>"><a href="<?=base_url("sintoma")?>"><i class="fa fa-circle-o"></i> Fechados</a></li>
          </ul>
        </li>
        <li class="treeview <?=($pagina == "ChamadoInterno") ? "active menu-open" : null?>">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Chamados Internos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?=($metodo == "aberto") ? "active" : null?>"><a href="<?=base_url("ChamadoInterno/aberto")?>"><i class="fa fa-circle-o"></i> Aberto/Andamento</a></li>
            <li class="<?=($metodo == "fechado") ? "active" : null?>"><a href="<?=base_url("ChamadoInterno/fechado")?>"><i class="fa fa-circle-o"></i> Fechados</a></li>
          </ul>
        </li>
        <li class="">
          <a href="#">
            <i class="fa fa-table"></i> <span>Relatórios</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>