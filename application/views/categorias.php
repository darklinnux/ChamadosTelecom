<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categoria
        <small>Lista de Categorias</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cadastro</a></li>
        <li class="active">categoria</li>
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
                <button style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">Nova Categoria</button>    
              </div>
              
            </div>
            <hr>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Categoria</th>
                  <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($categorias as $categoria) { ?>
                <tr>
                  <td><?=$categoria->cat_id?></td>
                  <td><?=$categoria->cat_nome?></td>
                  <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Opções</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a onclick="modalEditar(<?=$categoria->cat_id?>);" href="#">Editar</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onclick="modalRemover(<?=$categoria->cat_id?>)">Remover</a></li>
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
  <form action="<?=base_url('categoria/cadastrar')?>" method="POST">
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nova Categoria</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nome Categoria:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input name="nome" type="text" class="form-control">
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
        </form>
        <!-- /.modal -->

        <!-- Modal editar -->
  <form action="<?=base_url('categoria/editar')?>" method="post" onsubmit="validarForm();">
  <div class="modal fade" id="modal-editar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Categoria</h4>
              </div>
              <div id="editar-erro" class="alert alert-danger alert-dismissible hidden">
                <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                <span id="editar-erroText"></span>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nome Categoria:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input id="editar-nome" name="nome" type="text" class="form-control">
                        <input type="text" value=" " id="editar-id" name="id" hidden />
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                </div>
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
                <h4 class="modal-title">Remover Categoria</h4>
              </div>
              <div class="modal-body">
                <p>Deseja realmente deletar esse Categoria ?&hellip;</p>
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
        <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.min.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
<script src="<?=base_url('ajax/ajax_generico.js')?>"></script>
<script>
 $(document).ready(function () {
   $('.sidebar-menu').tree()
 })
</script>
<script>
  function modalEditar(id){
    $('#editar-sucesso').addClass('hidden');
    $('#editar-erro').addClass('hidden');
    consultar("<?=base_url('categoria/carregarDadosEditar/')?>"+id,(retorno) => {
      var categoria = JSON.parse(retorno);
      console.log(categoria.cat_id);
      $('#editar-nome').val(categoria.cat_nome);
      $('#editar-id').val(categoria.cat_id);
      $('#modal-editar').modal('show');
    });
  }

  function modalRemover(id){
    $('#btn-deletar').attr('href', "<?=base_url('categoria/remover/')?>"+id)
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
