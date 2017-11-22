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
<link rel="stylesheet" type="text/css" href="<?php echo base_url($style); ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/theme/default.css"); ?>" id="theme" />

<!-- Insert this line above script imports  -->
<script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>

<!-- normal script imports etc  -->
<?php foreach($this->scripts as $script){ ?>
<script src="<?php echo base_url($script); ?>"></script>
<?php } ?>

<!-- Insert this line after script imports -->
<script>if (window.module) module = window.module;</script>

<title><?php echo is_array($title)? implode(" :: ", $title) : $title; ?></title>

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