<script>
// Ready Section Datatable
$(document).ready(function(){
    oTable = $("#example").DataTable({
        "sorting":[[0, "asc"]],
        // "displayLength": 5,
        "processing": true,
        "serverSide": true,
        "serverMethod": "POST",
        "ajax":"<?php echo base_url("perusahaan/dt_show?filter={$filter}"); ?>",
        "columns": [
            {"data": "nama_perusahaan"},
            {"data": "status"},
            {"data": "telp_perusahaan"},
            {"data": "email_kantor"},
            {"data": "alamat_kantor"},
            {"data": "open"}
        ]
    });
});
</script>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <!-- <li> Dashboard </li> -->
        <li> Add/Edit Data Perusahaan </li>
    </ol>
    <h1 class="page-header">
        Data <?php echo $title[0]; ?>
        <!-- <small><?php echo $title[1]; ?></small> -->
    </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Data <?php echo $title[0]; ?></h4>
                </div>
                <div class="panel-toolbar clearfix">
                    <!--div class="btn-group m-l-5 pull-right">
                        <button type="button" class="btn btn-warning datatable-toggle_checkbox" data-container="#example">Toggle Checkbox(es)</button>
                    </div-->
                    <div class="btn-group pull-right">
                        <a href="<?php echo base_url("perusahaan/insert_form"); ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add</a>
                        <button type="button" class="btn btn-sm btn-info datatable-refresh"><i class="fa fa-repeat"></i> Refresh</button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="scrollbar-macosx" style="min-height:200px;">
                        <table width="100%" id="example" class="display table table-bordered table-condensed table-small-font table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nama_Perusahaan</th>
                                    <th>Status</th>
                                    <th>No. Telp</th>
                                    <th>E-mail</th>
                                    <th>Alamat Perusahaan</th>
                                    <th width="70"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
