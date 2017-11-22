<?php if ( ! defined('BASEPATH')) Exit('No direct script access allowed');

class Account extends CI_Controller {

    public $styles = array(
        "http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700",
        "assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css",
        "assets/plugins/jquery.scrollbar/includes/prettify/prettify.css",
        "assets/plugins/jquery.scrollbar/jquery.scrollbar.css",
        "assets/plugins/gritter/css/jquery.gritter.css",
        "assets/plugins/datatables/media/css/dataTables.bootstrap.min.css",
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
        "assets/plugins/datatables/media/js/jquery.dataTables.min.js",
        "assets/plugins/datatables/media/js/dataTables.bootstrap.min.js",
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
        $this->load->helper("my_form");
        $this->load->library("session");
        $this->load->library("my_auth");
        $this->load->library("my_api");
        $this->my_auth->run();
    }

    public function settings()
    {
        header("Content-type: text/html");

        $data["title"][] = "Account";
        $data["title"][] = "Settings";
        $data["view"] = "account/settings";
        $this->load->view("backend_template", $data);
    }

    public function update()
    {
        header("Content-type: application/json");

        $params = array(
            "id" => $this->input->post("id"),
            "username" => $this->input->post("username"),
            "last_username" => $this->input->post("last_username")
        );

        $server_api = $this->config->item("api", "esdm");
        $connected = @fsockopen(preg_replace(array("/http?:\/\//i", "/\/.*/i"), "", $server_api), 80);

        if ($connected) {

            // Server
            $api = $this->config->item("api", "esdm");
            $app_id = $this->config->item("app_id", "esdm");
            $app_token = $this->config->item("app_token", "esdm");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("account/update", $params);

            // Local
            // $params = json_decode($response, TRUE)["result"];
            $api = $this->config->item("api", "esdm_local");
            $app_id = $this->config->item("app_id", "esdm_local");
            $app_token = $this->config->item("app_token", "esdm_local");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("account/update", $params);

        } else {
            $response = json_encode(array(
                "status" => False,
                "message" => "Please check your connection, server can't be reached.",
                "result" => False
            ));
        }
        echo $response;

        // Local
        // $api = $this->config->item("api", "esdm_local");
        // $app_id = $this->config->item("app_id", "esdm_local");
        // $app_token = $this->config->item("app_token", "esdm_local");
        // $this->my_api->set_api($api);
        // $this->my_api->set_app_id($app_id);
        // $this->my_api->set_app_token($app_token);
        // $response = $this->my_api->get_response("account/update", $params);
        // echo $response;
    }

    public function update_password()
    {
        header("Content-type: application/json");

        $params = array(
            "id" => $this->input->post("id"),
            "old_password" => hash("sha1", $this->input->post("old_password")),
            "new_password" => hash("sha1", $this->input->post("new_password"))
        );

        $server_api = $this->config->item("api", "esdm");
        $connected = @fsockopen(preg_replace(array("/http?:\/\//i", "/\/.*/i"), "", $server_api), 80);

        if ($connected) {

            // Server
            $api = $this->config->item("api", "esdm");
            $app_id = $this->config->item("app_id", "esdm");
            $app_token = $this->config->item("app_token", "esdm");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("account/update_password", $params);

            // Local
            // $params = json_decode($response, TRUE)["result"];
            $api = $this->config->item("api", "esdm_local");
            $app_id = $this->config->item("app_id", "esdm_local");
            $app_token = $this->config->item("app_token", "esdm_local");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("account/update_password", $params);

        } else {
            $response = json_encode(array(
                "status" => False,
                "message" => "Please check your connection, server can't be reached.",
                "result" => False
            ));
        }
        echo $response;

        // Local
        // $api = $this->config->item("api", "esdm_local");
        // $app_id = $this->config->item("app_id", "esdm_local");
        // $app_token = $this->config->item("app_token", "esdm_local");
        // $this->my_api->set_api($api);
        // $this->my_api->set_app_id($app_id);
        // $this->my_api->set_app_token($app_token);
        // $response = $this->my_api->get_response("account/update_password", $params);
        // echo $response;
    }
}
