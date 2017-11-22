<script>
// $.fn.dataTable.ext.search.push(
//     function( settings, data, dataIndex ) {
//         var min = parseInt( $('#min').val(), 10 );
//         var max = parseInt( $('#max').val(), 10 );
//         var age = parseFloat( data[3] ) || 0; // use data for the age column
//
//         if ( ( isNaN( min ) && isNaN( max ) ) ||
//              ( isNaN( min ) && age <= max ) ||
//              ( min <= age   && isNaN( max ) ) ||
//              ( min <= age   && age <= max ) )
//         {
//             return true;
//         }
//         return false;
//     }
// );
// Ready Section Datatable
$(document).ready(function(){
    $("#page-container").addClass("page-sidebar-minified");
    oTable = $("#example").DataTable({
        "sorting":[[0, "asc"]],
        "displayLength": 5,
        "scrollX": true,
        "fixedColumns":true,
        "processing": true,
        "serverSide": true,
        "serverMethod": "POST",
        "ajax":"<?php echo base_url("perusahaan/dt_show?".http_build_query($filter)); ?>",
        // "dom": "Blfrtip",
        // "buttons": [
            // {
              // "extend": "excel",
              // "text": "Eksport to Excel",
              // "exportOptions": {
                // "columns": ':visible',
              // },
              // "className": "btn btn-sm btn-success buttons-excel buttons-html5"
            // },
            // {
                // "text": "<i class='fa fa-sliders'></i>",
                // "className": "btn btn-sm btn-warning buttons-html5 data-filter"
            // }
        // ],
        "columns": [
            {"data": "nama_perusahaan"},
            {"data": "status"},
            {"data": "nama_dirut"},
            {"data": "nama_saham"},
            {"data": "alamat_kantor"},
            {"data": "telp_perusahaan"},
            {"data": "telp_dirut"},
            {"data": "telp_saham"},
            {"data": "email_kantor"},
            {"data": "email_dirut"},
            {"data": "email_saham"},
            {"data": "nama_ktt"},
            {"data": "hp_ktt"},
            {"data": "email_ktt"},
            {"data": "sk_ktt"},
            {"data": "ktt_terbit"},
            {"data": "ktt_berakhir"},
            {"data": "status_cnc"},
            {"data": "tahap_cnc"},
            {"data": "komoditas"},
            {"data": "kelurahan"},
            {"data": "kecamatan"},
            {"data": "kabupaten"},
            {"data": "propinsi"},
            {"data": "tereka"},
            {"data": "terunjuk"},
            {"data": "terukur"},
            {"data": "terkira"},
            {"data": "terbukti"},
            {"data": "jenis_penjualan"},
            {"data": "jumlah_penjualan"},
            {"data": "moisture"},
            {"data": "sulphur"},
            {"data": "ash"},
            {"data": "calori"},
            {"data": "no_tinjau"},
            {"data": "luas_tinjau"},
            {"data": "thn_tinjau1"},
            {"data": "thn_tinjau2"},
            {"data": "no_pu"},
            {"data": "luas_pu"},
            {"data": "thn_pu1"},
            {"data": "thn_pu2"},
            {"data": "no_kpeks"},
            {"data": "luas_kpeks"},
            {"data": "thn_kpeks1"},
            {"data": "thn_kpeks2"},
            {"data": "no_iupeks"},
            {"data": "luas_iupeks"},
            {"data": "thn_iupeks1"},
            {"data": "thn_iupeks2"},
            // {"data": "no_kpeksp"},
            // {"data": "luas_kpeksp"},
            // {"data": "thn_kpeksp1"},
            // {"data": "thn_kpeksp2"},
            {"data": "no_iupjual"},
            {"data": "luas_iupjual"},
            {"data": "thn_iupjual1"},
            {"data": "thn_iupjual2"},
            {"data": "no_iupop"},
            {"data": "luas_iupop"},
            {"data": "thn_iupop1"},
            {"data": "thn_iupop2"}
        ]
    });

    // Event listener to the two range filtering inputs to redraw on input
    // $('#min, #max').keyup( function() {
    //     oTable.draw();
    // } );
});
</script>
<?php $this->load->view("perusahaan/filtering"); ?>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li> View Data </li>
        <li> Data <?php echo $title[0]; ?> </li>
    </ol>
    <h1 class="page-header">
        <?php echo $title[0]; ?>
        <!-- <small><?php echo $title[1]; ?></small> -->
    </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">View Data Perusahaan</h4>
                </div>
                <div class="panel-toolbar clearfix">
                    <!--div class="btn-group m-l-5 pull-right">
                        <button type="button" class="btn btn-warning datatable-toggle_checkbox" data-container="#example">Toggle Checkbox(es)</button>
                    </div-->
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-primary data-filter"><i class="fa fa-plus"></i> Advance Filter</button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="-scrollbar-macosx" style="min-height:200px;">
                        <table width="100%" id="example" class="display table table-bordered table-condensed table-small-font table-hover table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">Nama_Perusahaan</th>
                                    <th rowspan="2">Status_Perusahaan</th>

                                    <th colspan="2" class="text-center">Nama</th>

                                    <th rowspan="2">Alamat_Kantor</th>

                                    <th colspan="3" class="text-center">Telepon</th>

                                    <th colspan="3" class="text-center">Email</th>

                                    <th colspan="6" class="text-center">KTT</th>

                                    <th colspan="2" class="text-center">CNC</th>

                                    <th rowspan="2">Komoditas</th>

                                    <th colspan="4" class="text-center">Lokasi</th>

                                    <th colspan="3" class="text-center">Sumber Daya</th>

                                    <th colspan="2" class="text-center">Cadangan</th>

                                    <th colspan="2" class="text-center">Penjualan</th>

                                    <th colspan="4" class="text-center">Kandungan</th>

                                    <!-- <th colspan="4" class="text-center">Izin Peninjauan</th> -->

                                    <th colspan="4" class="text-center">KP Penyelidikan Umum</th>

                                    <th colspan="4" class="text-center">KP Eksplorasi</th>

                                    <th colspan="4" class="text-center">IUP Eksplorasi</th>
                                    <th colspan="4" class="text-center">KP Eksploitasi</th>
                                    <th colspan="4" class="text-center">Pengangkutan/Penjualan</th>
                                    <th colspan="4" class="text-center">IUP Operasi/Produksi</th>
                                </tr>
                                <tr>
                                    <th>Direktur</th>
                                    <th>Pemegang_Saham</th>

                                    <th>Kantor</th>
                                    <th>Dirut</th>
                                    <th>Pemegang_Saham</th>

                                    <th>Kantor</th>
                                    <th>Dirut</th>
                                    <th>Pemegang_Saham</th>

                                    <th>Nama_KTT</th>
                                    <th>Telepon_KTT</th>
                                    <th>Email_KTT</th>
                                    <th>SK_KTT</th>
                                    <th>Tanggal_SK_KTT</th>
                                    <th>Tanggal_SK_KTT_Berakhir</th>

                                    <th>Status_CNC</th>
                                    <th>Tahap_CNC</th>

                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten</th>
                                    <th>Provinsi</th>

                                    <th>Tereka</th>
                                    <th>Terunjuk</th>
                                    <th>Terukur</th>

                                    <th>Terkira</th>
                                    <th>Terbukti</th>

                                    <th>Jenis_Penjualan</th>
                                    <th>Jumlah_Penjualan</th>

                                    <th>Moisture</th>
                                    <th>Sulphur</th>
                                    <th>Ash</th>
                                    <th>Calori</th>

                                    <th>No</th>
                                    <th>Luas</th>
                                    <th>Tanggal_Terbit</th>
                                    <th>Tanggal_Berakhir</th>

                                    <th>No</th>
                                    <th>Luas</th>
                                    <th>Tanggal_Terbit</th>
                                    <th>Tanggal_Berakhir</th>

                                    <th>No</th>
                                    <th>Luas</th>
                                    <th>Tanggal_Terbit</th>
                                    <th>Tanggal_Berakhir</th>

                                    <th>No</th>
                                    <th>Luas</th>
                                    <th>Tanggal_Terbit</th>
                                    <th>Tanggal_Berakhir</th>

                                    <!-- <th>No</th> -->
                                    <!-- <th>Luas</th> -->
                                    <!-- <th>Tanggal_Terbit</th> -->
                                    <!-- <th>Tanggal_Berakhir</th> -->

                                    <th>No</th>
                                    <th>Luas</th>
                                    <th>Tanggal_Terbit</th>
                                    <th>Tanggal_Berakhir</th>

                                    <th>No</th>
                                    <th>Luas</th>
                                    <th>Tanggal_Terbit</th>
                                    <th>Tanggal_Berakhir</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
