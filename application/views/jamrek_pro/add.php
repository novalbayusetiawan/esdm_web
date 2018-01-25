<script>
// Event Section
$(document).on("click", ".data-add", function(event){
    event.preventDefault();
    $("#form_add").find("button[type='reset']").click();
    $("#modal_add").modal({backdrop: 'static'});
    $("#modal_add").modal("show");
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
            $("#modal_add").modal("hide");
            oTable.draw();
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
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="form_add" role="form" action="<?php echo base_url("jamrek_pro/insert"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">ADD</h4>
            </div>
            <?php echo form_hidden("id_perusahaan", $id); ?>
            <div class="modal-body">
                <h4>Penetapan Jamrek</h4>
                <div class="row">
                    <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "thn_prajamrek",
                                "class" => "form-control",
                                "placeholder" => "Tahun Jamrek",
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
                                "name" => "rupiah_prajamrek",
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
                                "name" => "dollar_prajamrek",
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
                <h4>Penempatan Jamrek</h4>
                <div class="row">
                <div class="col col-md-12">
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "thn_jamrek",
                                "class" => "form-control",
                                "placeholder" => "Tahun Jamrek",
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
                                "name" => "rupiah_jamrek",
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
                                "name" => "dollar_jamrek",
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
                                "name" => "jenis_jamrek",
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
                                "name" => "bank_jamrek",
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
