<script>
// Event Section
$(document).on("click", ".data-filter", function(event){
    event.preventDefault();
    $("#form_filter").find("button[type='reset']").click();
    $("#modal_filter").modal({backdrop: 'static'});
    $("#modal_filter").modal("show");
	return false;
});
$(document).on("click", "#form_filter input[value=layakcabut], #form_filter input[value=sudahcabut]", function(){
    // event.preventDefault();
	// alert("abs");
	// $(this).prop("checked", true);
	$("#form_filter input[value=iupop], #form_filter input[value=iupeks]").prop("checked", false);
	$("#form_filter input[value=aktif], #form_filter input[value=expired]").prop("checked", false);
	// return false;
});
$(document).on("click", "#form_filter input[value=aktif], #form_filter input[value=expired]", function(){
    // event.preventDefault();
	// $(this).prop("checked", true);
	$("#form_filter input[value=layakcabut], #form_filter input[value=sudahcabut]").prop("checked", false);
	// return false;
});
$(document).on("click", "#form_filter input[value=iupop], #form_filter input[value=iupeks]", function(){
    // event.preventDefault();
	// $(this).prop("checked", true);
	$("#form_filter input[value=layakcabut], #form_filter input[value=sudahcabut]").prop("checked", false);
	// return false;
});
</script>
<div class="modal fade" id="modal_filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="form_filter" role="form" action="<?php echo base_url("perusahaan/index"); ?>" method="GET" enctype="application/x-www-form-urlencoded">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Advance Filter</h4>
            </div>
			<input type="hidden" name="advanced" value="1" />
            <div class="modal-body">
                <div class="form-group">
                    <?php
                    $data = array(
                        "name" => "nama_perusahaan",
                        "class" => "form-control",
                        "placeholder" => "Nama Perusahaan",
						"value" => $this->input->get("nama_perusahaan")
                    );
                    echo form_label($data["placeholder"], $data["name"]);
                    echo form_input($data);
                    ?>
                </div>
				<div class="form-group">
					<?php echo form_label("Berdasar Jenis Izin", ""); ?>
				</div>
				<div class="row">
					<div class="col col-md-6">
						<div class="form-group">
							<input type="checkbox" name="advanced_filter[filter_iup][]" value="iupop" /> IUP OP <br />
							<input type="checkbox" name="advanced_filter[filter_iup][]" value="iupeks" /> IUP Eksplorasi <br />
						</div>
					</div>
					<div class="col col-md-6">
						<div class="form-group">
							<input type="checkbox" name="advanced_filter[filter_status][]" value="aktif" /> Aktif <br />
							<input type="checkbox" name="advanced_filter[filter_status][]" value="expired" /> Expired <br />
							<input type="checkbox" name="advanced_filter[filter_status][]" value="warning" /> Extended <br />
						</div>
					</div>
                </div>
                <div class="form-group">
                    <?php echo form_label("Berdasar CNC", ""); ?>
					<br />
					<input type="checkbox" name="advanced_filter[filter_cnc][]" value="cnc" /> CNC <br />
					<input type="checkbox" name="advanced_filter[filter_cnc][]" value="non cnc" /> NON CNC <br />
				</div>
                <div class="form-group">
                    <?php echo form_label("Berdasar Layak Cabut", ""); ?>
					<br />
					<input type="checkbox" name="advanced_filter[filter_cabut][]" value="layakcabut" /> Layak Cabut <br />
					<input type="checkbox" name="advanced_filter[filter_cabut][]" value="sudahcabut" /> Sudah Cabut <br />
                </div>
				<?php if (strtolower($this->session->userdata("acc_level")) == "semua"){ ?>
                <div class="form-group">
                    <?php
                    echo form_label("Region Name", "nama_wilayah");
                    echo form_dropdown("nama_wilayah", $regions, $this->input->get("nama_wilayah"), "class=\"form-control\"");
                    ?>
                </div>
				<?php  } ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">GO</button>
            </div>
        </div>
    </div>
    </form>
</div>
