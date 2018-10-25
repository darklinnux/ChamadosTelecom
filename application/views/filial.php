<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Filial
        <small>Lista de Filial</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cadastro</a></li>
        <li class="active">Filial</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              
              <div>
                <h3 class="box-title">Cadastros</h3>
                <button style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">Nova Filial</button>    
              </div>
              
            </div>
            <hr>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Numero</th>
                  <th>Nome</th>
                  <th>Cidade</th>
                  <th>Estado</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach($filiais as $filial) {?>
                  <tr>
                    <td><?=$filial->fil_numero?></td>
                    <td><?=$filial->fil_nome?></td>
                    <td><?=$filial->cid_nome?></td>
                    <td><?=$filial->est_sigla?></td>
                    <td>
                      <div class="btn-group">
                          <button type="button" class="btn btn-primary">Opções</button>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                          <ul class="dropdown-menu" role="menu">
                              <li><a onclick="modalEditar(<?=$filial->fil_id?>);" href="#">Editar</a></li>
                              <li class="divider"></li>
                              <li><a href="#" onclick="modalRemover(<?=$filial->fil_id?>)">Remover</a></li>
                          </ul>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cadastro Filial</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Filial:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input type="text" class="form-control">
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Numero Filial:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <span>@</span>
                        </div>
                        <input name="filial" type="text" class="form-control">
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Cidade:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-key"></i>
                        </div>
                        <select name="cidade" class="form-control">
                          <?php foreach($cidades as $cidade) ?>
                          <option value="<?=$cidade->cid_id?>"><?=$cidade->cid_nome?></option>
                        </select>
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                </div>
              </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn btn-primary ">Salvar</button>
                <button type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->