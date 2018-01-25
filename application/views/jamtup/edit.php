<script>
// Event Section
$(document).on("click", ".data-edit", function(event){
    event.preventDefault();
    $btn = $(this);
    request = $.ajaxq("queue", {
        "url" : $(this).attr("url-api"),
        "dataType" : "json",
        "beforeSend" : function(){
            $("#form_edit").find("button[type='reset']").click();
            $btn.button("loading");
        }
    });
    request.done(function(json){
        $("#form_edit").find("select option").prop("selected", false);
        $("#form_edit").find("input[name=id]").val(json.result.id);
        $("#form_edit").find("input[name=thn_prajamtup]").val(json.result.thn_prajamtup);
        $("#form_edit").find("input[name=rupiah_prajamtup]").val(json.result.rupiah_prajamtup);
        $("#form_edit").find("input[name=dollar_prajamtup]").val(json.result.dollar_prajamtup);
        $("#form_edit").find("input[name=thn_jamtup]").val(json.result.thn_jamtup);
        $("#form_edit").find("input[name=rupiah_jamtup]").val(json.result.rupiah_jamtup);
        $("#form_edit").find("input[name=dollar_jamtup]").val(json.result.dollar_jamtup);
        $("#form_edit").find("input[name=jenis_jamtup]").val(json.result.jenis_jamtup);
        $("#form_edit").find("input[name=bank_jamtup]").val(json.result.bank_jamtup);
        $("#modal_edit").modal({backdrop: 'static'});
        $("#modal_edit").modal("show");
        $btn.button("reset");
    });
    request.fail(function(jqXHR, textStatus){
        $.gritter.add({title: "Request failed", text: textStatus});
        $btn.button("reset");
    });
    return false;
});
// Event Section  
$(document).on("submit", "#form_edit", function(event){
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
            oTable.draw();
            form.find("input[name=last_username]").val(form.find("input[name=username]").val());
            form.find("input[name=last_user_email]").val(form.find("input[name=user_email]").val());
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
</script>
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="form_edit" role="form" action="<?php echo base_url("jamtup/update"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">CHANGE</h4>
            </div>
            <?php echo form_hidden("id", ""); ?>
            <?php echo form_hidden("id_perusahaan", $id); ?>
            <div class="modal-body">
                <h4>Rencana Jamtup</h4>
                <div class="row">
                    
                    <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "thn_prajamtup",
                                "class" => "form-control",
                                "placeholder" => "Tahun Jamtup",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "rupiah_prajamtup",
                                "class" => "form-control",
                                "placeholder" => "Besaran Rupiah",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_number($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "dollar_prajamtup",
                                "class" => "form-control",
                                "placeholder" => "Besaran Dollar",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_number($data);
                            ?>
                        </div>
                    </div>
                </div>
                <hr />
                <h4>Realisasi Jamtup</h4>
                <div class="row">
                    <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "thn_jamtup",
                                "class" => "form-control",
                                "placeholder" => "Tahun Jamtup",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "rupiah_jamtup",
                                "class" => "form-control",
                                "placeholder" => "Besaran Rupiah",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_number($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "dollar_jamtup",
                                "class" => "form-control",
                                "placeholder" => "Besaran Dollar",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_number($data);
                            ?>
                        </div>
                    </div>
                </div>
                
                <hr />
                <div class="row">
                    <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "jenis_jamtup",
                                "class" => "form-control",
                                "placeholder" => "Jenis Jaminan/Deposito",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "bank_jamtup",
                                "class" => "form-control",
                                "placeholder" => "Nama Bank",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
    </form>
</div>
