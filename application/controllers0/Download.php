<?php if ( ! defined('BASEPATH')) Exit('No direct script access allowed');

class Download extends CI_Controller {

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
        $this->load->library("zip");
        $this->load->helper("file");
        $this->my_auth->run();
    }

    public function generate_excel()
    {
        // Set Error Level
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        ini_set('max_execution_time', 300);
        date_default_timezone_set('Asia/Jakarta');
        
        
        /** Include PHPExcel */
        require_once "PHPExcel-1.8/Classes/PHPExcel.php";
        
        $filter = $this->input->get("filter");
        $folder = $this->session->userdata("name");
        $acc_level = $this->session->userdata("acc_level");
        
        $params = array(
            "acc_level" => $acc_level,
            "filter" => $filter
        );
        
        // Local
        $api = $this->config->item("api", "esdm_local");
        $app_id = $this->config->item("app_id", "esdm_local");
        $app_token = $this->config->item("app_token", "esdm_local");
        $this->my_api->set_api($api);
        $this->my_api->set_app_id($app_id);
        $this->my_api->set_app_token($app_token);
        
        $response = $this->my_api->get_response("perusahaan/get_data", $params);
        $result = json_decode($response, TRUE)["result"];
        
        if (!is_dir("reports/{$folder}"))
            mkdir("reports/{$folder}", 0777);
        if (!is_dir("reports/{$folder}/{$filter}"))
            mkdir("reports/{$folder}/{$filter}", 0777);
        
        delete_files("reports/{$folder}/{$filter}", true);
        
        foreach($result as $row) 
        {
            $filename = preg_replace("/[^a-z\s\d]/i", "", $row["nama_perusahaan"]);
            
            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();
            
            // Style
            $section_style = array(
                'font' => array(
                    'size' => 14,
                    'bold' => true
                )
            );
            $text_bold = array(
                'font' => array(
                    'bold' => true
                )
            );
            $text_center = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                )
            );
            $cell_border = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );

            // Set document properties
            $objPHPExcel->getProperties()->setCreator($this->session->userdata("name"))
                 ->setLastModifiedBy($this->session->userdata("name"))
                 ->setTitle("Office 2007 XLSX Test Document")
                 ->setSubject("Office 2007 XLSX Test Document")
                 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                 ->setKeywords("office 2007 openxml php")
                 ->setCategory("Result file");

            $objPHPExcel->setActiveSheetIndex(0);
            $activeSheet = $objPHPExcel->getActiveSheet();
            
            $activeSheet->getColumnDimension('A')->setWidth(6);
            $activeSheet->getColumnDimension('B')->setWidth(5);
            $activeSheet->getColumnDimension('C')->setWidth(5);
            $activeSheet->getColumnDimension('D')->setWidth(22);
            $activeSheet->getColumnDimension('E')->setWidth(18);
            $activeSheet->getColumnDimension('F')->setWidth(22);
            $activeSheet->getColumnDimension('G')->setWidth(22);
            $activeSheet->getColumnDimension('H')->setWidth(24);
            $activeSheet->getColumnDimension('I')->setWidth(22);
            $activeSheet->getColumnDimension('J')->setWidth(22);
            $activeSheet->getColumnDimension('K')->setWidth(22);

            // Section Title      
            $activeSheet->getStyle("A1")->applyFromArray($section_style);
            $activeSheet->setCellValue('A1', '1');
            $activeSheet->getStyle("B1")->applyFromArray($section_style);
            $activeSheet->setCellValue('B1', 'LEMBAR EVALUASI KRITERIA ADMINSTRATIF IUP MINERAL / BATUBARA');
            $activeSheet->getStyle("A24")->applyFromArray($section_style);
            $activeSheet->setCellValue('A24', '2');
            $activeSheet->getStyle("B24")->applyFromArray($section_style);
            $activeSheet->setCellValue('B24', 'LEMBAR EVALUASI ASPEK KEWILAYAHAN');
            $activeSheet->getStyle("A42")->applyFromArray($section_style);
            $activeSheet->setCellValue('A42', '3');
            $activeSheet->getStyle("B42")->applyFromArray($section_style);
            $activeSheet->setCellValue('B42', 'LEMBAR EVALUASI PERSYARATAN TEKNIS DAN LINGKUNGAN');
            $activeSheet->getStyle("A59")->applyFromArray($section_style);
            $activeSheet->setCellValue('A59', '4');
            $activeSheet->getStyle("B59")->applyFromArray($section_style);
            $activeSheet->setCellValue('B59', 'LEMBAR EVALUASI FINANSIAL');
            // Section Title
            
            // Section 1
            // Info
            $activeSheet->setCellValue('B3', 'I.');
            $activeSheet->getStyle("E3")->applyFromArray($text_center);
            $activeSheet->setCellValue('C3', 'NAMA PERUSAHAAN');
            $activeSheet->setCellValue('E3', ':');
            $activeSheet->setCellValue('F3', $row["nama_perusahaan"]);
            
            $activeSheet->setCellValue('B4', 'II.');
            $activeSheet->setCellValue('C4', 'KOMODITAS');
            $activeSheet->getStyle("E4")->applyFromArray($text_center);
            $activeSheet->setCellValue('E4', ':');
            $activeSheet->setCellValue('F4', $row["komoditas"]);
            
            $activeSheet->setCellValue('B5', 'III.');
            $activeSheet->setCellValue('C5', 'LOKASI');
            $activeSheet->getStyle("C6")->applyFromArray($text_center);
            $activeSheet->setCellValue('C6', '-');
            $activeSheet->getStyle("C7")->applyFromArray($text_center);
            $activeSheet->setCellValue('C7', '-');
            $activeSheet->getStyle("C8")->applyFromArray($text_center);
            $activeSheet->setCellValue('C8', '-');
            $activeSheet->setCellValue('D6', 'KECAMATAN');
            $activeSheet->setCellValue('D7', 'KABUPATEN/KOTA');
            $activeSheet->setCellValue('D8', 'PROVINSI');
            $activeSheet->getStyle("E6")->applyFromArray($text_center);
            $activeSheet->setCellValue('E6', ':');
            $activeSheet->getStyle("E7")->applyFromArray($text_center);
            $activeSheet->setCellValue('E7', ':');
            $activeSheet->getStyle("E8")->applyFromArray($text_center);
            $activeSheet->setCellValue('E8', ':');
            $activeSheet->setCellValue('F6', $row["kecamatan"]);
            $activeSheet->setCellValue('F7', $row["kabupaten"]);
            $activeSheet->setCellValue('F8', $row["propinsi"]);
            
            $activeSheet->setCellValue('B9', 'IV.');
            $activeSheet->setCellValue('C9', 'STATUS PERUSAHAAN');
            $activeSheet->getStyle("C10")->applyFromArray($text_center);
            $activeSheet->setCellValue('C10', '-');
            $activeSheet->setCellValue('D10', 'TERBUKA (TBK)/TIDAK');
            $activeSheet->getStyle("E10")->applyFromArray($text_center);
            $activeSheet->setCellValue('E10', ':');
            $activeSheet->setCellValue('F10', $row["status"]);
            
            $activeSheet->setCellValue('B11', 'V.');
            $activeSheet->setCellValue('C11', 'STATUS IUP TERAKHIR');
            $activeSheet->getStyle("E11")->applyFromArray($text_center);
            $activeSheet->setCellValue('E11', ':');
            $activeSheet->setCellValue('F11', "PERPANJANGAN / PENINGKATAN");
            // Info
            
            // Table
            $activeSheet->getStyle('B13:I14')->applyFromArray($text_center);
            $activeSheet->getStyle('B13:I21')->applyFromArray($cell_border);
            $activeSheet->getStyle('B13:I14')->applyFromArray($text_bold);
            $activeSheet->getStyle('B15:B21')->applyFromArray($text_bold);
            $activeSheet->mergeCells('B13:D14');
            $activeSheet->setCellValue('B13', 'TAHAPAN KEGIATAN');
            $activeSheet->mergeCells('E13:H13');
            $activeSheet->setCellValue('E13', 'SURAT KEPUTUSAN');
            $activeSheet->mergeCells('I13:I14');
            $activeSheet->setCellValue('I13', 'LUAS WILAYAH (HA)');
            $activeSheet->mergeCells('E14:F14');
            $activeSheet->setCellValue('E14', 'NO');
            $activeSheet->setCellValue('G14', 'TANGGAL SK');
            $activeSheet->setCellValue('H14', 'TANGGAL BERAKHIR SK');

            $activeSheet->mergeCells('B15:D15');
            $activeSheet->setCellValue('B15', 'IZIN PENINJAUAN');
            $activeSheet->mergeCells('B16:D16');
            $activeSheet->setCellValue('B16', 'KP PENYELIDIKAN UMUM');
            $activeSheet->mergeCells('B17:D17');
            $activeSheet->setCellValue('B17', 'KP EKSPLORASI');
            $activeSheet->mergeCells('B18:D18');
            $activeSheet->setCellValue('B18', 'IUP EKSPLORASI');
            $activeSheet->mergeCells('B19:D19');
            $activeSheet->setCellValue('B19', 'KP EKSPLOITASI');
            $activeSheet->mergeCells('B20:D20');
            $activeSheet->setCellValue('B20', 'KP PENGANGKUTAN/PENJUALAN');
            $activeSheet->mergeCells('B21:D21');
            $activeSheet->setCellValue('B21', 'IUP OPERASI PRODUKSI');
            
            $activeSheet->mergeCells('E15:F15');
            $activeSheet->setCellValue('E15', $row["no_tinjau"]);
            $activeSheet->mergeCells('E16:F16');
            $activeSheet->setCellValue('E16', $row["no_pu"]);
            $activeSheet->mergeCells('E17:F17');
            $activeSheet->setCellValue('E17', $row["no_kpeks"]);
            $activeSheet->mergeCells('E18:F18');
            $activeSheet->setCellValue('E18', $row["no_iupeks"]);
            $activeSheet->mergeCells('E19:F19');
            $activeSheet->setCellValue('E19', $row["no_kpeksp"]);
            $activeSheet->mergeCells('E20:F20');
            $activeSheet->setCellValue('E20', $row["no_iupjual"]);
            $activeSheet->mergeCells('E21:F21');
            $activeSheet->setCellValue('E21', $row["no_iupop"]);
            
            $activeSheet->setCellValue('G15', $row["thn_tinjau1"]);
            $activeSheet->setCellValue('G16', $row["thn_pu1"]);
            $activeSheet->setCellValue('G17', $row["thn_kpeks1"]);
            $activeSheet->setCellValue('G18', $row["thn_iupeks1"]);
            $activeSheet->setCellValue('G19', $row["thn_kpeksp1"]);
            $activeSheet->setCellValue('G20', $row["thn_iupjual1"]);
            $activeSheet->setCellValue('G21', $row["thn_iupop1"]);
            $activeSheet->setCellValue('H15', $row["thn_tinjau2"]);
            $activeSheet->setCellValue('H16', $row["thn_pu2"]);
            $activeSheet->setCellValue('H17', $row["thn_kpeks2"]);
            $activeSheet->setCellValue('H18', $row["thn_iupeks2"]);
            $activeSheet->setCellValue('H19', $row["thn_kpeksp2"]);
            $activeSheet->setCellValue('H20', $row["thn_iupjual2"]);
            $activeSheet->setCellValue('H21', $row["thn_iupop2"]);
            $activeSheet->setCellValue('I15', $row["luas_tinjau"]);
            $activeSheet->setCellValue('I16', $row["luas_pu"]);
            $activeSheet->setCellValue('I17', $row["luas_kpeks"]);
            $activeSheet->setCellValue('I18', $row["luas_iupeks"]);
            $activeSheet->setCellValue('I19', $row["luas_kpeksp"]);
            $activeSheet->setCellValue('I20', $row["luas_iupjual"]);
            $activeSheet->setCellValue('I21', $row["luas_iupop"]);
            // Table
            // Section 1
            
            
            // Section 2
            // Hidden
            $activeSheet->getRowDimension(26)->setVisible(False);
            $activeSheet->setCellValue('B26', 'I.');
            $activeSheet->mergeCells('C26:D26');
            $activeSheet->setCellValue('C26', 'NAMA PERUSAHAAN');
            $activeSheet->getStyle("E26")->applyFromArray($text_center);
            $activeSheet->setCellValue('E26', ':');
            $activeSheet->setCellValue('F26', $row["nama_perusahaan"]);
            $activeSheet->getRowDimension(27)->setVisible(False);
            $activeSheet->setCellValue('B27', 'II.');
            $activeSheet->mergeCells('C27:D27');
            $activeSheet->setCellValue('C27', 'NO SK IUP');
            $activeSheet->getStyle("E27")->applyFromArray($text_center);
            $activeSheet->setCellValue('E27', ':');
            $activeSheet->getRowDimension(28)->setVisible(False);
            $activeSheet->setCellValue('B28', 'III.');
            $activeSheet->mergeCells('C28:D28');
            $activeSheet->setCellValue('C28', 'KOMODITAS');
            $activeSheet->getStyle("E28")->applyFromArray($text_center);
            $activeSheet->setCellValue('E28', ':');
            $activeSheet->setCellValue('F28', $row["komoditas"]);
            $activeSheet->getRowDimension(29)->setVisible(False);
            $activeSheet->setCellValue('B29', 'IV.');
            $activeSheet->mergeCells('C29:D29');
            $activeSheet->setCellValue('C29', 'TAHAPAN KEGIATAN');
            $activeSheet->getStyle("E29")->applyFromArray($text_center);
            $activeSheet->setCellValue('E29', ':');
            $activeSheet->getRowDimension(30)->setVisible(False);
            $activeSheet->setCellValue('B30', 'V.');
            $activeSheet->mergeCells('C30:D30');
            $activeSheet->setCellValue('C30', 'LUAS (HA)');
            $activeSheet->getStyle("E30")->applyFromArray($text_center);
            $activeSheet->setCellValue('E30', ':');
            // Hidden
            
            // Table
            $activeSheet->getStyle('B32:K33')->applyFromArray($text_center);
            $activeSheet->getStyle('B32:K39')->applyFromArray($cell_border);
            $activeSheet->getStyle('B32:K33')->applyFromArray($text_bold);
            
            $activeSheet->mergeCells('B32:D33');
            $activeSheet->setCellValue('B32', 'ASPEK WILAYAH');
            $activeSheet->mergeCells('E32:G33');
            $activeSheet->setCellValue('E32', 'PENILAIAN');
            $activeSheet->mergeCells('H32:H33');
            $activeSheet->setCellValue('H32', 'HASIL EVALUASI');
            $activeSheet->mergeCells('I32:K33');
            $activeSheet->setCellValue('I32', 'KETERANGAN TINDAK LANJUT');
            
            $activeSheet->getStyle('B34:E39')->applyFromArray($text_center);
            
            $activeSheet->mergeCells('B34:D36');
            $activeSheet->setCellValue('B34', 'TUMPANG TINDIH');
            
            $activeSheet->setCellValue('E34', 'a.');
            $activeSheet->mergeCells('F34:G34');
            $activeSheet->setCellValue('F34', 'Sama Komoditas');
            $activeSheet->setCellValue('H34', $row["komoditas_sama"]);
            $activeSheet->mergeCells('I34:K34');
            $activeSheet->setCellValue('I34', 'Penciutan WIUP/Penetapan First Come First Serve dan Pencabutan / Penyelesaian lain');
            
            $activeSheet->setCellValue('E35', 'b.');
            $activeSheet->mergeCells('F35:G35');
            $activeSheet->setCellValue('F35', 'Wilayah administrasi kota / kabupaten atau provinsi lain');
            $activeSheet->setCellValue('H35', $row["wadm"]);
            $activeSheet->mergeCells('I35:K35');
            $activeSheet->setCellValue('I35', 'Penyesuaian IUP / Penciutan WIUP / Penerapan First Come First Serve dan Penciutan / Penyelesaian lain');
            
            $activeSheet->setCellValue('E36', 'c.');
            $activeSheet->mergeCells('F36:G36');
            $activeSheet->setCellValue('F36', 'Wilayah Pencadangan Negara (WPN)');
            $activeSheet->setCellValue('H36', $row["wpa"]);
            $activeSheet->mergeCells('I36:K36');
            $activeSheet->setCellValue('I36', 'Penciutan WIUP / Pencabutan');
            
            $activeSheet->mergeCells('B37:D39');
            $activeSheet->setCellValue('B37', 'KOORDINATOR BLOK IUP');
            
            $activeSheet->setCellValue('E37', 'a.');
            $activeSheet->mergeCells('F37:G37');
            $activeSheet->setCellValue('F37', 'Koordinat dalam format geogafis sejajar garis lintang dan bujur');
            $activeSheet->setCellValue('H37', $row["kfg"]);
            $activeSheet->mergeCells('I37:K37');
            $activeSheet->setCellValue('I37', 'Perubahan Koordinat SK IUP');
            
            $activeSheet->setCellValue('E38', 'b.');
            $activeSheet->mergeCells('F38:G38');
            $activeSheet->setCellValue('F38', 'Koordinat IUP Eksplorasi sesuai dengan koordinat pencadangan');
            $activeSheet->setCellValue('H38', $row["kfi1"]);
            $activeSheet->mergeCells('I38:K38');
            $activeSheet->setCellValue('I38', 'Perubahan Koordinat SK IUP / Pencabutan IUP');
            
            $activeSheet->setCellValue('E39', 'c.');
            $activeSheet->mergeCells('F39:G39');
            $activeSheet->setCellValue('F39', 'Koordinat IUP Operasi Produksi sesuai dengan koordinat IUP Eksplorasi');
            $activeSheet->setCellValue('H39', $row["kfi2"]);
            $activeSheet->mergeCells('I39:K39');
            $activeSheet->setCellValue('I39', 'Revisi Koordinat SK IUP / Pencabutan IUP');
            // Table
            // Section 2
            
            
            // Section 3
            // Hidden
            $activeSheet->getRowDimension(44)->setVisible(False);
            $activeSheet->setCellValue('B44', 'I.');
            $activeSheet->mergeCells('C44:D44');
            $activeSheet->setCellValue('C44', 'NAMA PERUSAHAAN');
            $activeSheet->getStyle("E44")->applyFromArray($text_center);
            $activeSheet->setCellValue('E44', ':');
            $activeSheet->setCellValue('F44', $row["nama_perusahaan"]);
            $activeSheet->getRowDimension(45)->setVisible(False);
            $activeSheet->setCellValue('B45', 'II.');
            $activeSheet->mergeCells('C45:D45');
            $activeSheet->setCellValue('C45', 'NO SK IUP');
            $activeSheet->getStyle("E45")->applyFromArray($text_center);
            $activeSheet->setCellValue('E45', ':');
            $activeSheet->getRowDimension(46)->setVisible(False);
            $activeSheet->setCellValue('B46', 'III.');
            $activeSheet->mergeCells('C46:D46');
            $activeSheet->setCellValue('C46', 'KOMODITAS');
            $activeSheet->getStyle("E46")->applyFromArray($text_center);
            $activeSheet->setCellValue('E46', ':');
            $activeSheet->setCellValue('F46', $row["komoditas"]);
            $activeSheet->getRowDimension(47)->setVisible(False);
            $activeSheet->setCellValue('B47', 'IV.');
            $activeSheet->mergeCells('C47:D47');
            $activeSheet->setCellValue('C47', 'TAHAPAN KEGIATAN');
            $activeSheet->getStyle("E47")->applyFromArray($text_center);
            $activeSheet->setCellValue('E47', ':');
            $activeSheet->getRowDimension(48)->setVisible(False);
            $activeSheet->setCellValue('B48', 'V.');
            $activeSheet->mergeCells('C48:D48');
            $activeSheet->setCellValue('C48', 'LUAS (HA)');
            $activeSheet->getStyle("E48")->applyFromArray($text_center);
            $activeSheet->setCellValue('E48', ':');
            // Hidden
            
            // Table
            $activeSheet->getStyle('B50:H51')->applyFromArray($text_center);
            $activeSheet->getStyle('B50:H57')->applyFromArray($cell_border);
            $activeSheet->getStyle('B50:H51')->applyFromArray($text_bold);
            
            $activeSheet->mergeCells('B50:E51');
            $activeSheet->setCellValue('B50', 'DOKUMEN');
            $activeSheet->mergeCells('F50:G51');
            $activeSheet->setCellValue('F50', 'NOMOR');
            $activeSheet->mergeCells('H50:H51');
            $activeSheet->setCellValue('H50', 'HASIL PEMERIKSAAN');
            
            
            $activeSheet->mergeCells('B52:E52');
            $activeSheet->setCellValue('B52', 'Dokumen FS');
            $activeSheet->mergeCells('F52:G52');
            $activeSheet->setCellValue('F52', $row["no_fs"]);
            $activeSheet->setCellValue('H52', 'Tidak');
            
            $activeSheet->mergeCells('B53:E53');
            $activeSheet->setCellValue('B53', 'Dokumen Amdal');
            $activeSheet->mergeCells('F53:G53');
            $activeSheet->setCellValue('F53', $row["no_amdal"]);
            $activeSheet->setCellValue('H53', 'Tidak');
            
            $activeSheet->mergeCells('B54:E54');
            $activeSheet->setCellValue('B54', 'Dokumen RR');
            $activeSheet->mergeCells('F54:G54');
            $activeSheet->setCellValue('F54', $row["no_rr"]);
            $activeSheet->setCellValue('H54', 'Tidak');
            
            $activeSheet->mergeCells('B55:E55');
            $activeSheet->setCellValue('B55', 'Dokumen RPT');
            $activeSheet->mergeCells('F55:G55');
            $activeSheet->setCellValue('F55', $row["no_rp"]);
            $activeSheet->setCellValue('H55', 'Tidak');
            
            $activeSheet->mergeCells('B56:E56');
            $activeSheet->setCellValue('B56', 'Dokumen RKTTL');
            $activeSheet->mergeCells('F56:G56');
            $activeSheet->setCellValue('F56', $row["no_rkttl"]);
            $activeSheet->setCellValue('H56', 'Tidak');
            
            $activeSheet->mergeCells('B57:E57');
            $activeSheet->setCellValue('B57', 'Dokumen RKAB');
            $activeSheet->mergeCells('F57:G57');
            $activeSheet->setCellValue('F57', $row["no_rkab"]);
            $activeSheet->setCellValue('H57', 'Tidak');
            // Table
            // Section 3
            
            
            // Section 4
            // Hidden
            $activeSheet->getRowDimension(61)->setVisible(False);
            $activeSheet->setCellValue('B61', 'I.');
            $activeSheet->mergeCells('C61:D61');
            $activeSheet->setCellValue('C61', 'NAMA PERUSAHAAN');
            $activeSheet->getStyle("E61")->applyFromArray($text_center);
            $activeSheet->setCellValue('E61', ':');
            $activeSheet->setCellValue('F61', $row["nama_perusahaan"]);
            $activeSheet->getRowDimension(62)->setVisible(False);
            $activeSheet->setCellValue('B62', 'II.');
            $activeSheet->mergeCells('C62:D62');
            $activeSheet->setCellValue('C62', 'NO SK IUP');
            $activeSheet->getStyle("E62")->applyFromArray($text_center);
            $activeSheet->setCellValue('E62', ':');
            $activeSheet->getRowDimension(63)->setVisible(False);
            $activeSheet->setCellValue('B63', 'III.');
            $activeSheet->mergeCells('C63:D63');
            $activeSheet->setCellValue('C63', 'KOMODITAS');
            $activeSheet->getStyle("E63")->applyFromArray($text_center);
            $activeSheet->setCellValue('E63', ':');
            $activeSheet->setCellValue('F63', $row["komoditas"]);
            $activeSheet->getRowDimension(64)->setVisible(False);
            $activeSheet->setCellValue('B64', 'IV.');
            $activeSheet->mergeCells('C64:D64');
            $activeSheet->setCellValue('C64', 'TAHAPAN KEGIATAN');
            $activeSheet->getStyle("E64")->applyFromArray($text_center);
            $activeSheet->setCellValue('E64', ':');
            $activeSheet->getRowDimension(65)->setVisible(False);
            $activeSheet->setCellValue('B65', 'V.');
            $activeSheet->mergeCells('C65:D65');
            $activeSheet->setCellValue('C65', 'LUAS (HA)');
            $activeSheet->getStyle("E65")->applyFromArray($text_center);
            $activeSheet->setCellValue('E65', ':');
            
            $start = 68;
            
            foreach ($row["jaminan"] as $key => $value){
                if ($key == "jamrek_eks") {
                    $section_title = "Jaminan Reklamasi Tahap Eksplorasi";
                }
                elseif ($key == "jamrek_pro") {
                    $section_title = "Jaminan Reklamasi Tahap Produksi";
                }
                elseif ($key == "jamtup") {
                    $section_title = "Jaminan Pasca Tambang";
                }
                elseif ($key == "jamkes") {
                    $section_title = "Jaminan Kesungguhan Eksplorasi";
                }
                elseif ($key == "iuran") {
                    $section_title = "Iuran Pembayaran Tetap";
                }
                elseif ($key == "royalti") {
                    $section_title = "Royalti";
                }
                $activeSheet->mergeCells("C{$start}:K{$start}");
                $activeSheet->getStyle("C{$start}:K{$start}")->applyFromArray($text_center);
                $activeSheet->getStyle("C{$start}:K{$start}")->applyFromArray($text_bold);
                $activeSheet->getStyle("C{$start}:K{$start}")->applyFromArray($cell_border);
                $activeSheet->setCellValueByColumnAndRow(2, $start, $section_title);
                $start = $start+1;
                
                $activeSheet->getStyle("C{$start}:K{$start}")->applyFromArray($cell_border);
                $activeSheet->setCellValueByColumnAndRow(2, $start, "No");
                $activeSheet->setCellValueByColumnAndRow(3, $start, "Tahun Prajamrek");
                $activeSheet->setCellValueByColumnAndRow(4, $start, "Besaran Rupiah");
                $activeSheet->setCellValueByColumnAndRow(5, $start, "Besaran Dollar");
                $activeSheet->setCellValueByColumnAndRow(6, $start, "Tahun Realisasi");
                $activeSheet->setCellValueByColumnAndRow(7, $start, "Besaran Rupiah");
                $activeSheet->setCellValueByColumnAndRow(8, $start, "Besaran Dollar");
                $activeSheet->setCellValueByColumnAndRow(9, $start, "Jenis Jaminan");
                $activeSheet->setCellValueByColumnAndRow(10, $start, "Bank");
                $start = $start+1;
                
                $no = 1;
                foreach($value as $detail){
                    $activeSheet->getStyle("C{$start}:K{$start}")->applyFromArray($cell_border);
                    if ($key == "jamtup"){
                        $activeSheet->setCellValueByColumnAndRow(2, $start, $no);
                        $activeSheet->setCellValueByColumnAndRow(3, $start, $detail["thn_prajamtup"]);
                        $activeSheet->setCellValueByColumnAndRow(4, $start, $detail["rupiah_prajamtup"]);
                        $activeSheet->setCellValueByColumnAndRow(5, $start, $detail["dollar_prajamtup"]);
                        $activeSheet->setCellValueByColumnAndRow(6, $start, $detail["thn_jamtup"]);
                        $activeSheet->setCellValueByColumnAndRow(7, $start, $detail["rupiah_jamtup"]);
                        $activeSheet->setCellValueByColumnAndRow(8, $start, $detail["dollar_jamtup"]);
                        $activeSheet->setCellValueByColumnAndRow(9, $start, $detail["jenis_jamtup"]);
                        $activeSheet->setCellValueByColumnAndRow(10, $start, $detail["bank_jamtup"]);
                    }
                    else{
                        $activeSheet->setCellValueByColumnAndRow(2, $start, $no);
                        $activeSheet->setCellValueByColumnAndRow(3, $start, $detail["thn_prajamrek"]);
                        $activeSheet->setCellValueByColumnAndRow(4, $start, $detail["rupiah_prajamrek"]);
                        $activeSheet->setCellValueByColumnAndRow(5, $start, $detail["dollar_prajamrek"]);
                        $activeSheet->setCellValueByColumnAndRow(6, $start, $detail["thn_jamrek"]);
                        $activeSheet->setCellValueByColumnAndRow(7, $start, $detail["rupiah_jamrek"]);
                        $activeSheet->setCellValueByColumnAndRow(8, $start, $detail["dollar_jamrek"]);
                        $activeSheet->setCellValueByColumnAndRow(9, $start, $detail["jenis_jamrek"]);
                        $activeSheet->setCellValueByColumnAndRow(10, $start, $detail["bank_jamrek"]);
                    }
                    $start = $start+1;
                    $no = $no+1;
                }
                $start = $start + 1;
            }
            
            // Hidden
            // Section 4

            // Rename worksheet
            $activeSheet->setTitle("Detail");
            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            
            $activeSheet->setSelectedCells('A1');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
            
            
            $objWriter->save("reports/{$folder}/{$filter}/{$filename}.xlsx");
            // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // header('Content-Disposition: attachment;filename="01simple.xlsx"');
            // header('Cache-Control: max-age=0');
            // header('Cache-Control: max-age=1');

            // header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            // header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            // header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            // header ('Pragma: public'); // HTTP/1.0
            // $objWriter->save("php://output");
            // exit();
            
            $objPHPExcel = Null;
        }
        
        $path = "reports/{$folder}/{$filter}";
        $this->zip->read_dir($path); 
        $this->zip->download("distambem_arsip_{$filter}.zip"); 
    }
}
