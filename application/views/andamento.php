<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?= base_url("assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")?>">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Andamento
        <small>Chamado Inteno</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Chamado Interno</a></li>
        <li><a href="<?=base_url('ChamadoInterno/aberto')?>">Aberto/andamento</a></li>
        <li class="active">andamento</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              
              <div>
                <h3 class="box-title">Assunto do chamado carregado do banco</h3>    
              </div>
              
            </div>
            <hr>
            <!-- /.box-header -->
            <div class="box-body">
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
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Status:</label>
                      <select name="filial" class="form-control select2" style="width: 100%;">
                        <?php foreach($filiais as $filial) { ?>
                          <option value="<?=$filial->fil_id?>"><?=$filial->fil_nome?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Categoria:</label>
                      <select name="categoria" class="form-control select2" style="width: 100%;">
                        <?php foreach($categorias as $categoria) { ?>
                          <option value="<?=$categoria->cat_id?>"><?=$categoria->cat_nome?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Setor:</label>
                      <select name="setor" class="form-control select2" style="width: 100%;">
                        <?php foreach($setores as $setor) { ?>
                          <option value="<?=$setor->set_id?>"><?=$setor->set_nome?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Filial</label>
                      <select name="filial" class="form-control select2" style="width: 100%;">
                        <?php foreach($filiais as $filial) { ?>
                          <option value="<?=$filial->fil_id?>"><?=$filial->fil_nome?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Autor:</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Responsável:</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Descrição:</label>
                      <textarea placeholder="Descreva sua solicitação" name="descricao" style="resize: none;height: 138px;" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
                <hr>
                <div>
                    <h3 class="">Comentários:</h3>    
                </div>
            </div>
            <!-- /.box-body -->
          </div>

    </section>
    <!-- /.content -->
  </div>
  
        
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
<!-- bootstrap datepicker -->
<script src="<?=base_url("assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js")?>"></script>

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
</script>
<script>
  function formatarData(data){
    data = data.split("-");
    ano = data[0];
    mes = data[1];
    dia = data[2];
    return dia+"/"+mes+"/"+ano;
  }
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

  function modalRemover(id){  
    $('#btn-deletar').attr('href', "<?=base_url('chamado/remover/')?>"+id)
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
    
  });
</script>
</body>
</html>