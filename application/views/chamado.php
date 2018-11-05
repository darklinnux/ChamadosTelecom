<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?= base_url("assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")?>">

<link rel="stylesheet" href="<?=base_url("assets/plugins/datable/css/responsive.dataTables.min.css")?>" />
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Chamado
        <small>Lista de Chamado</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
                <h3 class="box-title"><?=$titulo?></h3>
                <?php if($this->controleacesso->verficaPermisaoCadastrar(10,true)){ ?>
                <button style="float:right;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default">Novo Chamado</button>    
                <?php } ?>
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
                  <th id="tituloAcao">Ações</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach($chamados as $chamado) {?>
                  <tr>
                    <td><a onclick="modalEditar(<?=$chamado->cha_id?>);" href="#"><?=$chamado->fil_numero?>-<?=$chamado->fil_nome?></a></td>
                    <td><?=$chamado->emp_nome?></td>
                    <td><?=$chamado->cha_protocolo?></td>
                    <td><?=$chamado->cha_previsao?></td>
                    <td><?=$chamado->usu_login?></td>
                    <td><?=$chamado->stc_status?></td>
                    <td class="linhaAcao">
                      <div class="btn-group">
                          <button type="button" class="btn btn-primary">Opções</button>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                          <ul id="acaodrop" class="dropdown-menu" role="menu">
                          <?php if($this->controleacesso->verficaPermisaoEditar(10,true)){ ?>
                              <li><a onclick="modalEditar(<?=$chamado->cha_id?>);" href="#">Editar</a></li><?php } ?>
                              <?php if($this->controleacesso->verficaPermisaoRemover(10,true)){ ?>
                              <li class="divider"></li>
                              <li><a href="#" onclick="modalRemover(<?=$chamado->cha_id?>)">Remover</a></li><?php } ?>
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
  <form method="POST" action="<?=base_url('chamado/cadastrar')?>" autocomplete="off">
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
                  <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nivel:</label>
                        <select name="nivel" class="form-control">
                          <?php foreach($niveis as $nivel) { ?>
                            <option value="<?=$nivel->cni_id?>"><?=$nivel->cni_nivel?></option>
                          <?php } ?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Protocolo:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input required placeholder="Protocolo Atendimento" id="protocolo" name="protocolo" type="text" class="form-control">
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Designação:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input name="designacao" type="text" class="form-control designacao" placeholder="AAR/IP/00102">
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
                  <div class="col-sm-4">
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
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Empresa</label>
                      <select required name="empresa" class="form-control select2" style="width: 100%;">
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
                      <select required id="filiais" name="filial[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione as filiais"
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
                      <select required id="sintomas" name="sintoma[]" class="form-control select2" multiple="multiple" data-placeholder="Nome do atendente" 
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
        <form method="POST" action="<?=base_url('chamado/editar')?>" autocomplete="off">
  <div class="modal fade" id="modal-editar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Chamado</h4>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nivel:</label>
                        <select id="editar-nivel" name="nivel" class="form-control">
                          <?php foreach($niveis as $nivel) { ?>
                            <option value="<?=$nivel->cni_id?>"><?=$nivel->cni_nivel?></option>
                          <?php } ?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Protocolo:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input required id="editar-protocolo" placeholder="Protocolo Atendimento" id="protocolo" name="protocolo" type="text" class="form-control">
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Designação:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-user"></i>
                        </div>
                        <input id="editar-designacao" name="designacao" type="text" class="form-control designacao" placeholder="AAR/IP/00102">
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
                        <input id="editar-previsao" name="previsao" type="text" class="form-control pull-right" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Atendente:</label>

                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-key"></i>
                        </div>
                        <input id="editar-atendente" placeholder="Nome do atendente" id="atendente" name="atendente" type="text" class="form-control">
                        <input name="id" id="editar-id" type="text" value="" hidden>
                      </div>
                      <!-- /.input group -->
                    </div>  
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Empresa</label>
                      <select required id="editar-empresa" name="empresa" class="form-control select2" style="width: 100%;">
                        <?php foreach($empresas as $empresa) { ?>
                          <option value="<?=$empresa->emp_id?>"><?=$empresa->emp_nome?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Status</label>
                      <select required id="editar-status" name="status" class="form-control">
                        <?php foreach($status as $statu) { ?>
                          <option value="<?=$statu->stc_id?>"><?=$statu->stc_status?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Filiais</label>
                      <select required id="editar-filiais" name="filial[]" class="form-control select2" multiple="multiple" data-placeholder="Selecione as filiais"
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
                      <select required id="editar-sintomas" name="sintoma[]" class="form-control select2" multiple="multiple" data-placeholder="Nome do atendente" 
                              style="width: 100%;">
                        <?php foreach($sintomas as $sintoma){ ?>
                          <option value="<?=$sintoma->sin_id?>"><?=$sintoma->sin_sintoma?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Motivo:</label>
                      <textarea id="editar-motivo" name="motivo" style="resize: none;height: 138px;" class="form-control"></textarea>
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
                <h4 class="modal-title">Remover Chamado</h4>
              </div>
              <div class="modal-body">
                <p>Deseja realmente deletar esse Chamado ?&hellip;</p>
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
<!-- Mask -->
<script src="<?=base_url('assets/dist/js/jquery.mask.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/datable/js/dataTables.responsive.min.js')?>"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url("assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js")?>"></script>

<!-- Select2 -->
<script src="<?=base_url("assets/bower_components/select2/dist/js/select2.full.min.js")?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets/dist/js/demo.js')?>"></script>
<script src="<?=base_url('ajax/ajax_generico.js')?>"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('.select2').select2();
    $('#editar-previsao').mask('00/00/0000',{placeholder: "__/__/____"});
    $('.designacao').mask('AAA/AA/00000');
    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',        
    });
    $('#datepicker-editar').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',        
    });
  })

  quantidade = $("#acaodrop li").length;
  console.log(quantidade);
  if(quantidade == 0){
    $('#tituloAcao').addClass('hidden');
    $('.linhaAcao').addClass('hidden');
  }
</script>
<script>
  function formatarData(data){
    data = data.split("-");
    ano = data[0];
    mes = data[1];
    dia = data[2];
    return dia+"/"+mes+"/"+ano;
  }
  <?php if($this->controleacesso->verficaPermisaoEditar(10,true)){ ?>
  function modalEditar(id){
    $('#editar-sucesso').addClass('hidden');
    $('#editar-erro').addClass('hidden');
    consultar("<?=base_url('chamado/carregarDadosEditar/')?>"+id,(retorno) => {
      var chamado = JSON.parse(retorno);
      console.log(chamado.cha_id);
      $('#editar-protocolo').val(chamado.cha_protocolo);
      $('#editar-nivel').val(chamado.cha_nivel);
      $('#editar-previsao').val(formatarData(chamado.cha_previsao));
      $('#editar-designacao').val(chamado.cha_designacao);
      $('#editar-atendente').val(chamado.cha_atendente);
      $('#editar-empresa').val(chamado.cha_empresa);
      $('#editar-motivo').val(chamado.cha_motivo);
      $('#editar-status').val(chamado.cha_status);
      $('#editar-id').val(chamado.cha_id);
      carregarFiliaisEditar(chamado.cha_id);
      carregarSintomaEditar(chamado.cha_id);
      $('#modal-editar').modal('show');
    });
  }

  function carregarFiliaisEditar(id){
    consultar("<?=base_url('chamado/carregarDadosFilialEditar/')?>"+id,(retorno) => {
      var filiais = JSON.parse(retorno);
      var listaFiliais=[];
      filiais.forEach(filial => {
        listaFiliais.push(filial.chf_filial);
      });
      console.log(listaFiliais);
      $('#editar-filiais').val(listaFiliais);
      $('#editar-filiais').trigger('change');
    });
  }

  function carregarSintomaEditar(id){
    consultar("<?=base_url('chamado/carregarDadosSintomaEditar/')?>"+id,(retorno) => {
      var sintomas = JSON.parse(retorno);
      var listaSintomas=[];
      sintomas.forEach(sintoma => {
        listaSintomas.push(sintoma.chs_sintoma);
      });
      console.log(listaSintomas);
      $('#editar-sintomas').val(listaSintomas);
      $('#editar-sintomas').trigger('change');
    });
  }
<?php } ?>
<?php if($this->controleacesso->verficaPermisaoRemover(10,true)){ ?>
  function modalRemover(id){  
    $('#btn-deletar').attr('href', "<?=base_url('chamado/remover/')?>"+id)
    $('#modal-remover').modal('show');

  }
<?php } ?>
</script>
<script>
  $(function () {
    $('#example1').DataTable({
      responsive: true,
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
    
  });
</script>
</body>
</html>