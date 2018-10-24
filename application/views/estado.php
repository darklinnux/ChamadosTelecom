<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Estado
        <small>Lista de Estado</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cadastro</a></li>
        <li class="active">Estado</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if($this->session->sucess) {?>
      <div id="sucesso" class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                  <?=$this->session->sucess?>
      </div>
      <?php } ?>
      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              
              <div>
                <h3 class="box-title">Cadastros</h3>
                <button style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">Nova Estado</button>    
              </div>
              
            </div>
            <hr>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Estado</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($estados as $estado){ ?>
                <tr>
                  
                  <td><?=$estado->est_id?></td>
                  <td><?=$estado->est_sigla?></td>
                  <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Opções</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a onclick="modalEditar(<?=$estado->est_id?>);" href="#">Editar</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onclick="modalRemover(<?=$estado->est_id?>)">Remover</a></li>
                        </ul>
                    </div>
                  </td>
                  
                </tr>
                <?php } ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

    </section>
    <!-- /.content -->
  </div>
  <form action="<?=base_url('estado/cadastrar')?>" method="post">
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro Estado</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Sigla Estado:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input name="sigla" type="text" class="form-control">
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                </div>
              </div>
              <div class="modal-footer text-center">
                <button type="submit" class="btn btn-primary ">Salvar</button>
                <button type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  </form>

  <form action="<?=base_url('estado/cadastrar')?>" method="post">
  <div class="modal fade" id="modal-editar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro Estado</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Sigla Estado:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input name="sigla" type="text" class="form-control">
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                </div>
              </div>
              <div class="modal-footer text-center">
                <button type="submit" class="btn btn-primary ">Salvar</button>
                <button type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  </form>