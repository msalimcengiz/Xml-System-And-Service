<div class="body-title">Xml Ekle</div>
<div class="body-body">
	<div class="row">
		<div class="col-lg-12">
			<button type="button" class="btn btn-primary" style="margin-bottom:25px;" onclick="openOperationModal()">Yeni Ekle</button>
		</div>
		<div class="col-lg-12">
			<table id="dataTable" class="display" width="100%"></table>
		</div>
	</div>
</div>

<div class="modal fade" id="operationModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Xml İşlem</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="form-group mb-3">
							<label for="xmlId" class="form-label">Xml Id</label>
							<input type="text" class="form-control" name="xmlId" id="xmlId" readonly>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group mb-3">
							<label for="xmlLink" class="form-label">Xml Link</label>
							<input type="text" class="form-control" name="xmlLink" id="xmlLink">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group mb-3">
							<label for="xmlName" class="form-label">İsim</label>
							<input type="text" class="form-control" name="xmlName" id="xmlName">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group mb-3">
							<label for="xmlMerchant" class="form-label">Cari</label>
							<select class="js-example-basic-single form-control" name="state" id="xmlMerchant" style="width:100%;"></select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group mb-3">
							<label for="xmlTemp" class="form-label">Xml Şablonu</label>
							<select class="js-example-basic-single form-control" name="state" id="xmlTemp" style="width:100%;"></select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group mb-3">
							<label for="xmlUpdateTime" class="form-label">Güncelleme Aralığı</label>
							<select class="form-control" name="xmlUpdateTime" id="xmlUpdateTime">
								<option value="6">6 Saat</option>
								<option value="12">12 Saat</option>
								<option value="24">24 Saat</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
				<button type="button" class="btn btn-primary" onclick="saveOperation()">Kaydet</button>
			</div>
		</div>
	</div>
</div>

<?php

$pageJs=array(
	'assets/js/addXml.js'
);

?>