<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?= base_url("assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")?>">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Chamado
        <small>Lista de Chamado</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cadastro</a></li>
        <li class="active">chamado</li>
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
      <?php if($this->session->error){ ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                <?=$this->session->error?>
              </div>
      <?php } ?>

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              
              <div>
                <h3 class="box-title">Cadastros</h3>
                <button style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">Novo Chamado</button>    
              </div>
              
            </div>
            <hr>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Localidade</th>
                  <th>Chamado</th>
                  <th>Protocolo</th>
                  <th>Previsão</th>
                  <th>Usuario</th>
                  <th>Status</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach($chamados as $chamado) {?>
                  <tr>
                    <td><?=$chamado->fil_numero?>-<?=$chamado->fil_nome?></td>
                    <td><?=$chamado->emp_nome?></td>
                    <td><?=$chamado->cha_protocolo?></td>
                    <td><?=$chamado->cha_previsao?></td>
                    <td><?=$chamado->usu_login?></td>
                    <td><?=$chamado->stc_status?></td>
                    <td>
                      <div class="btn-group">
                          <button type="button" class="btn btn-primary">Opções</button>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                          <ul class="dropdown-menu" role="menu">
                              <li><a onclick="modalEditar(<?=$chamado->cha_id?>);" href="#">Editar</a></li>
                              <li class="divider"></li>
                              <li><a href="#" onclick="modalRemover(<?=$chamado->cha_id?>)">Remover</a></li>
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
  <form method="POST" action="<?=base_url('chamado/cadastrar')?>">
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Novo Chamado</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label>Protocolo:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input placeholder="Digite o protocolo do atendimento" id="protocolo" name="protocolo" type="text" class="form-control">
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Inicio:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input disabled type="text" class="form-control" value="<?=date('d/m/y')?>">
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Previsão:</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input name="previsao" type="text" class="form-control pull-right" id="datepicker">
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Atendente:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-key"></i>
                        </div>
                        <input placeholder="Nome do atendente" id="atendente" name="atendente" type="text" class="form-control">
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Empresa</label>
                      <select name="empresa" class="form-control select2" style="width: 100%;">
                        <?php foreach($empresas as $empresa) { ?>
                          <option value="<?=$empresa->emp_id?>"><?=$empresa->emp_nome?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Filiais</label>
                      <select name="filial[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione as filiais"
                              style="width: 100%;">
                        <?php foreach($filiais as $filial){ ?>
                          <option value="<?=$filial->fil_id?>"><?=$filial->fil_numero?>-<?=$filial->fil_nome?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Sintomas</label>
                      <select name="sintoma[]" class="form-control select2" multiple="multiple" data-placeholder="Nome do atendente" 
                              style="width: 100%;">
                        <?php foreach($sintomas as $sintoma){ ?>
                          <option value="<?=$sintoma->sin_id?>"><?=$sintoma->sin_sintoma?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Motivo:</label>
                      <textarea name="motivo" style="resize: none;height: 138px;" class="form-control"></textarea>
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
        <!-- inicio modal editar -->
        <form method="POST" action="<?=base_url('filial/editar')?>">
  <div class="modal fade" id="modal-editar">
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
                        <input id="editar-nome" name="nome" type="text" class="form-control">
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
                        <input id="editar-numero" name="numero" type="text" class="form-control">
                        <input type="text" value=" " id="editar-id" name="id" hidden />
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
                        <select id="editar-cidade" name="cidade" class="form-control">
                          <?php foreach($cidades as $cidade) {?>
                          <option value="<?=$cidade->cid_id?>"><?=$cidade->cid_nome?></option>
                          <?php } ?>
                        </select>
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
        <!-- fim modal editar -->
        <!-- inicio modal remover -->
        <div class="modal fade" id="modal-remover">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Remover Usuario</h4>
              </div>
              <div class="modal-body">
                <p>Deseja realmente deletar esse usuario ?&hellip;</p>
              </div>
              <div class="modal-footer">
                <a id="btn-deletar" href="#" class="btn btn-danger pull-right">Confirmar</a>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- fim modal remover -->
        <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- datatable -->
<script src="<?=base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>
<!-- SlimScroll -->
<script src="<?=base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url("assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")?>"></script>

<!-- Select2 -->
<script src="<?=base_url("assets/bower_components/select2/dist/js/select2.full.min.js")?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
<script src="<?=base_url('ajax/ajax_generico.js')?>"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('.select2').select2();
    $('#datepicker').datepicker({
      autoclose: true,
    });
  })
</script>
<script>
  function modalEditar(id){
    $('#editar-sucesso').addClass('hidden');
    $('#editar-erro').addClass('hidden');
    consultar("<?=base_url('filial/carregarDadosEditar/')?>"+id,(retorno) => {
      var filial = JSON.parse(retorno);
      console.log(filial.cha_id);
      $('#editar-nome').val(filial.fil_nome);
      $('#editar-numero').val(filial.fil_numero);
      $('#editar-cidade').val(filial.fil_cidade);
      $('#editar-id').val(filial.cha_id);
      $('#modal-editar').modal('show');
    });
  }

  function modalRemover(id){
    $('#btn-deletar').attr('href', "<?=base_url('filial/remover/')?>"+id)
    $('#modal-remover').modal('show');
  }
</script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>