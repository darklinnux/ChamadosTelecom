<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?=base_url("assets/plugins/iCheck/all.css")?>">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Perfil
        <small>Lista de Perfis</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cadastro</a></li>
        <li class="active">Perfil</li>
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
                <button style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">Nova Perfil</button>    
              </div>
              
            </div>
            <hr>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Perfil</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($perfis as $perfil){ ?>
                <tr>
                  
                  <td><?=$perfil->per_id?></td>
                  <td><?=$perfil->per_perfil?></td>
                  <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Opções</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a onclick="modalEditar(<?=$perfil->per_id?>);" href="#">Editar</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onclick="modalRemover(<?=$perfil->per_id?>)">Remover</a></li>
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
  <form action="<?=base_url('perfil/cadastrar')?>" method="post">
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Novo Perfil</h4>
              </div>
              <div class="modal-body">
                <!-- Tabs -->
                <div>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#perfil" aria-controls="perfil" role="tab" data-toggle="tab">Perfil</a></li>
                    <li role="presentation"><a href="#permissoes" aria-controls="permissoes" role="tab" data-toggle="tab">Permissões</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="perfil">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Perfil Nome:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                              </div>
                              <input name="perfil" type="text" class="form-control">
                            </div>
                            <!-- /.input group -->
                          </div>  
                        </div>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="permissoes">
                      <label>Funcionalidades:</label>
                      <!-- Inicio colapse -->
                      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php foreach ($funcionalidades as $func) { ?>
                        <div class="panel panel-primary">
                          <div class="panel-heading" role="tab" id="heading<?=$func->fun_id?>">
                            <h4 class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$func->fun_id?>" aria-expanded="true" aria-controls="collapse<?=$func->fun_id?>">
                              <a href="#collapse<?=$func->fun_id?>">
                                <?=ucwords($func->fun_funcionalidade)?>
                              </a>
                            </h4>
                          </div>
                          <div id="collapse<?=$func->fun_id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$func->fun_id?>">
                            <div class="panel-body">
                              <div id="func<?=$func->fun_id?>" >
                                <label>
                                  Cadastro 
                                  <input name="func<?=$func->fun_id?>Cadastrar" type="checkbox" class="flat-red"><br>
                                </label>
                                <label>
                                  Editar 
                                  <input name="func<?=$func->fun_id?>Editar" type="checkbox" class="flat-red"><br>
                                </label>
                                <label>
                                  Listar 
                                  <input name="func<?=$func->fun_id?>Listar" type="checkbox" class="flat-red"><br>
                                </label>
                                <label>
                                  Remover 
                                  <input name="func<?=$func->fun_id?>Remover" type="checkbox" class="flat-red"><br>
                                </label>
                                <?php if($func->fun_id == 12 || $func->fun_id == 11 || $func->fun_id == 10){?>
                                  <label>
                                    Ver Todos 
                                    <input name="func<?=$func->fun_id?>VerTodos" type="checkbox" class="flat-red"><br>
                                  </label>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                      </div>

                      <!-- Fim Colapse -->
                    </div>
                  </div>

                </div>
                <!-- Fim Tabs -->
                
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
  <!-- Modal editar -->
  <form action="<?=base_url('perfil/editar')?>" method="post" onsubmit="validarForm();">
  <div class="modal fade" id="modal-editar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Perfil</h4>
              </div>
              <div id="editar-erro" class="alert alert-danger alert-dismissible hidden">
                <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                <span id="editar-erroText"></span>
              </div>
              <div class="modal-body">
                <!-- Tabs -->
                <div>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#perfil-editar" aria-controls="perfil-editar" role="tab" data-toggle="tab">Perfil</a></li>
                    <li role="presentation"><a href="#permissoes-editar" aria-controls="permissoes-editar" role="tab" data-toggle="tab">Permissões</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="perfil-editar">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Perfil Nome:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                              </div>
                              <input id="editar-id" name="id" type="text" hidden>
                              <input id="editar-perfil" name="perfil" type="text" class="form-control">
                            </div>
                            <!-- /.input group -->
                          </div>  
                        </div>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="permissoes-editar">
                      <label>Funcionalidades:</label>
                      <!-- Inicio colapse -->
                      <div class="panel-group" id="accordion-editar" role="tablist" aria-multiselectable="true">
                        <?php foreach ($funcionalidades as $func) { ?>
                        <div class="panel panel-primary">
                          <div class="panel-heading" role="tab" id="heading<?=$func->fun_id?>-editar">
                            <h4 class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion-editar" href="#collapse<?=$func->fun_id?>editar" aria-expanded="true" aria-controls="collapse<?=$func->fun_id?>editar">
                              <a href="#collapse<?=$func->fun_id?>editar">
                                <?=ucwords($func->fun_funcionalidade)?>
                              </a>
                            </h4>
                          </div>
                          <div id="collapse<?=$func->fun_id?>editar" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$func->fun_id?>-editar">
                            <div class="panel-body">
                              <div id="func<?=$func->fun_id?>" >
                                <label>
                                  Cadastro 
                                  <input id="func<?=$func->fun_id?>Cadastrar" name="func<?=$func->fun_id?>Cadastrar" type="checkbox" class="flat-red"><br>
                                </label>
                                <label>
                                  Editar 
                                  <input id="func<?=$func->fun_id?>Editar" name="func<?=$func->fun_id?>Editar" type="checkbox" class="flat-red"><br>
                                </label>
                                <label>
                                  Listar 
                                  <input id="func<?=$func->fun_id?>Listar" name="func<?=$func->fun_id?>Listar" type="checkbox" class="flat-red"><br>
                                </label>
                                <label>
                                  Remover 
                                  <input id="func<?=$func->fun_id?>Remover" name="func<?=$func->fun_id?>Remover" type="checkbox" class="flat-red"><br>
                                </label>
                                <?php if($func->fun_id == 12 || $func->fun_id == 11 || $func->fun_id == 10){?>
                                  <label>
                                    Ver Todos 
                                    <input id="func<?=$func->fun_id?>Remover" name="func<?=$func->fun_id?>VerTodos" type="checkbox" class="flat-red"><br>
                                  </label>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                      </div>

                      <!-- Fim Colapse -->
                    </div>
                  </div>

                </div>
                <!-- Fim Tabs -->
              </div>
              <div class="modal-footer text-center">
                <button id="btn-form-editar" type="submit" class="btn btn-primary ">Salvar</button>
                <button type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
  </form>
  <!-- FIm madal editar -->

  <!-- Modal Remover -->
  <div class="modal fade" id="modal-remover">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Remover Perfil</h4>
              </div>
              <div class="modal-body">
                <p>Deseja realmente deletar esse Perfil ?&hellip;</p>
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
        <!-- /fim modal remover -->

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
<!-- Icheck -->
<script src="<?=base_url("assets/plugins/iCheck/icheck.min.js")?>"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
<script src="<?=base_url('ajax/ajax_generico.js')?>"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass   : 'iradio_flat-green'
    });
  })
</script>
<script>
  function modalEditar(id){
    $('#editar-sucesso').addClass('hidden');
    $('#editar-erro').addClass('hidden');
    consultar("<?=base_url('perfil/carregarDadosEditar/')?>"+id,(retorno) => {
      var dados = JSON.parse(retorno);
      perfil = dados.perfil;
      permissoes = dados.permissao;
      permissoes.forEach((perm) => {
        //alert("func"+perm.perm_funcionalidade+"Remover").iCheck('uncheck'); ;
        $("#func"+perm.perm_funcionalidade+"Cadastrar").iCheck((perm.perm_cadastrar == 1) ? 'check' : 'uncheck');
        $("#func"+perm.perm_funcionalidade+"Editar").iCheck((perm.perm_editar == 1) ? 'check' : 'uncheck');
        $("#func"+perm.perm_funcionalidade+"Listar").iCheck((perm.perm_listar == 1) ? 'check' : 'uncheck');
        $("#func"+perm.perm_funcionalidade+"Remover").iCheck((perm.perm_remover == 1) ? 'check' : 'uncheck');
      });
      $('#editar-perfil').val(perfil.per_perfil);
      $('#editar-id').val(perfil.per_id);
      $('#modal-editar').modal('show');
    });
  }

  function modalRemover(id){
    $('#btn-deletar').attr('href', "<?=base_url('perfil/remover/')?>"+id)
    $('#modal-remover').modal('show');
  }
</script>
<script>
  $(function () {
    $('#example1').DataTable({
      "language": {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
            "sNext": "Próximo",
            "sPrevious": "Anterior",
            "sFirst": "Primeiro",
            "sLast": "Último"
        },
        "oAria": {
            "sSortAscending": ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      }
    });
  })
</script>
</body>
</html>
