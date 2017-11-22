<script>
function handleImage(img){
    img.src = "<?php echo base_url("assets/img/login-bg/bigstock-Construction.jpg"); ?>";
    // img.src = "<?php echo base_url("assets/img/login-bg/bigstock-Construction2.jpg"); ?>";
}
// Event Section
$(document).on("submit", "#form", function(event){
    event.preventDefault();
    $btn = $(this).find("button[type=submit]");
    last_style = $("body").attr("style");
    request = $.ajaxq("queue", {
        "url":$(this).attr("action"),
        "type":"POST",
        "data":$(this).serialize(),
        "dataType":"json",
        "beforeSend" : function(){
            $btn.button("loading");
        }
    });
    request.done(function(json){
        if(json.status){
            $.gritter.add({title: "Message", text: json.message});
            document.location = "<?php echo base_url("dashboard"); ?>";
        }else{
            bootbox.alert(json.message, function(){
            });
        }
        $btn.button("reset");
    });
    request.fail(function(jqXHR, textStatus){
        $.gritter.add({title: "Request failed", text: textStatus});
        $btn.button("reset");
    });
    return false;
});
// Ready Section
$(document).ready(function(){
    App.init();
});
</script>
<div class="login login-with-news-feed">
    <div class="news-feed" style="background-color:#111111;">
        <!-- <div class="news-image"> -->
            <img src="<?php echo base_url("assets/img/login-bg/bigstock-Construction.jpg"); ?>" data-id="login-cover-image" alt="" style="width:100%;height:100%;" onerror="handleImage(this)" />
        <!-- </div> -->
        <div class="news-caption">
            <h4 class="caption-title" style="font-size:20px">
            <!--i class="fa fa-diamond text-success"></i-->
            <!-- <img src="<?php echo base_url("assets/img/logo.gif"); ?>" style="width:30px;" /> -->
            Dinas Energi dan Sumber Daya Mineral Provinsi Kalimantan Timur</h4>
            <p>
                Mewujudkan Kalimantan Timur sebagai lumbung energi yang berkelanjutan dan pengelolaan pertambangan yang berwawasan lingkungan untuk kesejahteraan masyarakat.
            </p>
        </div>
    </div>
    <div class="right-content">
        <div class="login-header">
            <!-- <img src="<?php echo base_url("assets/img/logo.gif"); ?>" style="width:50px;" /> -->
            <div class="icon" style="opacity:10">
                <img src="<?php echo base_url("assets/img/logo.gif"); ?>" style="width:85px;" />
                <!-- <i class="fa fa-sign-in" style="font-size:90px"></i> -->
            </div>
            <div class="brand" style="font-size:23px;">
                DISTAMBEN KALTIM
                <small>Dinas Energi dan Sumber Daya Mineral <br />Provinsi Kalimantan Timur</small>
            </div>
        </div>
        <div class="login-content">
            <form id="form" action="<?php echo base_url("user/signin"); ?>" method="post" class="form-signin margin-bottom-0">
                <div class="form-group m-b-15">
                    <?php
                    $data = array(
                        "id" => "username",
                        "name" => "username",
                        "class" => "form-control input-lg -without-border -inverse-mode",
                        "placeholder" => "Username",
                        "autofocus" => "autofocus",
                        "required" => "required"
                    );
                    echo form_input($data);
                    ?>
                </div>
                <div class="form-group m-b-15">
                    <?php
                    $data = array(
                        "id" => "password",
                        "name" => "password",
                        "class" => "form-control input-lg -without-border -inverse-mode",
                        "placeholder" => "Password",
                        "required" => "required"
                    );
                    echo form_password($data);
                    ?>
                </div>
                <!--div class="checkbox m-b-30">
                    <label>
                        <input type="checkbox" /> Remember Me
                    </label>
                </div-->
                <div class="login-buttons">
                    <button type="submit" class="btn btn-inverse btn-block btn-lg">Sign me in</button>
                </div>
                <hr style="border-top:1px solid #2d353c;margin:40px 40px 10px" />
                <p class="text-center text-inverse">
                    &copy; DISTAMBEN KALTIM - 2017
                </p>
            </form>
        </div>
    </div>
</div>
