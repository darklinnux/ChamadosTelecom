<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?=base_url("assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")?>">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Andamento
        <small>Chamado Inteno</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Chamado Interno</a></li>
        <li><a href="<?=base_url('ChamadoInterno/aberto')?>">Aberto/andamento</a></li>
        <li class="active">andamento</li>
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
          <div id="erro" class="alert alert-danger alert-dismissible hidden">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                <span id="erroMessage"></span>
          </div>
          <div id="sucesso" class="alert alert-success alert-dismissible hidden">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                <span id="sucessoMessage"></span>
          </div>
      <!-- Default box -->
      <div class="box">
            <div class="box-header">

              <div>
                <h3 class="box-title">Assunto: <?=$chamado->cha_assunto?></h3>
              </div>

            </div>
            <hr>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                        <label>Nivel:</label>
                        <input id="idChamado" type="text" value="<?=$chamado->cha_id?>" hidden  />
                        <select name="nivel" class="form-control nivel">
                          <?php foreach ($niveis as $nivel) {?>
                            <option <?=($nivel->cni_id == $chamado->cha_nivel) ? 'selected' : null?> value="<?=$nivel->cni_id?>"><?=$nivel->cni_nivel?></option>
                          <?php }?>
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
                        <input value="<?=date("d/m/Y",strtotime($chamado->cha_previsao))?>" name="previsao" type="text" class="form-control pull-right previsao" id="datepicker">
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Status:</label>
                      <select name="status" class="form-control status">
                        <?php foreach ($status as $statu) {?>
                          <option <?=($statu->stc_id == $chamado->cha_status) ? 'selected' : null?> value="<?=$statu->stc_id?>"><?=$statu->stc_status?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Categoria:</label>
                      <select disabled name="categoria" class="form-control select2" style="width: 100%;">
                        <?php foreach ($categorias as $categoria) {?>
                          <option value="<?=$categoria->cat_id?>"><?=$categoria->cat_nome?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Setor:</label>
                      <select disabled name="setor" class="form-control select2" style="width: 100%;">
                        <?php foreach ($setores as $setor) {?>
                          <option value="<?=$setor->set_id?>"><?=$setor->set_nome?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Filial</label>
                      <select disabled name="filial" class="form-control select2" style="width: 100%;">
                        <?php foreach ($filiais as $filial) {?>
                          <option value="<?=$filial->fil_id?>"><?=$filial->fil_numero.'-'.$filial->fil_nome?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Autor:</label>
                      <input disabled value="<?=$chamado->usu_login?>" type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Responsavel:</label>
                      <select name="responsavel" class="form-control select2 responsavel" style="width: 100%;">
                          <option value="0">Selecione um Responsavel</option>
                        <?php foreach ($usuarios as $usuario) {?>
                          <option <?=($usuario->usu_id == $chamado->cha_responsavel) ? 'selected' : null?> value="<?=$usuario->usu_id?>"><?=$usuario->usu_nome?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Descrição:</label>
                      <textarea disabled placeholder="Descreva sua solicitação" name="descricao" style="resize: none;height: 138px;" class="form-control"><?=$chamado->cha_descricao?></textarea>
                    </div>
                  </div>
                </div>

                <hr>
                <div>
                    <h3 class="text-center">Comentários</h3>
                    <br>

                <?php foreach($comentarios as $comentario) {?>
                    <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?=base_url('assets/dist/img/avatar.png')?>" alt="User Image">
                        <a href="#" title="Remover comentário" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        <span id="com-<?=$comentario->com_id?>" class="username">
                          <?=$comentario->usu_nome?>.
                        </span>
                        <span class="description">Enviado em: <?=date('d/m/Y',strtotime($comentario->com_data))?> ás <?=date('H:i',strtotime($comentario->com_data))?>.</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                      <?=$comentario->com_comentario?>
                      </p>
                    </div>
                    <?php } ?>
                </div>
                <hr> 
                               
              <div class="post clearfix">
                <div class="user-block">
                  <form method="POST" action="<?=base_url("ChamadoInterno/comentar")?>" class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-12" style="margin-bottom: 10px;">
                        <input name="idChamado" value="<?=$chamado->cha_id?>" hidden>
                        <textarea required name="comentario" class="form-control" rows="3" placeholder="Escreva um comentário ..."></textarea>
                      </div>
                      <div class="pull-right col-xs-12 col-lg-2">
                        <button type="submit" class="btn btn-primary btn-block btn-sm">Enviar</button>
                      </div>
                    </div>
                  </form>
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
    }).on("picker_event", function(e){
      alert('teste');
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

  function atualizar(dados,mensagem){
    $("#sucesso").addClass("hidden");
    $("#erro").addClass("hidden");
    enviarDados("<?=base_url("ChamadoInterno/atualizarAndamento")?>",dados,(retorno)=>{
      var retorno = JSON.parse(retorno);
      if(retorno){
        $("#sucesso").removeClass("hidden");
        $("#sucessoMessage").html(mensagem);
      }else {
        $("#erro").removeClass("hidden");
        $("#erroMessage").html("Não foi possivel atualizar o chamado");
      }
    });
  }

  $( ".nivel" ).change(function() {
    mensagem = "Nível atualizado com sucesso";
    dados = {
      id : $("#idChamado").val(),
      nivel : $(".nivel").val(),
      campo: "nivel"
    }
    atualizar(dados,mensagem);
  });

  $( ".status" ).change(function() {
    mensagem = "Status atualizado com sucesso";
    dados = {
      id : $("#idChamado").val(),
      status : $(".status").val(),
      campo: "status"
    }
    atualizar(dados,mensagem);
  });

  $(".previsao").change(function() {
    mensagem = "Previsão atualizada com sucesso";
    dados = {
      id : $("#idChamado").val(),
      previsao : $(".previsao").val(),
      campo: "previsao"
    }
    atualizar(dados,mensagem);
  });

  $(".responsavel").change(function() {
    mensagem = "Responsavel atualizado com sucesso";
    dados = {
      id : $("#idChamado").val(),
      responsavel : $(".responsavel").val(),
      campo: "responsavel"
    }
    atualizar(dados,mensagem);
  });
</script>
<script>
  $(function () {
    
  });
</script>
</body>
</html>