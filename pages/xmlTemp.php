<div class="body-title">Xml Şablonu</div>
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
							<label for="tempId" class="form-label">Id</label>
							<input type="text" class="form-control" name="tempId" id="tempId" readonly>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group mb-3">
							<label for="tempName" class="form-label">İsim</label>
							<input type="text" class="form-control" name="tempName" id="tempName">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group mb-3">
							<label for="tempFileName" class="form-label">Dosya İsmi</label>
							<input type="text" class="form-control" name="tempFileName" id="tempFileName">
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
	'assets/js/xmlTemp.js'
);

?>