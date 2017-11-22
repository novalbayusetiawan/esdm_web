<script>
$(document).ready(function(){
    // $("#page-container").addClass("page-sidebar-minified");
});
</script>
<div id="content" class="content">
    <ol class="breadcrumb pull-right">
        <li> <?php echo $title[0]; ?> </li>
        <!-- <li> <?php echo ucwords($this->session->userdata("acc_level")); ?> </li> -->
    </ol>
    <h1 class="page-header">
        <?php echo ucwords($this->session->userdata("acc_level")); ?>
        <!-- <small><?php echo $title[1]; ?></small> -->
    </h1>
    <div id="clipper_stats" class="row">
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>IUP OP Aktif</h4>
                    <p><?php echo $iupop_aktip; ?></p>
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>IUP EKS Aktif</h4>
                    <p><?php echo $iupeks_aktip; ?></p>
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/index?filter=iupeks_aktip"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>CNC</h4>
                    <p><?php echo $cnc_exp; ?></p>
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/index?filter=cnc"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-grey-darker">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>Layak Dicabut</h4>
                    <p><?php echo $cabut_layak; ?></p>
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/index?filter=cabut_layak"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>IUP OP Expired</h4>
                    <p><?php echo $iupop_exp; ?></p>
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/index?filter=iupop_exp"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>IUP EKS Expired</h4>
                    <p><?php echo $iupeks_exp; ?></p>
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/index?filter=iupeks_exp"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
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
                    <a href="<?php echo base_url("perusahaan/index?filter=noncnc"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-black">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>Sudah Dicabut</h4>
                    <p><?php echo $cabut_sudah; ?></p>
                </div>
                <div class="stats-link">
                    <a href="<?php echo base_url("perusahaan/index?filter=cabut_sudah"); ?>">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>

  <?php if ( in_array($this->session->userdata("acc_level"), array("semua" ) ) ) { ?>
    <!-- <div class="row">
      <div class="col-md-4">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4 class="panel-title">IUP OP Aktif</h4>
              </div>
              <div class="panel-body">
                <table class="table table-valign-middle m-b-0">
                  <thead>
                    <tr>
                      <th>Kabupaten</th>
                      <th>Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_paser"); ?>">Kabupaten Paser</a></td>
                      <td><?php echo $iupop_aktip_paser; ?></td>
                    </tr>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_ppu"); ?>">Penajam Paser Utara</a></td>
                      <td><?php echo $iupop_aktip_ppu; ?></td>
                    </tr>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_balikpapan"); ?>">Kota Balikpapan</a></td>
                      <td><?php echo $iupop_aktip_balikpapan; ?></td>
                    </tr>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_samarinda"); ?>">Kota Samarinda</a></td>
                      <td><?php echo $iupop_aktip_samarinda; ?></td>
                    </tr>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_kukar"); ?>">Kutai Kartanegara</a></td>
                      <td><?php echo $iupop_aktip_kukar; ?></td>
                    </tr>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_kubar"); ?>">Kutai Barat</a></td>
                      <td><?php echo $iupop_aktip_kubar; ?></td>
                    </tr>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_mahulu"); ?>">Mahakam Ulu</a></td>
                      <td><?php echo $iupop_aktip_mahulu; ?></td>
                    </tr>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_kutim"); ?>">Kutai Timur</a></td>
                      <td><?php echo $iupop_aktip_kutim; ?></td>
                    </tr>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_bontang"); ?>">Bontang</a></td>
                      <td><?php echo $iupop_aktip_bontang; ?></td>
                    </tr>
                    <tr>
                      <td><a href="<?php echo base_url("perusahaan/index?filter=iupop_aktip_berau"); ?>">Berau</a></td>
                      <td><?php echo $iupop_aktip_berau; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
      </div>
    </div> -->
  <?php } else { ?>
    <div id="clipper_freqs" class="row">
        <div class="col-md-12">
            <div class="widget-chart bg-black-darker">
                <div class="widget-chart-content" style="margin-right:0px">
                    <h4 class="chart-title">
                        <strong>Tentang Kami</strong>
                    </h4>
                    <div class="morris-inverse" style="height:200px;color:#fff;margin:2px 5px 7px">
                      Visi :<br />
                      Mewujudkan Kalimantan Timur sebagai lumbung energi yang berkelanjutan dan pengelolaan pertambangan yang berwawasan lingkungan untuk kesejahteraan masyarakat.<br /><br />
                      Misi :<br />
                      <ol style="-webkit-padding-start: 12px;">
                        <li>Meningkatkan kualitas dan kinerja aparatur Dinas Energi dan Sumber Daya Mineral Provinsi Kalimantan Timur dalam rangka mencapai pemerintahan yang baik (good governance) dan pemerintahan yang bersih (clean government), transparan, akuntabel, dan bebas KKN.</li>
                        <li>Menjadikan sumberdaya mineral dan energi sebagai potensi riel kekuatan ekonomi daerah.</li>
                        <li>Meningkatkan intensifikasi, diversifikasi, dan konservasi pertambangan dan energi.</li>
                        <li>Meningkatkan pemanfaatan sumberdaya energi yang terjangkau masyarakat.</li>
                        <li>Meningkatkan pelayanan data dan informasi pertambangan dan energi.</li>
                        <li>Meningkatkan pembinaan, pengawasan, dan koordinasi kegiatan pertambangan dan energi.</li>
                      </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php } ?>
</div>
