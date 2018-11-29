<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$cadastrar = $this->controleacesso->verficaPermisaoCadastrar(1,true);
$editar = $this->controleacesso->verficaPermisaoEditar(1,true);
$remover = $this->controleacesso->verficaPermisaoRemover(1,true);
$listar = $this->controleacesso->verficaPermisaoListar(1,true);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Usuarios
      <small>Lista de Usuarios</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Cadastro</a></li>
      <li class="active">Usuarios</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
  <div id="sucesso" class="alert alert-success alert-dismissible hidden">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                Usuario cadastrado com sucesso !!!!
    </div>
    <?php if ($this->session->delete) {?>
    <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                <?=$this->session->delete?>
    </div>
    <?php } ?>
    <!-- Default box -->
    <div class="box">
      <div class="box-header">
        
        <div>
          <h3 class="box-title">Cadastros</h3>
          <?php if($cadastrar) { ?>
          <button style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">Novo Usuario</button>    
          <?php } ?>
        </div>
        
      </div>
      <hr>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="26%">Nome</th>
              <th>Perfil</th>
              <th>Usuario</th>
              <th>Status</th>
              <th id="tituloAcao">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($usuarios as $usuario){ ?>
            <tr>
              <td><?=$usuario->usu_nome?></td>
              <td><?=$usuario->per_perfil?></td>
              <td><?=$usuario->usu_login?></td>
              <td><?=$usuario->stu_status?></td>
              <td class="linhaAcao">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Opções</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                    <ul id="acaodrop" class="dropdown-menu" role="menu">
                        <?php if($editar) { ?>
                        <li><a onclick="modalEditar(<?=$usuario->usu_id?>);" href="#">Editar</a></li>
                        <?php } ?>
                        <?php if($remover) { ?>
                        <li class="divider"></li>
                        <li><a href="#" onclick="modalRemover(<?=$usuario->usu_id?>)">Remover</a></li>
                        <?php } ?>
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
          <button onclick="closeModal();" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cadastro Usuario</h4>
          </div>
          <div id="erro" class="alert alert-danger alert-dismissible hidden">
            <h4><i class="icon fa fa-ban"></i> Erro!</h4>
            <span id="erroText"></span>
          </div> 
          <div class="modal-body">
            <div id="erro"></div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nome:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input id="nome" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>  
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Usuario:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <span>@</span>
                    </div>
                    <input id="usuario" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Senha:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input id="senha" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>  
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Confirmar Senha:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input id="conf_senha" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="">Status</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-get-pocket"></i>
                    </div>
                    <select id="status" class="form-control">
                      <?php foreach($status as $statu) { ?>
                      <option value="<?=$statu->stu_id?>"><?=$statu->stu_status?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="">Perfil</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-get-pocket"></i>
                    </div>
                    <select id="perfil" class="form-control">
                      <?php foreach($perfis as $perfil){?>
                        <option value="<?=$perfil->per_id?>"><?=$perfil->per_perfil?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer text-center">
            <button id="btnCadastrar" onclick="cadastrar();" type="button" class="btn btn-primary ">Salvar</button>
            <button onclick="closeModal();" type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Modal editar inicio -->
    <div class="modal fade" id="modal-editar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-blue">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cadastro Usuario</h4>
          </div>
          <div id="editar-erro" class="alert alert-danger alert-dismissible hidden">
            <h4><i class="icon fa fa-ban"></i> Erro!</h4>
            <span id="editar-erroText"></span>
          </div> 
          <div id="editar-sucesso" class="alert alert-success alert-dismissible hidden">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                Usuario atualizado com sucesso !!!!
          </div>
          <div class="modal-body">
            <div id="erro"></div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nome:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input id="editar-nome" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>  
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Usuario:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <span>@</span>
                    </div>
                    <input id="editar-usuario" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Senha:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input id="editar-senha" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>  
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Confirmar Senha:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input id="editar-conf_senha" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="">Status</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-get-pocket"></i>
                    </div>
                    <select id="editar-status" class="form-control">
                      <?php foreach($status as $statu) { ?>
                      <option value="<?=$statu->stu_id?>"><?=$statu->stu_status?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="">Perfil</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-get-pocket"></i>
                    </div>
                    <select id="editar-perfil" class="form-control">
                      <?php foreach($perfis as $perfil){?>
                        <option value="<?=$perfil->per_id?>"><?=$perfil->per_perfil?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer text-center">
            <button id="editar-btnCadastrar" onclick="editar(this.id);" type="button" class="btn btn-primary ">Salvar</button>
            <button onclick="window.location.reload();" type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!--/ modal editar fim -->
    <!-- Modal Remover -->
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
 <!-- FastClick -->
 <script src="<?=base_url('assets/bower_components/fastclick/lib/fastclick.js')?>"></script>
 <!-- AdminLTE App -->
 <script src="<?=base_url('assets/dist/js/adminlte.js')?>"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
 <script src="<?=base_url('ajax/ajax_generico.js')?>"></script>
 <script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
  });
  quantidade = $("#acaodrop li").length;
  console.log(quantidade);
  if(quantidade == 0){
    $('#tituloAcao').addClass('hidden');
    $('.linhaAcao').addClass('hidden');
  }
</script>
<script>
  function cadastrar(){
    $('#btnCadastrar').prop("disabled",true);
    var dados = {
    login: $('#usuario').val(),
    nome:$('#nome').val(),
    status:$('#status').val(),
    perfil:$('#perfil').val(),
    senha:$('#senha').val(),
    conf_senha: $('#conf_senha').val()
    };
    enviarDados("<?=base_url('usuario/cadastrar')?>", dados, (retorno)=>{
      var obj = JSON.parse(retorno);
      if(obj.sucess){
        limparFomeCadastro();
        $('#btnCadastrar').prop("disabled",false);
        $('#modal-default').modal('hide');
        $('#sucesso').removeClass('hidden');
        setTimeout(function(){ window.location.reload() },2000);
        
      }else {
        $('#btnCadastrar').prop("disabled",false);
        $('#erro').removeClass('hidden');
        $('#erroText').html(obj.error);
      }
    });
  }

  function editar(){
    $('#btnCadastrar').prop("disabled",true);
    var dados = {
    id:$('#editar-btnCadastrar').attr('usuario'),
    login: $('#editar-usuario').val(),
    nome:$('#editar-nome').val(),
    status:$('#editar-status').val(),
    perfil:$('#editar-perfil').val(),
    senha:$('#editar-senha').val(),
    conf_senha: $('#editar-conf_senha').val()
    };
    enviarDados("<?=base_url('usuario/editar/')?>"+dados.id, dados, (retorno)=>{
      var obj = JSON.parse(retorno);
      if(obj.sucess){
        limparFomeCadastro();
        $('#editar-btnCadastrar').prop("disabled",false);
        $('#editar-sucesso').removeClass('hidden');
        $('#editar-erro').addClass('hidden');
      }else {
        $('#editar-btnCadastrar').prop("disabled",false);
        $('#editar-sucesso').addClass('hidden');
        $('#editar-erro').removeClass('hidden');
        $('#editar-erroText').html(obj.error);
      }
    });
  }
  <?php if($remover) { ?>
  function modalRemover(id){
    $('#btn-deletar').attr('href', "<?=base_url('usuario/remover/')?>"+id)
    $('#modal-remover').modal('show');
  }
  <?php } ?>
  <?php if($editar) { ?>
  function modalEditar(id){
    $('#editar-sucesso').addClass('hidden');
    $('#editar-erro').addClass('hidden');
    consultar("<?=base_url('usuario/carregarDadosEditar/')?>"+id,(retorno) => {
      var usuario = JSON.parse(retorno);
      console.log(usuario.usu_nome);
      $('#editar-usuario').val(usuario.usu_login);
      $('#editar-nome').val(usuario.usu_nome);
      $('#editar-status').val(usuario.usu_status);
      $('#editar-perfil').val(usuario.usu_perfil);
      $('#editar-senha').val('');
      $('#editar-conf_senha').val('');
      $('#editar-btnCadastrar').attr('usuario',id);
      $('#modal-editar').modal('show');
    });
  }
  <?php } ?>

  function limparFomeCadastro(){
    $('#usuario').val('');
    $('#nome').val('');
    $('#status').val(1);
    $('#perfil').val(1);
    $('#senha').val('');
    $('#conf_senha').val('');
  }

  function closeModal(){
    limparFomeCadastro();
    $('#erro').addClass('hidden');

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
