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
    <form id="form_add" role="form" action="<?php echo base_url("user/insert"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">ADD</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php
                    $data = array(
                        "name" => "username",
                        "class" => "form-control",
                        "placeholder" => "Username",
                        "minlength" => "4",
                        "maxlength" => "24",
                        "required" => "required"
                    );
                    echo form_label($data["placeholder"], $data["name"]);
                    echo form_input($data);
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    $data = array(
                        "name" => "password",
                        "class" => "form-control",
                        "placeholder" => "Passwrod",
                        "required" => "required"
                    );
                    echo form_label($data["placeholder"], $data["name"]);
                    echo form_password($data);
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label("Region Name", "nama_wilayah");
                    echo form_dropdown("nama_wilayah", $regions, "", "class=\"form-control\"");
                    ?>
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
