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
        $("#form_edit").find("input[name=last_username]").val(json.result.username);
        $("#form_edit").find("input[name=username]").val(json.result.username);
        $("#form_edit").find("select[name=nama_wilayah] option[value='"+json.result.nama_wilayah+"']").prop("selected", true);
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
    <form id="form_edit" role="form" action="<?php echo base_url("user/update"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">CHANGE</h4>
            </div>
            <?php echo form_hidden("id", ""); ?>
            <?php echo form_hidden("last_username", ""); ?>
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
