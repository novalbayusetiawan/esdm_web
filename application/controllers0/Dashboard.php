<?php if ( ! defined('BASEPATH')) Exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
        "assets/css/style-responsive.min.css",
        "assets/css/custom.css"
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
        $this->load->library("my_auth");
        $this->load->library("my_api");
        $this->my_auth->run();
    }

    public function index()
    {
        header("Content-type: text/html");
        
        // Local
        $api = $this->config->item("api", "esdm_local");
        $app_id = $this->config->item("app_id", "esdm_local");
        $app_token = $this->config->item("app_token", "esdm_local");
        $this->my_api->set_api($api);
        $this->my_api->set_app_id($app_id);
        $this->my_api->set_app_token($app_token);
        
        $data["iupop_exp"] = json_decode($this->my_api->get_response("perusahaan/get_expire_total", array(
            "acc_level" => $this->session->userdata("acc_level"),
            "jenis" => "iupop"
        )), TRUE)["result"];
        
        $data["iupeks_exp"] = json_decode($this->my_api->get_response("perusahaan/get_expire_total", array(
            "acc_level" => $this->session->userdata("acc_level"),
            "jenis" => "iupeks"
        )), TRUE)["result"];
        
        $data["cnc_exp"] = json_decode($this->my_api->get_response("perusahaan/get_expire_total", array(
            "acc_level" => $this->session->userdata("acc_level"),
            "jenis" => "cnc"
        )), TRUE)["result"];
        
        $data["noncnc_exp"] = json_decode($this->my_api->get_response("perusahaan/get_expire_total", array(
            "acc_level" => $this->session->userdata("acc_level"),
            "jenis" => "noncnc"
        )), TRUE)["result"];
        
        $data["title"][] = "Dashboard";
        $data["title"][] = "Welcome ".$this->session->userdata("name");
        $data["view"] = "dashboard/index";
        $this->load->view("backend_template", $data);
    }
}
