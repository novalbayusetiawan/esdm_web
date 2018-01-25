<script>
// Ready Section Datatable
$(document).ready(function(){
    $("#page-container").addClass("page-sidebar-minified");
    oTable = $("#example").DataTable({
        "sorting":[[0, "asc"]],
        // "displayLength": 5,
        "scrollX": true,
        "fixedColumns":true,
        "processing": true,
        "serverSide": true,
        "serverMethod": "POST",
        "ajax":"<?php echo base_url("jamtup/dt_show"); ?>",
        "dom": "Blfrtip",
        "buttons": [
          {
              "extend": "excel",
              "text": "Eksport to Excel",
              "exportOptions": {
                "columns": ':visible',
              },
              "className": "btn btn-sm btn-success buttons-excel buttons-html5"
        }],
        "columns": [
            {"data": "nama_perusahaan"},
            {"data": "thn_prajamtup"},
            {"data": "rupiah_prajamtup"},
            {"data": "dollar_prajamtup"},
            {"data": "thn_jamtup"},
            {"data": "rupiah_jamtup"},
            {"data": "dollar_jamtup"},
            {"data": "jenis_jamtup"},
            {"data": "bank_jamtup"},
        ]
    });
});
</script>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li> View Data </li>
        <li> <?php echo $title[0]; ?> </li>
    </ol>
    <h1 class="page-header">
        <?php echo $title[0]; ?>
        <!-- <small><?php echo $title[1]; ?></small> -->
    </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">View Data <?php echo $title[0]; ?></h4>
                </div>
                <div class="panel-body">
                    <div class="scrollbar-macosx" style="min-height:200px;">
                        <table width="100%" id="example" class="display table table-bordered table-condensed table-small-font table-hover table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">Nama_Perusahaan</th>
                                    <th colspan="3" class="text-center">Penetapan Jamtup</th>
                                    <th colspan="3" class="text-center">Penempatan Jamtup</th>
                                    <th rowspan="2">Jenis_Jamtup</th>
                                    <th rowspan="2">Bank_Jamtup</th>
                                </tr>
                                <tr>
                                    <th>Tahun_Penetapan_Jamtup</th>
                                    <th>Besaran_Rupiah</th>
                                    <th>Besaran_Dollar</th>
                                    <th>Tahun_Jamtup</th>
                                    <th>Besaran_Rupiah</th>
                                    <th>Besaran_Dollar</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
