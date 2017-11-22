<?php if ( ! defined('BASEPATH')) Exit('No direct script access allowed');

class Page extends CI_Controller {
    
    public $styles = array(
        "http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700", 
        "assets/plugins/jquery-ui/jquery-ui.min.css",
        "assets/plugins/jquery.scrollbar/includes/prettify/prettify.css",
        "assets/plugins/jquery.scrollbar/jquery.scrollbar.css",
        "assets/plugins/gritter/css/jquery.gritter.css",
        // "assets/plugins/datatables/media/css/dataTables.bootstrap.min.css",
        "assets/plugins/bootstrap/css/bootstrap.min.css",
        // "assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css",
        // "assets/plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css",
        "assets/plugins/animate/animate.min.css",
        // "assets/plugins/fancybox/source/jquery.fancybox.css",
        // "assets/css/css.css",
        "assets/plugins/font-awesome/css/font-awesome.min.css",
        "assets/css/style.min.css", 
        "assets/css/style-responsive.min.css"
    );
    public $scripts = array(
        // "assets/plugins/zeroclipboard/ZeroClipboard.min.js",
        "assets/plugins/jquery/jquery-1.9.1.min.js",
        "assets/plugins/jquery/jquery-migrate-1.1.0.min.js",
        "assets/plugins/ajaxq/ajaxq.js",
        "assets/plugins/jquery.scrollbar/includes/prettify/prettify.js",
        "assets/plugins/jquery.scrollbar/jquery.scrollbar.min.js",
        // "assets/plugins/sandbox/jquery.highlight.js",
        "assets/plugins/jquery-ui/jquery-ui.min.js",
        // "assets/plugins/datatables/media/js/jquery.dataTables.min.js",
        // "assets/plugins/datatables/media/js/dataTables.bootstrap.min.js",
        // "assets/plugins/highcharts/code/js/highcharts-all.js",
        // "assets/plugins/highcharts/code/js/highcharts-more.js",
        "assets/plugins/slimscroll/jquery.slimscroll.min.js",
        "assets/plugins/gritter/js/jquery.gritter.min.js",
        "assets/plugins/jquery-cookie/src/jquery.cookie.js",
        "assets/plugins/bootstrap/js/bootstrap.min.js",
        // "assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js",
        // "assets/plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js",
        "assets/plugins/bootstrap-bootbox/bootbox.min.js",
        // "assets/plugins/ace-builds/src-min/ace.js",
        // "assets/plugins/fancybox/source/jquery.fancybox.js",
        "assets/plugins/pace/pace.min.js",
		// "assets/js/accounting.min.js",
		// "assets/js/photobooth_min.js",
		// "assets/js/analytics.js",
        "assets/js/apps.min.js"
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("session");
    }

    public function unavailable()
    {
        header('HTTP/1.1 503 Service Temporarily Unavailable');
        header('Status: 503 Service Temporarily Unavailable');
        header("Content-type: text/html");
        $data["title"][] = "Page";
        $data["title"][] = "Service Unavailable";
        $data["view"] = "page/unavailable";
        $this->load->view("error_template", $data);
    }

    public function access_denied()
    {
        header("HTTP/1.1 401 Unauthorized");
        header("Status: 401 Unauthorized");
        header("Content-type: text/html");
        $data["title"][] = "Page";
        $data["title"][] = "Access Denied";
        $data["view"] = "page/access_denied";
        $this->load->view("error_template", $data);
    }

    public function not_found()
    {
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        header("Content-type: text/html");
        $data["title"][] = "Page";
        $data["title"][] = "Not Found";
        $data["view"] = "page/not_found";
        $this->load->view("error_template", $data);
    }
}
