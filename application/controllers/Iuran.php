<?php if ( ! defined('BASEPATH')) Exit('No direct script access allowed');

class Iuran extends CI_Controller {

    public $styles = array(
        "http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700",
        "assets/plugins/jquery-ui/jquery-ui.min.css",
        "assets/plugins/jquery.scrollbar/includes/prettify/prettify.css",
        "assets/plugins/jquery.scrollbar/jquery.scrollbar.css",
        "assets/plugins/gritter/css/jquery.gritter.css",
        "assets/plugins/datatables/media/css/dataTables.bootstrap.min.css",
        "assets/plugins/datatables/extensions/Buttons/css/buttons.bootstrap.min.css",
        "assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css",
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
        "assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js",
        "assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js",
        "assets/plugins/datatables/extensions/Buttons/js/buttons.bootstrap.min.js",
        "assets/plugins/datatables/extensions/Buttons/js/jszip.min.js",
        "assets/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js",
        // "resource/plugins/datatables/extensions/Buttons/js/buttons.print.min.js",
        "assets/plugins/datatables/media/js/dataTables.fixedColumns.min.js",
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

    public function index()
    {
        header("Content-type: text/html");

        $data["title"][] = "Iuran Tetap";
        $data["title"][] = "Index";
        $data["view"] = "iuran/index";

        $this->load->view("backend_template", $data);
    }

    public function change_form()
    {
        header("Content-type: text/html");

        // Local
        $api = $this->config->item("api", "esdm_local");
        $app_id = $this->config->item("app_id", "esdm_local");
        $app_token = $this->config->item("app_token", "esdm_local");
        $this->my_api->set_api($api);
        $this->my_api->set_app_id($app_id);
        $this->my_api->set_app_token($app_token);

        $response = $this->my_api->get_response("perusahaan/get_one", array(
            "id" => $this->input->get("id")
        ));
        $data["nama_perusahaan"] = json_decode($response, TRUE)["result"]["nama_perusahaan"];

        $data["id"] = $this->input->get("id");
        $data["tahun"] = array();
        for ($tahun = 2010; $tahun < 2025; $tahun++){
            $data["tahun"][$tahun] = $tahun;
        }

        $data["title"][] = "Iuran Tetap";
        $data["title"][] = "Edit";
        $data["view"] = "iuran/change_form";

        $this->load->view("backend_template", $data);
    }

    public function dt_show()
    {
        header("Content-type: application/json");

        $params = array(
            "page" => (((int) $_POST["start"]) + (int) $_POST["length"]) / (int) $_POST["length"],
            "perpage" => (int) $_POST["length"],
            "order_by" => $_POST["columns"][(int) ($_POST["order"][0]["column"])]["data"]."+".$_POST["order"][0]["dir"],
            "search" => $_POST["search"]["value"],

            "acc_level" => $this->session->userdata("acc_level"),
            "id_perusahaan" => $this->input->get("id_perusahaan")
        );

        // Local
        $api = $this->config->item("api", "esdm_local");
        $app_id = $this->config->item("app_id", "esdm_local");
        $app_token = $this->config->item("app_token", "esdm_local");
        $this->my_api->set_api($api);
        $this->my_api->set_app_id($app_id);
        $this->my_api->set_app_token($app_token);

        $response = $this->my_api->get_response("iuran/dt_show", $params);
        // echo $this->my_api->get_last_api();
        $data = json_decode($response, True);
        $result = $data["result"];

        for ($i = 0; $i < count($result["data"]); $i++){
            $id = $result["data"][$i]["id"];
            $result["data"][$i]["action"] = "<div class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-success btn-xs dropdown-toggle\" data-toggle=\"dropdown\">
                    Action <span class=\"caret\"></span>
                </button>
                <ul class=\"dropdown-menu pull-right\" role=\"menu\">
                    <li><a href=\"javascript:;\" url-api=\"".base_url("iuran/get_one?id=$id")."\" class=\"data-edit\">Change</a></li>
                    <li><a href=\"javascript:;\" url-api=\"".base_url("iuran/delete?id=$id")."\" class=\"data-delete\">Remove</a></li>
                </ul>
            </div>";
        }
        echo json_encode($result);
    }

    public function get_one()
    {
        header("Content-type: application/json");

        $params = array(
            "id" => $this->input->get("id")
        );

        // Local
        $api = $this->config->item("api", "esdm_local");
        $app_id = $this->config->item("app_id", "esdm_local");
        $app_token = $this->config->item("app_token", "esdm_local");
        $this->my_api->set_api($api);
        $this->my_api->set_app_id($app_id);
        $this->my_api->set_app_token($app_token);

        $response = $this->my_api->get_response("iuran/get_one", $params);
        echo $response;
    }

    public function insert()
    {
        header("Content-type: application/json");

        $params = array(
            "thn_prajamrek" => $this->input->post("thn_prajamrek"),
            "rupiah_prajamrek" => $this->input->post("rupiah_prajamrek"),
            "dollar_prajamrek" => $this->input->post("dollar_prajamrek"),
            "thn_jamrek" => $this->input->post("thn_jamrek"),
            "rupiah_jamrek" => $this->input->post("rupiah_jamrek"),
            "dollar_jamrek" => $this->input->post("dollar_jamrek"),
            "jenis_jamrek" => $this->input->post("jenis_jamrek"),
            "bank_jamrek" => $this->input->post("bank_jamrek"),
            "id_perusahaan" => $this->input->post("id_perusahaan")
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
            $response = $this->my_api->get_response("iuran/insert", $params);

            // Local
            // $params = json_decode($response, TRUE)["result"];
            $api = $this->config->item("api", "esdm_local");
            $app_id = $this->config->item("app_id", "esdm_local");
            $app_token = $this->config->item("app_token", "esdm_local");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("iuran/insert", $params);

        } else {
            $response = json_encode(array(
                "status" => False,
                "message" => "Please check your connection, server can't be reached.",
                "result" => False
            ));
        }
        echo $response;
    }

    public function update()
    {
        header("Content-type: application/json");

        $params = array(
            "id" => $this->input->post("id"),
            "thn_prajamrek" => $this->input->post("thn_prajamrek"),
            "rupiah_prajamrek" => $this->input->post("rupiah_prajamrek"),
            "dollar_prajamrek" => $this->input->post("dollar_prajamrek"),
            "thn_jamrek" => $this->input->post("thn_jamrek"),
            "rupiah_jamrek" => $this->input->post("rupiah_jamrek"),
            "dollar_jamrek" => $this->input->post("dollar_jamrek"),
            "jenis_jamrek" => $this->input->post("jenis_jamrek"),
            "bank_jamrek" => $this->input->post("bank_jamrek"),
            "id_perusahaan" => $this->input->post("id_perusahaan")
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
            $response = $this->my_api->get_response("iuran/update", $params);

            // Local
            // $params = json_decode($response, TRUE)["result"];
            $api = $this->config->item("api", "esdm_local");
            $app_id = $this->config->item("app_id", "esdm_local");
            $app_token = $this->config->item("app_token", "esdm_local");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("iuran/update", $params);

        } else {
            $response = json_encode(array(
                "status" => False,
                "message" => "Please check your connection, server can't be reached.",
                "result" => False
            ));
        }
        echo $response;
    }

    public function delete()
    {
        header("Content-type: application/json");

        $params = array(
            "id" => $this->input->get("id")
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
            $response = $this->my_api->get_response("iuran/delete", $params);

            // Local
            // $params = json_decode($response, TRUE)["result"];
            $api = $this->config->item("api", "esdm_local");
            $app_id = $this->config->item("app_id", "esdm_local");
            $app_token = $this->config->item("app_token", "esdm_local");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("iuran/delete", $params);

        } else {
            $response = json_encode(array(
                "status" => False,
                "message" => "Please check your connection, server can't be reached.",
                "result" => False
            ));
        }
        echo $response;
    }
}
