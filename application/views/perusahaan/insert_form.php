<script type="text/javascript">
    (function($, undefined) {

    "use strict";

    // When ready.
    $(function() {
        
        var $form = $( "#form_add" );
        var $input = $form.find( ".input-number" );

        $input.on( "keyup", function( event ) {
            
            
            // When user select text in the document, also abort.
            var selection = window.getSelection().toString();
            if ( selection !== '' ) {
                return;
            }
            
            // When the arrow keys are pressed, abort.
            if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                return;
            }
            
            
            var $this = $( this );
            
            // Get the value.
            var input = $this.val();
            
            var input = input.replace(/[\D\s\._\-]+/g, "");
                    input = input ? parseInt( input, 10 ) : 0;

                    $this.val( function() {
                        return ( input === 0 ) ? "" : input.toLocaleString( "ID" );
                    } );
        } );        
    });
})(jQuery);
</script>
<script>
// Event Section
$(document).ready(function(){
    // Selectpicker
	$(".selectpicker").selectpicker();

    // Datepicker
    $('.input-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        minView: 2
    });
});
// Event Section
$(document).on("submit", "#form_add", function(event){
    event.preventDefault();
    form = $(this);
    $btn = form.find("button[type='submit']");
    request = $.ajaxq("queue", {
        "url" : form.attr("action"),
        "type" : "POST",
        "data" : form.serialize(),
        "dataType" : "json",
        "beforeSend" : function(){
            $btn.button("loading");
        }
    });
    request.done(function(json){
        if(json.status){
            form.find("input[name=last_username]").val(form.find("input[name=username]").val());
        }else{
            bootbox.alert(json.message, function(){
            });
        }
        $.gritter.add({title: "Message", text: json.message});
        $btn.button("reset");
    });
    request.fail(function(jqXHR, textStatus){
        $.gritter.add({title: "Request failed", text: textStatus});
        $btn.button("reset");
    });
    return false;
});
// Event Section
$(document).on("submit", "#form_password", function(event){
    event.preventDefault();
    form = $(this);
    $btn = form.find("button[type='submit']");
    request = $.ajaxq("queue", {
        "url" : form.attr("action"),
        "type" : "POST",
        "data" : form.serialize(),
        "dataType" : "json",
        "beforeSend" : function(){
            $btn.button("loading");
        }
    });
    request.done(function(json){
        $.gritter.add({title: "Message", text: json.message});
        $btn.button("reset");
    });
    request.fail(function(jqXHR, textStatus){
        $.gritter.add({title: "Request failed", text: textStatus});
        $btn.button("reset");
    });
    return false;
});
</script>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li> <?php echo $title[0]; ?> </li>
        <li> <?php echo $title[1]; ?> </li>
    </ol>
    <h1 class="page-header">
        Tambah <?php echo $title[0]; ?>
        <!-- <small><?php echo $title[1]; ?></small> -->
    </h1>
    <!-- <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills">
                <li class="active"><a href="<?php echo base_url("perusahaan/change_form?id={$id}"); ?>">Home</a></li>
                <li class=""><a href="<?php echo base_url("jamrek_eks/change_form?id={$id}"); ?>">Jamrek Tahap Eksplorasi</a></li>
                <li class=""><a href="<?php echo base_url("jamrek_pro/change_form?id={$id}"); ?>">Jamrek Tahap Produksi</a></li>
                <li class=""><a href="<?php echo base_url("jamtup/change_form?id={$id}"); ?>">Jaminan Penutupan</a></li>
                <li class=""><a href="<?php echo base_url("jamkes/change_form?id={$id}"); ?>">Jaminan Kesungguhan Eksplorasi</a></li>
                <li class=""><a href="<?php echo base_url("iuran/change_form?id={$id}"); ?>">Iuran Tetap</a></li>
                <li class=""><a href="<?php echo base_url("royalti/change_form?id={$id}"); ?>">Royalti</a></li>
            </ul>
        </div>
    </div> -->
    <form id="form_add" role="form" action="<?php echo base_url("perusahaan/insert"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Data Perusahaan</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "nama_perusahaan",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Nama Perusahaan",
                                "required"    => "required"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "telp_perusahaan",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "No. Telp Perusahaan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Status Perusahaan</label>
                            <select class="form-control selectpicker m-b-0" name="status">
                              <option value="">Status Perusahaan</option>
                              <option value="terbuka">Terbuka</option>
                              <option value="tidak terbuka">Tidak Terbuka</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "email_kantor",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "E-mail Perusahaan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "alamat_kantor",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "Alamat Kantor",
                              "required"    => "required",
                              "style"       => "resize:none;height:105px"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_textarea($data);
                          ?>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <hr class="m-b-10 m-t-0" />
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "nama_dirut",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "Nama Direktur"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "telp_dirut",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "No. Telp Direktur"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "email_dirut",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "E-mail Direktur"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <hr class="m-b-10 m-t-0" />
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "nama_saham",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "Nama Pemegang Saham"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "telp_saham",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "No. Telp Pemegang Saham"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "email_saham",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "E-mail Pemegang Saham"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <hr class="m-b-10 m-t-0" />
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "nama_ktt",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "Nama KTT"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "hp_ktt",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "No. HP KTT"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                    </div>
                    <div class="col-md-4" style="border-right:1px solid #eee">
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "email_ktt",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "E-mail KTT"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                      <div class="form-group">
                          <?php
                            $data = array(
                              "name"        => "sk_ktt",
                              "class"       => "form-control input-md input-small",
                              "placeholder" => "No. SK KTT"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                          ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <?php
                          $data = array(
                            "name" => "ktt_terbit",
                            "class" => "form-control input-datepicker",
                            "placeholder" => "Tanggal Penerbitan SK",
                            "maxlength" => 10
                          );
                        ?>
                        <label class="control-label">
                          Tanggal Penerbitan
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <?php echo form_input($data); ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <?php
                          $data = array(
                            "name" => "ktt_berakhir",
                            "class" => "form-control input-datepicker",
                            "placeholder" => "Tanggal Berakhir SK",
                            "maxlength" => 10
                          );
                        ?>
                        <label class="control-label">
                          Tanggal Berakhir
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <?php echo form_input($data); ?>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Lokasi Kerja</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "kelurahan",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Desa/Kelurahan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "kabupaten",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Kabupaten"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "kecamatan",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Kecamatan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "propinsi",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Propinsi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">CNC</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Status CNC</label>
                            <select class="form-control selectpicker m-b-0" name="status_cnc">
                              <option value="">Status CNC</option>
                              <option value="cnc">CNC</option>
                              <option value="non cnc">Non CNC</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "tahap_cnc",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Tahap CNC"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Tumpang Tindih Wilayah</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                      <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "komoditas_sama",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Sama Komoditas"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                      <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "wadm",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Wilayah Administrasi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                      <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "wpa",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Wilayah Pencadangan Negara"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Kordinat Blok IUP</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                      <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "kfg",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Kordinat Format Geografis"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                      <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "kfi1",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Kordinat Format IUP Eksplorasi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                      <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "kfi2",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Kordinat Format IUP Produksi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">SK Izin Peninjauan</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_tinjau",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Izin Peninjauan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "luas_tinjau",
                              "class" => "form-control input-number",
                              "placeholder" => "Luas (Hektare)"
                            );
                          ?>
                          <label class="control-label">
                            Luas (Hektare)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                            <span class="input-group-addon">
                              <span>Ha</span>
                            </span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-r-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "thn_tinjau1",
                              "class" => "form-control input-datepicker",
                              // "placeholder" => "Tanggal Penerbitan SK",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Tanggal Penerbitan
                          </label>
                          <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <?php echo form_input($data); ?>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-l-5">
                      <div class="form-group">
                        <?php
                          $data = array(
                            "name" => "thn_tinjau2",
                            "class" => "form-control input-datepicker",
                            // "placeholder" => "Tanggal Berakhir SK",
                            "maxlength" => 10
                          );
                        ?>
                        <label class="control-label">
                          Tanggal Berakhir
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <?php echo form_input($data); ?>
                        </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">KP Penyelidikan Umum</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_pu",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "KP Penyelidikan Umum"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "luas_pu",
                              "class" => "form-control input-number",
                              "placeholder" => "Luas (Hektare)"
                            );
                          ?>
                          <label class="control-label">
                            Luas (Hektare)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                            <span class="input-group-addon">
                              <span>Ha</span>
                            </span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-r-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "thn_pu1",
                              "class" => "form-control input-datepicker",
                              // "placeholder" => "Tanggal Penerbitan SK",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Tanggal Penerbitan
                          </label>
                          <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <?php echo form_input($data); ?>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-l-5">
                      <div class="form-group">
                        <?php
                          $data = array(
                            "name" => "thn_pu2",
                            "class" => "form-control input-datepicker",
                            // "placeholder" => "Tanggal Berakhir SK",
                            "maxlength" => 10
                          );
                        ?>
                        <label class="control-label">
                          Tanggal Berakhir
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <?php echo form_input($data); ?>
                        </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">KP Eksplorasi</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_kpeks",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "KP Eksplorasi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "luas_kpeks",
                              "class" => "form-control input-number",
                              "placeholder" => "Luas (Hektare)"
                            );
                          ?>
                          <label class="control-label">
                            Luas (Hektare)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                            <span class="input-group-addon">
                              <span>Ha</span>
                            </span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-r-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "thn_kpeks1",
                              "class" => "form-control input-datepicker",
                              // "placeholder" => "Tanggal Penerbitan SK",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Tanggal Penerbitan
                          </label>
                          <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <?php echo form_input($data); ?>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-l-5">
                      <div class="form-group">
                        <?php
                          $data = array(
                            "name" => "thn_kpeks2",
                            "class" => "form-control input-datepicker",
                            // "placeholder" => "Tanggal Berakhir SK",
                            "maxlength" => 10
                          );
                        ?>
                        <label class="control-label">
                          Tanggal Berakhir
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <?php echo form_input($data); ?>
                        </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">IUP Eksplorasi</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_iupeks",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "IUP Eksplorasi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "luas_iupeks",
                              "class" => "form-control input-number",
                              "placeholder" => "Luas (Hektare)"
                            );
                          ?>
                          <label class="control-label">
                            Luas (Hektare)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                            <span class="input-group-addon">
                              <span>Ha</span>
                            </span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-r-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "thn_iupeks1",
                              "class" => "form-control input-datepicker",
                              // "placeholder" => "Tanggal Penerbitan SK",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Tanggal Penerbitan
                          </label>
                          <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <?php echo form_input($data); ?>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-l-5">
                      <div class="form-group">
                        <?php
                          $data = array(
                            "name" => "thn_iupeks2",
                            "class" => "form-control input-datepicker",
                            // "placeholder" => "Tanggal Berakhir SK",
                            "maxlength" => 10
                          );
                        ?>
                        <label class="control-label">
                          Tanggal Berakhir
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <?php echo form_input($data); ?>
                        </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">KP Eksploitasi</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_kpeksp",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "KP Eksploitasi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "luas_kpeksp",
                              "class" => "form-control input-number",
                              "placeholder" => "Luas (Hektare)"
                            );
                          ?>
                          <label class="control-label">
                            Luas (Hektare)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                            <span class="input-group-addon">
                              <span>Ha</span>
                            </span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-r-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "thn_kpeksp1",
                              "class" => "form-control input-datepicker",
                              // "placeholder" => "Tanggal Penerbitan SK",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Tanggal Penerbitan
                          </label>
                          <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <?php echo form_input($data); ?>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-l-5">
                      <div class="form-group">
                        <?php
                          $data = array(
                            "name" => "thn_kpeksp2",
                            "class" => "form-control input-datepicker",
                            // "placeholder" => "Tanggal Berakhir SK",
                            "maxlength" => 10
                          );
                        ?>
                        <label class="control-label">
                          Tanggal Berakhir
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <?php echo form_input($data); ?>
                        </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">IUP Pengangkutan dan Penjualan</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_iupjual",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK IUP Pengangkutan & Penjualan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "luas_iupjual",
                              "class" => "form-control input-number",
                              "placeholder" => "Luas (Hektare)"
                            );
                          ?>
                          <label class="control-label">
                            Luas (Hektare)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                            <span class="input-group-addon">
                              <span>Ha</span>
                            </span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-r-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "thn_iupjual1",
                              "class" => "form-control input-datepicker",
                              // "placeholder" => "Tanggal Penerbitan SK",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Tanggal Penerbitan
                          </label>
                          <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <?php echo form_input($data); ?>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-l-5">
                      <div class="form-group">
                        <?php
                          $data = array(
                            "name" => "thn_iupjual2",
                            "class" => "form-control input-datepicker",
                            // "placeholder" => "Tanggal Berakhir SK",
                            "maxlength" => 10
                          );
                        ?>
                        <label class="control-label">
                          Tanggal Berakhir
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <?php echo form_input($data); ?>
                        </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">IUP Operasi Produksi</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_iupop",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK IUP Operasi Produksi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "luas_iupop",
                              "class" => "form-control input-number",
                              "placeholder" => "Luas (Hektare)"
                            );
                          ?>
                          <label class="control-label">
                            Luas (Hektare)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                            <span class="input-group-addon">
                              <span>Ha</span>
                            </span>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-r-5">
                        <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "thn_iupop1",
                              "class" => "form-control input-datepicker",
                              // "placeholder" => "Tanggal Penerbitan SK",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Tanggal Penerbitan
                          </label>
                          <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <?php echo form_input($data); ?>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-l-5">
                      <div class="form-group">
                        <?php
                          $data = array(
                            "name" => "thn_iupop2",
                            "class" => "form-control input-datepicker",
                            // "placeholder" => "Tanggal Berakhir SK",
                            "maxlength" => 10
                          );
                        ?>
                        <label class="control-label">
                          Tanggal Berakhir
                        </label>
                        <div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                          <?php echo form_input($data); ?>
                        </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Data Perizinan</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_akta",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Akta Pendirian dan Perubahan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_kenapajak",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Pengusaha Kena Pajak"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_dagang",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Surat Izin Usaha Perdagangan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_kelayakan",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Kelayakan Lingkungan Hidup"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_manfaatbbc",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Pemanfaatan Tangki BBC"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_handak",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Penggunaan Handak"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_campur",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Pengelolaan/Pencampuran"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_izinlj",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Lintas Jalan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_cnc",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "No. SK Clean and Clear"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_npwp",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "NPWP Badan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_tdper",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Tanda Daftar Perusahaan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_ho",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin UU Gangguan/HO"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_limbah",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Pengelolaan Limbah B3"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_bbc",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Tangki Bahan Bakar Cair"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_pelabuhan",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Terminal/Pelabuhan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_ujp",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Usaha Jasa Pertambangan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_setling",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Setling Pond"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_domisili",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Domisili Perusahaan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_pajak",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Terdaftar Pajak"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_eksport",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Eksportir Terdaftar"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_air",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Pemanfaatan Air Bawah Tanah"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_gudang",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "No. Izin Gudang Handak"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_kawasan",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Pinjam Kawasan Hutan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_opkhusus",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "IUP OP Pengangkutan/Penjualan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_lingkungan",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Izin Lingkungan"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Data Dokumen</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_jamrekeks",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Jaminan Reklamasi Tahap Eksplorasi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_jaminankesungguhan",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Jaminan Kesungguhan Eksplorasi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_fs",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Nomor Dokumen FS"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_rp",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "No. Dokumen Rencana Pasca Tambang"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_jamrekpro",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Jaminan Reklamasi Tahap Produksi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_iuran",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Iuran Tetap"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_amdal",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "No. Dokumen AMDAL/UKL-UPL"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_rkttl",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "No. Dokumen RKTTL"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_jamtup",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Jaminan Pasca Tambang"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_royalti",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "SK Royalti"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_rr",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "No. Dokumen Rencana Reklamasi"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "no_rkab",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "No. Dokumen RKAB"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Sumber Daya</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php
                              $data = array(
                                "name"        => "komoditas",
                                "class"       => "form-control input-md input-small",
                                "placeholder" => "Komoditas"
                              );
                              echo form_label($data["placeholder"], $data["name"]);
                              echo form_input($data);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "tereka",
                              "class" => "form-control",
                              // "placeholder" => "Tereka (Ton)",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Tereka (Ton)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                              <span class="input-group-addon">
                                <span>Ton</span>
                              </span>
                          </div>
                       </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "terunjuk",
                              "class" => "form-control",
                              // "placeholder" => "Tereka (Ton)",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Terunjuk (Ton)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                              <span class="input-group-addon">
                                <span>Ton</span>
                              </span>
                          </div>
                       </div>
                    </div>
                    <div class="col-md-4">
                       <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "terukur",
                              "class" => "form-control",
                              // "placeholder" => "Tereka (Ton)",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Terukur (Ton)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                              <span class="input-group-addon">
                                <span>Ton</span>
                              </span>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Kualitas Batubara</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                      <div class="form-group">
                         <?php
                           $data = array(
                             "name" => "moisture",
                             "class" => "form-control",
                             // "placeholder" => "Tereka (Ton)",
                             "maxlength" => 10
                           );
                         ?>
                         <label class="control-label">
                           Total Moisture (%)
                         </label>
                         <div class="input-group">
                           <?php echo form_input($data); ?>
                             <span class="input-group-addon">
                               <span>%</span>
                             </span>
                         </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "sulphur",
                              "class" => "form-control",
                              // "placeholder" => "Tereka (Ton)",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Total Sulphur (%)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                              <span class="input-group-addon">
                                <span>%</span>
                              </span>
                          </div>
                       </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "ash",
                              "class" => "form-control",
                              // "placeholder" => "Tereka (Ton)",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            ASH (%)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                              <span class="input-group-addon">
                                <span>%</span>
                              </span>
                          </div>
                       </div>
                    </div>
                    <div class="col-md-6">
                       <div class="form-group">
                          <?php
                            $data = array(
                              "name" => "calori",
                              "class" => "form-control",
                              // "placeholder" => "Tereka (Ton)",
                              "maxlength" => 10
                            );
                          ?>
                          <label class="control-label">
                            Calorific Value (Adb)
                          </label>
                          <div class="input-group">
                            <?php echo form_input($data); ?>
                              <span class="input-group-addon">
                                <span>Adb</span>
                              </span>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Cadangan</h4>
                </div>
                <div class="panel-body">
                   <div class="col-md-12">
                      <div class="form-group">
                         <?php
                           $data = array(
                             "name" => "terkira",
                             "class" => "form-control",
                             // "placeholder" => "Tereka (Ton)",
                             "maxlength" => 10
                           );
                         ?>
                         <label class="control-label">
                           Terkira (Ton)
                         </label>
                         <div class="input-group">
                           <?php echo form_input($data); ?>
                             <span class="input-group-addon">
                               <span>Ton</span>
                             </span>
                         </div>
                      </div>
                      <div class="form-group">
                         <?php
                           $data = array(
                             "name" => "terbukti",
                             "class" => "form-control",
                             // "placeholder" => "Tereka (Ton)",
                             "maxlength" => 10
                           );
                         ?>
                         <label class="control-label">
                           Terbukti (Ton)
                         </label>
                         <div class="input-group">
                           <?php echo form_input($data); ?>
                             <span class="input-group-addon">
                               <span>Ton</span>
                             </span>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Penjualan</h4>
                </div>
                <div class="panel-body">
                   <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Jenis Penjualan</label>
                          <select class="form-control selectpicker m-b-0" name="jenis_penjualan">
                            <option value="">Jenis Penjualan</option>
                            <option value="Dalam Negeri">Dalam Negeri</option>
                            <option value="Luar Negeri">Luar Negeri</option>
                            <option value="Dalam dan Luar Negeri">Dalam dan Luar Negeri</option>
                          </select>
                      </div>
                      <div class="form-group">
                         <?php
                           $data = array(
                             "name" => "jumlah_penjualan",
                             "class" => "form-control",
                             // "placeholder" => "Tereka (Ton)",
                             "maxlength" => 10
                           );
                         ?>
                         <label class="control-label">
                           Jumlah Penjualan (Ton)
                         </label>
                         <div class="input-group">
                           <?php echo form_input($data); ?>
                             <span class="input-group-addon">
                               <span>Ton</span>
                             </span>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                      <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-plus"></i></a>
                    </div>
                    <h4 class="panel-title">Keterangan</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <?php
                          $data = array(
                            "name"        => "ket",
                            "class"       => "form-control input-md input-small",
                            "style"       => "resize:none;height:105px",
                            "placeholder" => "Keterangan"
                          );
                          echo form_label($data["placeholder"], $data["name"]);
                          echo form_textarea($data);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-3">
            <button type="submit" class="btn btn-inverse btn-block btn-lg">Save</button>
        </div>
    </div>
    </form>
</div>
