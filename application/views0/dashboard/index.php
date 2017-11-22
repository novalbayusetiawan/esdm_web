<script>
$(document).ready(function(){
    // $("#page-container").addClass("page-sidebar-minified");
});
</script>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li> <?php echo $title[0]; ?> </li>
        <li> <?php echo $title[1]; ?> </li>
    </ol>
    <h1 class="page-header">
        <?php echo $title[1]; ?>
        <!-- <small><?php echo $title[1]; ?></small> -->
    </h1>
        <div id="clipper_stats" class="row">
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>IUP OP Kadaluarsa</h4>
                    <p><?php echo $iupop_exp; ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/change_index?filter=iupop"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>IUP EKS Kadaluarsa</h4>
                    <p><?php echo $iupeks_exp; ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/change_index?filter=iupeks"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-purple">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>CNC</h4>
                    <p><?php echo $cnc_exp; ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/change_index?filter=cnc"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>NON CNC</h4>
                    <p><?php echo $noncnc_exp; ?></p>	
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/change_index?filter=noncnc"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>

    <div id="clipper_freqs" class="row">
        <div class="col-md-8">
            <div class="widget-chart bg-black-darker">
                <div class="widget-chart-content">
                    <h4 class="chart-title">
                        Tentang Kami
                    </h4>
                    <div class="morris-inverse" style="height: 242px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Hubungi Kami</h4>
                </div>
                <div class="panel-body" style="height: 260px;">

                </div>
            </div>
        </div>
    </div>
</div>
