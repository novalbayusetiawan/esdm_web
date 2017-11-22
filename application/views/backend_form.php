<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta content="<?php echo $this->config->item("description", "about"); ?>" name="description">
<meta content="<?php echo $this->config->item("appname", "about"); ?>" name="appname">
<meta content="<?php echo $this->config->item("version", "about"); ?>" name="version">
<meta content="<?php echo $this->config->item("author", "about"); ?>" name="author">
<?php foreach($this->styles as $style){ ?>
<link rel="stylesheet" type="text/css" href="<?php echo preg_match("/^http.*/i", $style)? $style : base_url($style); ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/theme/default.css"); ?>" id="theme" />
<link rel="shortcut icon" type="image/png" href="<?php echo base_url()?>assets/img/distamben.ico"/>
<!-- Insert this line above script imports  -->
<script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>

<!-- normal script imports etc  -->
<?php foreach($this->scripts as $script){ ?>
<script src="<?php echo base_url($script); ?>"></script>
<?php } ?>

<!-- Insert this line after script imports -->
<script>if (window.module) module = window.module;</script>

<title><?php echo is_array($title)? implode(" :: ", $title) : $title; ?></title>

<style> /* Let's get this party started */ ::-webkit-scrollbar { width: 5px; } /* Track */ ::-webkit-scrollbar-track { -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); -webkit-border-radius: 10px; border-radius: 10px; } /* Handle */ ::-webkit-scrollbar-thumb { -webkit-border-radius: 10px; border-radius: 10px; background: #333333 -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); } ::-webkit-scrollbar-thumb:window-inactive { background: #333333; }
/* Let's get this party started */ ::-moz-scrollbar { width: 5px; } /* Track */ ::-moz-scrollbar-track { -moz-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); -moz-border-radius: 10px; border-radius: 10px; } /* Handle */ ::-moz-scrollbar-thumb { -moz-border-radius: 10px; border-radius: 10px; background: #333333 -moz-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); } ::-moz-scrollbar-thumb:window-inactive { background: #333333; }
.active-item{ background-color:#eee; } .modal-body-custom { max-height: calc(100vh - 175px); overflow-y: auto; } .custom.list-group-item:first-child { border-top-right-radius: 0px !important; border-top-left-radius: 0px !important; } .custom.list-group-item:last-child { border-bottom-right-radius: 0px !important; border-bottom-left-radius: 0px !important; } .custom.list-group-item { border-left:0px !important; border-right:0px !important; } .custom.list-group-item { border-left:0px !important; border-right:0px !important; } #editor { margin: 0; position: absolute; top: 0; bottom: 0; left: 0; right: 0; } </style>
</head>
<body class="-flat-black">
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<div id="page-container" class="fade">
<?php $this->load->view($view); ?>
</div>
<script id="WebApplication">
$(document).ready(function(){
    App.init();
});
</script>
<?php $this->load->view("backend_panel"); ?>
</body>
</html>
