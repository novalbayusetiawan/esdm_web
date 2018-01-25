<?php if ( ! defined('BASEPATH')) Exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

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
        "assets/plugins/bootstrap-select/bootstrap-select.min.css",
        "assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css",
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
        "assets/plugins/bootstrap-select/bootstrap-select.min.js",
        "assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js",
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

        // BEGIN-REGIONS
        // Local
        $api = $this->config->item("api", "esdm_local");
        $app_id = $this->config->item("app_id", "esdm_local");
        $app_token = $this->config->item("app_token", "esdm_local");
        $this->my_api->set_api($api);
        $this->my_api->set_app_id($app_id);
        $this->my_api->set_app_token($app_token);

        $response = $this->my_api->get_response("user/get_regions");
        $array = json_decode($response, TRUE);
        $result = $array["result"];
        $regions = array();
        foreach ($result as $row) {
            $regions[$row["region"]] = $row["region"];
        }
        $data["regions"] = $regions;

        // $data["filter"]["advanced"] = True;
        $data["filter"] = $this->input->get();
		// print_r($data["filter"]);
		// exit();
        // END-REGIONS

        $data["title"][] = "Perusahaan";
        $data["title"][] = "Index";
        $data["view"] = "perusahaan/index";

        $this->load->view("backend_template", $data);
    }

    public function change_index()
    {
        header("Content-type: text/html");

        // $data["filter"]["advanced"] = 1;
        $data["filter"] = $this->input->get("filter");
        $data["title"][] = "Perusahaan";
        $data["title"][] = "Index";
        $data["view"] = "perusahaan/change_index";

        $this->load->view("backend_template", $data);
    }

    public function insert_form()
    {
        header("Content-type: text/html");


        // Local
        // $api = $this->config->item("api", "esdm_local");
        // $app_id = $this->config->item("app_id", "esdm_local");
        // $app_token = $this->config->item("app_token", "esdm_local");
        // $this->my_api->set_api($api);
        // $this->my_api->set_app_id($app_id);
        // $this->my_api->set_app_token($app_token);
        // $response = $this->my_api->get_response("perusahaan/get_one", array(
            // "id" => $this->input->get("id")
        // ));
        // $data["nama_perusahaan"] = json_decode($response, TRUE)["result"]["nama_perusahaan"];
        // $data["id_perusahaan"] = json_decode($response, TRUE)["result"]["id"];

        $data["id"] = $this->input->get("id");

        $data["title"][] = "Perusahaan";
        $data["title"][] = "Add";
        $data["view"] = "perusahaan/insert_form";

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
        $data["id_perusahaan"] = json_decode($response, TRUE)["result"]["id"];

        $data["id"] = $this->input->get("id");

        $data["title"][] = "Perusahaan";
        $data["title"][] = "Edit";
        $data["view"] = "perusahaan/change_form";

        $this->load->view("backend_template", $data);
    }

    public function dt_show()
    {
        header("Content-type: application/json");

		$search = $this->input->get("nama_perusahaan")? $this->input->get("nama_perusahaan") : $_POST["search"]["value"];
		$acc_level = $this->input->get("nama_wilayah")? strtolower($this->input->get("nama_wilayah")) : $this->session->userdata("acc_level");
		$advanced_filter = is_array($this->input->get("advanced_filter"))? $this->input->get("advanced_filter") : array();
		// print_r($search);

        $params = array(
            "page" => (((int) $_POST["start"]) + (int) $_POST["length"]) / (int) $_POST["length"],
            "perpage" => (int) $_POST["length"],
            "order_by" => $_POST["columns"][(int) ($_POST["order"][0]["column"])]["data"]."+".$_POST["order"][0]["dir"],
            "search" => $search,
            "acc_level" => $acc_level,
            "filter" => $this->input->get("filter"),
            "advanced_filter" => $advanced_filter
        );
		// echo "a";
		// exit();

        // Local
        $api = $this->config->item("api", "esdm_local");
        $app_id = $this->config->item("app_id", "esdm_local");
        $app_token = $this->config->item("app_token", "esdm_local");
        $this->my_api->set_api($api);
        $this->my_api->set_app_id($app_id);
        $this->my_api->set_app_token($app_token);

        $response = $this->my_api->get_response("perusahaan/dt_show", $params);
        // echo $this->my_api->get_last_api();
        $data = json_decode($response, True);
		// exit();
        $result = $data["result"];

        for ($i = 0; $i < count($result["data"]); $i++){
            $id = $result["data"][$i]["id"];
            $result["data"][$i]["open"] = "<a href=\"".base_url("perusahaan/change_form?id=$id")."\" class=\"btn btn-primary btn-xs\" role=\"button\" title=\"Edit\"><i class=\"fa fa-pencil\"></i> Edit</a> <a href=\"".base_url("perusahaan/delete?id=$id")."\" onclick=\"return confirm('Apakah anda yakin ingin menghapus data?');\" class=\"btn btn-danger btn-xs\" role=\"button\" title=\"Hapus\"><i class=\"fa fa-times\"></i></a>";
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

        $response = $this->my_api->get_response("perusahaan/get_one", $params);
        echo $response;
    }

    public function insert()
    {
        header("Content-type: application/json");

        $params = array(
            "nama_perusahaan" => $this->input->post("nama_perusahaan"),
            "status" => $this->input->post("status"),
            "nama_dirut" => $this->input->post("nama_dirut"),
            "nama_saham" => $this->input->post("nama_saham"),
            "alamat_kantor" => $this->input->post("alamat_kantor"),
            "telp_perusahaan" => $this->input->post("telp_perusahaan"),
            "telp_dirut" => $this->input->post("telp_dirut"),
            "telp_saham" => $this->input->post("telp_saham"),
            "email_kantor" => $this->input->post("email_kantor"),
            "email_dirut" => $this->input->post("email_dirut"),
            "email_saham" => $this->input->post("email_saham"),
            "nama_ktt" => $this->input->post("nama_ktt"),
            "hp_ktt" => $this->input->post("hp_ktt"),
            "email_ktt" => $this->input->post("email_ktt"),
            "sk_ktt" => $this->input->post("sk_ktt"),
            "ktt_terbit" => $this->input->post("ktt_terbit"),
            "ktt_berakhir" => $this->input->post("ktt_berakhir"),
            "status_cnc" => $this->input->post("status_cnc"),
            "tahap_cnc" => $this->input->post("tahap_cnc"),
            "komoditas" => $this->input->post("komoditas"),
            "komoditas_sama" => $this->input->post("komoditas_sama"),
            "wadm" => $this->input->post("wadm"),
            "wpa" => $this->input->post("wpa"),
            "kfg" => $this->input->post("kfg"),
            // "kfg" => '',
            "kfi1" => $this->input->post("kfi1"),
            // "kfi1" => '',
            "kfi2" => $this->input->post("kfi2"),
            // "kfi2" => '',
            "kelurahan" => $this->input->post("kelurahan"),
            "kecamatan" => $this->input->post("kecamatan"),
            "kabupaten" => $this->input->post("kabupaten"),
            "propinsi" => $this->input->post("propinsi"),
            "no_jamtup" => $this->input->post("no_jamtup"),
            "tereka" => $this->input->post("tereka"),
            "terunjuk" => $this->input->post("terunjuk"),
            "terukur" => $this->input->post("terukur"),
            "terkira" => $this->input->post("terkira"),
            "terbukti" => $this->input->post("terbukti"),
            "jenis_penjualan" => $this->input->post("jenis_penjualan"),
            "jumlah_penjualan" => $this->input->post("jumlah_penjualan"),
            "moisture" => $this->input->post("moisture"),
            "sulphur" => $this->input->post("sulphur"),
            "ash" => $this->input->post("ash"),
            "calori" => $this->input->post("calori"),
            "ket" => $this->input->post("ket"),
            "no_tinjau" => $this->input->post("no_tinjau"),
            "luas_tinjau" => $this->input->post("luas_tinjau"),
            "thn_tinjau1" => $this->input->post("thn_tinjau1"),
            "thn_tinjau2" => $this->input->post("thn_tinjau2"),
            "no_pu" => $this->input->post("no_pu"),
            "luas_pu" => $this->input->post("luas_pu"),
            "thn_pu1" => $this->input->post("thn_pu1"),
            "thn_pu2" => $this->input->post("thn_pu2"),
            "no_kpeks" => $this->input->post("no_kpeks"),
            "luas_kpeks" => $this->input->post("luas_kpeks"),
            "thn_kpeks1" => $this->input->post("thn_kpeks1"),
            "thn_kpeks2" => $this->input->post("thn_kpeks2"),
            "no_iupeks" => $this->input->post("no_iupeks"),
            "luas_iupeks" => $this->input->post("luas_iupeks"),
            "thn_iupeks1" => $this->input->post("thn_iupeks1"),
            "thn_iupeks2" => $this->input->post("thn_iupeks2"),
            "no_kpeksp" => $this->input->post("no_kpeksp"),
            "luas_kpeksp" => $this->input->post("luas_kpeksp"),
            "thn_kpeksp1" => $this->input->post("thn_kpeksp1"),
            "thn_kpeksp2" => $this->input->post("thn_kpeksp2"),
            "no_iupjual" => $this->input->post("no_iupjual"),
            "luas_iupjual" => $this->input->post("luas_iupjual"),
            "thn_iupjual1" => $this->input->post("thn_iupjual1"),
            "thn_iupjual2" => $this->input->post("thn_iupjual2"),
            "no_iupop" => $this->input->post("no_iupop"),
            "luas_iupop" => $this->input->post("luas_iupop"),
            "thn_iupop1" => $this->input->post("thn_iupop1"),
            "thn_iupop2" => $this->input->post("thn_iupop2"),
            "no_akta" => $this->input->post("no_akta"),
            "no_npwp" => $this->input->post("no_npwp"),
            "no_domisili" => $this->input->post("no_domisili"),
            "no_tdper" => $this->input->post("no_tdper"),
            "no_pajak" => $this->input->post("no_pajak"),
            "no_kenapajak" => $this->input->post("no_kenapajak"),
            "no_dagang" => $this->input->post("no_dagang"),
            "no_ho" => $this->input->post("no_ho"),
            "no_lingkungan" => $this->input->post("no_lingkungan"),
            "no_kelayakan" => $this->input->post("no_kelayakan"),
            "no_limbah" => $this->input->post("no_limbah"),
            "no_air" => $this->input->post("no_air"),
            "no_manfaatbbc" => $this->input->post("no_manfaatbbc"),
            "no_bbc" => $this->input->post("no_bbc"),
            "no_gudang" => $this->input->post("no_gudang"),
            "no_handak" => $this->input->post("no_handak"),
            "no_setling" => $this->input->post("no_setling"),
            "no_kawasan" => $this->input->post("no_kawasan"),
            "no_izinlj" => $this->input->post("no_izinlj"),
            "no_ujp" => $this->input->post("no_ujp"),
            "no_pelabuhan" => $this->input->post("no_pelabuhan"),
            "no_campur" => $this->input->post("no_campur"),
            "no_opkhusus" => $this->input->post("no_opkhusus"),
            "no_cnc" => $this->input->post("no_cnc"),
            "no_cabut" => $this->input->post("no_cabut"),
            "no_eksport" => $this->input->post("no_eksport"),
            "no_fs" => $this->input->post("no_fs"),
            "no_amdal" => $this->input->post("no_amdal"),
            "no_rr" => $this->input->post("no_rr"),
            "no_rp" => $this->input->post("no_rp"),
            "no_rkttl" => $this->input->post("no_rkttl"),
            "no_rkab" => $this->input->post("no_rkab"),
            "no_jamrekeks" => $this->input->post("no_jamrekeks"),
            "no_jamrekpro" => $this->input->post("no_jamrekpro"),
            "no_jaminankesungguhan" => $this->input->post("no_jaminankesungguhan"),
            "no_royalti" => $this->input->post("no_royalti"),
            "no_iuran" => $this->input->post("no_iuran")
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
            $response = $this->my_api->get_response("perusahaan/insert", $params);

            // Local
            // $params = json_decode($response, TRUE)["result"];
            $api = $this->config->item("api", "esdm_local");
            $app_id = $this->config->item("app_id", "esdm_local");
            $app_token = $this->config->item("app_token", "esdm_local");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("perusahaan/insert", $params);

        } else {
            $response = json_encode(array(
                "status" => False,
                "message" => "Please check your connection, server can't be reached.",
                "result" => False
            ));
        }
        echo $response;
        // header('location:'.base_url()."perusahaan/change_index");
    }

    public function update()
    {
        header("Content-type: application/json");

        $params = array(
            "id" => $this->input->post("id"),
            "nama_perusahaan" => $this->input->post("nama_perusahaan"),
            "status" => $this->input->post("status"),
            "nama_dirut" => $this->input->post("nama_dirut"),
            "nama_saham" => $this->input->post("nama_saham"),
            "alamat_kantor" => $this->input->post("alamat_kantor"),
            "telp_perusahaan" => $this->input->post("telp_perusahaan"),
            "telp_dirut" => $this->input->post("telp_dirut"),
            "telp_saham" => $this->input->post("telp_saham"),
            "email_kantor" => $this->input->post("email_kantor"),
            "email_dirut" => $this->input->post("email_dirut"),
            "email_saham" => $this->input->post("email_saham"),
            "nama_ktt" => $this->input->post("nama_ktt"),
            "hp_ktt" => $this->input->post("hp_ktt"),
            "email_ktt" => $this->input->post("email_ktt"),
            "sk_ktt" => $this->input->post("sk_ktt"),
            "ktt_terbit" => $this->input->post("ktt_terbit"),
            "ktt_berakhir" => $this->input->post("ktt_berakhir"),
            "status_cnc" => $this->input->post("status_cnc"),
            "tahap_cnc" => $this->input->post("tahap_cnc"),
            "komoditas" => $this->input->post("komoditas"),
            "komoditas_sama" => $this->input->post("komoditas_sama"),
            "wadm" => $this->input->post("wadm"),
            "wpa" => $this->input->post("wpa"),
            "kfg" => $this->input->post("kfg"),
            "kfi1" => $this->input->post("kfi1"),
            "kfi2" => $this->input->post("kfi2"),
            "kelurahan" => $this->input->post("kelurahan"),
            "kecamatan" => $this->input->post("kecamatan"),
            "kabupaten" => $this->input->post("kabupaten"),
            "propinsi" => $this->input->post("propinsi"),
            "no_jamtup" => $this->input->post("no_jamtup"),
            "tereka" => $this->input->post("tereka"),
            "terunjuk" => $this->input->post("terunjuk"),
            "terukur" => $this->input->post("terukur"),
            "terkira" => $this->input->post("terkira"),
            "terbukti" => $this->input->post("terbukti"),
            "jenis_penjualan" => $this->input->post("jenis_penjualan"),
            "jumlah_penjualan" => $this->input->post("jumlah_penjualan"),
            "moisture" => $this->input->post("moisture"),
            "sulphur" => $this->input->post("sulphur"),
            "ash" => $this->input->post("ash"),
            "calori" => $this->input->post("calori"),
            "ket" => $this->input->post("ket"),
            "no_tinjau" => $this->input->post("no_tinjau"),
            "luas_tinjau" => $this->input->post("luas_tinjau"),
            "thn_tinjau1" => $this->input->post("thn_tinjau1"),
            "thn_tinjau2" => $this->input->post("thn_tinjau2"),
            "no_pu" => $this->input->post("no_pu"),
            "luas_pu" => $this->input->post("luas_pu"),
            "thn_pu1" => $this->input->post("thn_pu1"),
            "thn_pu2" => $this->input->post("thn_pu2"),
            "no_kpeks" => $this->input->post("no_kpeks"),
            "luas_kpeks" => $this->input->post("luas_kpeks"),
            "thn_kpeks1" => $this->input->post("thn_kpeks1"),
            "thn_kpeks2" => $this->input->post("thn_kpeks2"),
            "no_iupeks" => $this->input->post("no_iupeks"),
            "luas_iupeks" => $this->input->post("luas_iupeks"),
            "thn_iupeks1" => $this->input->post("thn_iupeks1"),
            "thn_iupeks2" => $this->input->post("thn_iupeks2"),
            "no_kpeksp" => $this->input->post("no_kpeksp"),
            "luas_kpeksp" => $this->input->post("luas_kpeksp"),
            "thn_kpeksp1" => $this->input->post("thn_kpeksp1"),
            "thn_kpeksp2" => $this->input->post("thn_kpeksp2"),
            "no_iupjual" => $this->input->post("no_iupjual"),
            "luas_iupjual" => $this->input->post("luas_iupjual"),
            "thn_iupjual1" => $this->input->post("thn_iupjual1"),
            "thn_iupjual2" => $this->input->post("thn_iupjual2"),
            "no_iupop" => $this->input->post("no_iupop"),
            "luas_iupop" => $this->input->post("luas_iupop"),
            "thn_iupop1" => $this->input->post("thn_iupop1"),
            "thn_iupop2" => $this->input->post("thn_iupop2"),
            "no_akta" => $this->input->post("no_akta"),
            "no_npwp" => $this->input->post("no_npwp"),
            "no_domisili" => $this->input->post("no_domisili"),
            "no_tdper" => $this->input->post("no_tdper"),
            "no_pajak" => $this->input->post("no_pajak"),
            "no_kenapajak" => $this->input->post("no_kenapajak"),
            "no_dagang" => $this->input->post("no_dagang"),
            "no_ho" => $this->input->post("no_ho"),
            "no_lingkungan" => $this->input->post("no_lingkungan"),
            "no_kelayakan" => $this->input->post("no_kelayakan"),
            "no_limbah" => $this->input->post("no_limbah"),
            "no_air" => $this->input->post("no_air"),
            "no_manfaatbbc" => $this->input->post("no_manfaatbbc"),
            "no_bbc" => $this->input->post("no_bbc"),
            "no_gudang" => $this->input->post("no_gudang"),
            "no_handak" => $this->input->post("no_handak"),
            "no_setling" => $this->input->post("no_setling"),
            "no_kawasan" => $this->input->post("no_kawasan"),
            "no_izinlj" => $this->input->post("no_izinlj"),
            "no_ujp" => $this->input->post("no_ujp"),
            "no_pelabuhan" => $this->input->post("no_pelabuhan"),
            "no_campur" => $this->input->post("no_campur"),
            "no_opkhusus" => $this->input->post("no_opkhusus"),
            "no_cnc" => $this->input->post("no_cnc"),
            "no_cabut" => $this->input->post("no_cabut"),
            "no_eksport" => $this->input->post("no_eksport"),
            "no_fs" => $this->input->post("no_fs"),
            "no_amdal" => $this->input->post("no_amdal"),
            "no_rr" => $this->input->post("no_rr"),
            "no_rp" => $this->input->post("no_rp"),
            "no_rkttl" => $this->input->post("no_rkttl"),
            "no_rkab" => $this->input->post("no_rkab"),
            "no_jamrekeks" => $this->input->post("no_jamrekeks"),
            "no_jamrekpro" => $this->input->post("no_jamrekpro"),
            "no_jaminankesungguhan" => $this->input->post("no_jaminankesungguhan"),
            "no_royalti" => $this->input->post("no_royalti"),
            "no_iuran" => $this->input->post("no_iuran")
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
            $response = $this->my_api->get_response("perusahaan/update", $params);

            // Local
            // $params = json_decode($response, TRUE)["result"];
            $api = $this->config->item("api", "esdm_local");
            $app_id = $this->config->item("app_id", "esdm_local");
            $app_token = $this->config->item("app_token", "esdm_local");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("perusahaan/update", $params);

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
            $response = $this->my_api->get_response("perusahaan/delete", $params);

            // Local
            // $params = json_decode($response, TRUE)["result"];
            $api = $this->config->item("api", "esdm_local");
            $app_id = $this->config->item("app_id", "esdm_local");
            $app_token = $this->config->item("app_token", "esdm_local");
            $this->my_api->set_api($api);
            $this->my_api->set_app_id($app_id);
            $this->my_api->set_app_token($app_token);
            $response = $this->my_api->get_response("perusahaan/delete", $params);

        } else {
            $response = json_encode(array(
                "status" => False,
                "message" => "Please check your connection, server can't be reached.",
                "result" => False
            ));
        }
        // echo $response;
        header('location:'.base_url()."perusahaan/change_index");
    }
}
