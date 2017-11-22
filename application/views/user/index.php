<script>
// Ready Section Datatable
$(document).ready(function(){
    oTable = $("#example").DataTable({
        "sorting":[[1, "asc"]], 
        "displayLength": 5,
        "processing": true,
        "serverSide": true,
        "serverMethod": "POST",
        "ajax":"<?php echo base_url("user/dt_show"); ?>",
        "columns": [
            {"data": "id"},
            {"data": "username"},
            {"data": "nama_wilayah"},
            {"data": "action", "searchable":false, "sortable":false}
        ]
    });
}); 
</script>
<?php $this->load->view("user/add"); ?>
<?php $this->load->view("user/edit"); ?>
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
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"><?php echo is_array($title)? implode(" > ", $title) : $title; ?></h4>
                </div>
                <div class="panel-toolbar clearfix">
                    <!--div class="btn-group m-l-5 pull-right">
                        <button type="button" class="btn btn-warning datatable-toggle_checkbox" data-container="#example">Toggle Checkbox(es)</button>
                    </div-->
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-primary data-add"><i class="fa fa-plus"></i> Add</button>
                        <button type="button" class="btn btn-info datatable-refresh"><i class="fa fa-repeat"></i> Refresh</button>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="scrollbar-macosx" style="min-height:200px;">
                        <table width="100%" id="example" class="display table table-bordered table-condensed table-small-font table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="1">Id</th>
                                    <th>Username</th>
                                    <th>Region Name</th>
                                    <th width="1">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
