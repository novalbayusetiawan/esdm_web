<script>
// Event Section
$(document).ready(function(){
    request = $.ajaxq("queue", {
        "url" : "<?php echo base_url("user/get_one?id=".$this->session->userdata("user_id")); ?>",
        "dataType" : "json",
        "beforeSend" : function(){
        }
    });
    request.done(function(json){
        $("#form_edit").find("select option").prop("selected", false);
        $("#form_password").find("input[name=id]").val(json.result.id);
        $("#form_edit").find("input[name=id]").val(json.result.id);
        $("#form_edit").find("input[name=last_username]").val(json.result.username);
        $("#form_edit").find("input[name=username]").val(json.result.username);
    });
    request.fail(function(jqXHR, textStatus){
        $.gritter.add({title: "Request failed", text: textStatus});
    });
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
        <?php echo $title[0]; ?> 
        <small><?php echo $title[1]; ?></small>
    </h1>
    <div class="row">
        <div class="col-md-5">
            <ul class="nav nav-pills">
                <li class="active"><a aria-expanded="false" href="#default-tab-1" data-toggle="tab">Profile</a></li>
                <li class=""><a aria-expanded="false" href="#default-tab-2" data-toggle="tab">Security</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="default-tab-1">
                    <form id="form_edit" role="form" action="<?php echo base_url("account/update"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
                    <?php echo form_hidden("id", ""); ?>
                    <?php echo form_hidden("last_username", ""); ?>
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "username",
                                "class" => "form-control",
                                "placeholder" => "Nama Pengguna",
                                "minlength" => "4",
                                "maxlength" => "24",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_input($data);
                            ?>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="default-tab-2">
                    <form id="form_password" role="form" action="<?php echo base_url("account/update_password"); ?>" method="POST" enctype="application/x-www-form-urlencoded">
                    <?php echo form_hidden("id", ""); ?>
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "old_password",
                                "class" => "form-control",
                                "placeholder" => "Old Password",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_password($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "new_password",
                                "class" => "form-control",
                                "placeholder" => "New Password",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_password($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php
                            $data = array(
                                "name" => "confirm_password",
                                "class" => "form-control",
                                "placeholder" => "Retype New Password",
                                "required" => "required"
                            );
                            echo form_label($data["placeholder"], $data["name"]);
                            echo form_password($data);
                            ?>
                        </div>
                        <div class="text-right form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>
</div>
