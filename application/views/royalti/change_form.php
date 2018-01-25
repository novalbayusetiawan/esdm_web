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
        "ajax":"<?php echo base_url("royalti/dt_show?id_perusahaan={$id}"); ?>",
        "columns": [
            {"data": "id"},
            {"data": "nama_perusahaan"},
            {"data": "thn_prajamrek"},
            {"data": "rupiah_prajamrek"},
            {"data": "dollar_prajamrek"},
            {"data": "thn_jamrek"},
            {"data": "rupiah_jamrek"},
            {"data": "dollar_jamrek"},
            {"data": "jenis_jamrek"},
            {"data": "bank_jamrek"},
            {"data": "action"},
        ]
    });
});
</script>
<?php $this->load->view("royalti/add"); ?>
<?php $this->load->view("royalti/edit"); ?>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li> <?php echo $title[0]; ?> </li>
        <li> <?php echo $title[1]; ?> </li>
    </ol>
    <h1 class="page-header">
        <?php echo $nama_perusahaan; ?>
        <!--small><?php echo $title[1]; ?></small-->
    </h1>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills">
                <li><a href="<?php echo base_url("perusahaan/change_form?id={$id}"); ?>">Home</a></li>
                <li><a href="<?php echo base_url("jamrek_eks/change_form?id={$id}"); ?>">Jamrek Tahap Eksplorasi</a></li>
                <li><a href="<?php echo base_url("jamrek_pro/change_form?id={$id}"); ?>">Jamrek Tahap Produksi</a></li>
                <li><a href="<?php echo base_url("jamtup/change_form?id={$id}"); ?>">Jaminan Penutupan</a></li>
                <li><a href="<?php echo base_url("jamkes/change_form?id={$id}"); ?>">Jaminan Kesungguhan Eksplorasi</a></li>
                <li><a href="<?php echo base_url("iuran/change_form?id={$id}"); ?>">Iuran Tetap</a></li>
                <li class="active"><a href="<?php echo base_url("royalti/change_form?id={$id}"); ?>">Royalti</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"><?php echo $title[1]; ?> <?php echo $title[0]; ?> <?php echo $nama_perusahaan; ?></h4>
                </div>
                <div class="panel-toolbar clearfix">
                    <!--div class="btn-group m-l-5 pull-right">
                        <button type="button" class="btn btn-warning datatable-toggle_checkbox" data-container="#example">Toggle Checkbox(es)</button>
                    </div-->
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-sm btn-primary data-add"><i class="fa fa-add"></i> Add</button>
                        <button type="button" class="btn btn-sm btn-info datatable-refresh"><i class="fa fa-repeat"></i> Refresh</button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="scrollbar-macosx" style="min-height:200px;">
                        <table width="100%" id="example" class="display table table-bordered table-condensed table-small-font table-hover table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">ID</th>
                                    <th rowspan="2">Perusahaan</th>
                                    <th colspan="3" class="text-center">Penetapan Jaminan</th>
                                    <th colspan="3" class="text-center">Penempatan Jaminan</th>
                                    <th rowspan="2">Jenis Jaminan/Deposito</th>
                                    <th rowspan="2">Nama Bank</th>
                                    <th rowspan="2" width="1">Action</th>
                                </tr>
                                <tr>
                                    <th>Tahun Jaminan</th>
                                    <th>Besaran Jaminan (Rupiah)</th>
                                    <th>Besaran Jamianan (Dollar)</th>
                                    <th>Tahun Jaminan</th>
                                    <th>Besaran Jaminan (Rupiah)</th>
                                    <th>Besaran Jamianan (Dollar)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
