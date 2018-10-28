<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <div class="content-wrapper">
  <section class="content-header">
    <h1>
      Dashboard
      <small>Painel de Controle</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>05</h3>

            <p>Novos Chamados</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>10</h3>

            <p>Chamados Finalizados</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>3</h3>

            <p>Chamados em andamento</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>1</h3>

            <p>Pedencias</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">Mais Informações <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
</div>
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de Chamados</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Protocolo</th>
                    <th>Empresa</th>
                    <th>Status</th>
                    <th>Filial</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Wirelink</td>
                    <td><span class="label label-success">Finalizado</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">24-Super Marabá</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Embratel</td>
                    <td><span class="label label-success">Finalizado</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">28-Mix Paraupebas</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>OI</td>
                    <td><span class="label label-warning">Andamento</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">26-Mix Marabá</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>Embratel</td>
                    <td><span class="label label-primary">Aberto</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00c0ef" data-height="20">134-Eletro</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Embratel</td>
                    <td><span class="label label-success">Finalizado</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">28-Mix Paraupebas</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>OI</td>
                    <td><span class="label label-warning">Andamento</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">26-Mix Marabá</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Wirelink</td>
                    <td><span class="label label-success">Finalizado</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">24-Super Marabá</div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>

    </section>
    <!-- /.content -->
  </div>