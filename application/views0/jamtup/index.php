<script>
// Ready Section Datatable
$(document).ready(function(){
    $("#page-container").addClass("page-sidebar-minified");
    oTable = $("#example").DataTable({
        "sorting":[[0, "asc"]],
        "displayLength": 5,
        "processing": true,
        "serverSide": true,
        "serverMethod": "POST",
        "ajax":"<?php echo base_url("jamtup/dt_show"); ?>",
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
        <li> <?php echo $title[0]; ?> </li>
        <li> <?php echo $title[1]; ?> </li>
    </ol>
    <h1 class="page-header">
        <?php echo $title[0]; ?>
        <small><?php echo $title[1]; ?></small>
    </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"><?php echo is_array($title)? implode(" > ", $title) : $title; ?></h4>
                </div>
                <div class="panel-toolbar clearfix">
                    <!--div class="btn-group m-l-5 pull-right">
                        <button type="button" class="btn btn-warning datatable-toggle_checkbox" data-container="#example">Toggle Checkbox(es)</button>
                    </div-->
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-primary data-export"><i class="fa fa-download"></i> Export</button>
                        <button type="button" class="btn btn-info datatable-refresh"><i class="fa fa-repeat"></i> Refresh</button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="scrollbar-macosx" style="min-height:200px;">
                        <table width="100%" id="example" class="display table table-bordered table-condensed table-small-font table-hover table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">Nama_Perusahaan</th>
                                    <th colspan="3" class="text-center">Pra Jamtup</th>
                                    <th colspan="3" class="text-center">Realisasi Jamtup</th>
                                    <th rowspan="2">Jenis_Jamtup</th>
                                    <th rowspan="2">Bank_Jamtup</th>
                                </tr>
                                <tr>
                                    <th>Tahun_Pra_Jamtup</th>
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
