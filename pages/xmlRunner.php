<div class="body-title">Xml Çalıştırıcı</div>
<div class="body-body">
	<div class="row">
		<div class="col-lg-12">
			<table id="dataTable" class="display" width="100%"></table>
		</div>
	</div>
</div>

<div class="modal fade" id="reportModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Raporlar</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<table class="table">
							<thead>
								<tr>
									<th scope="col">Barkod</th>
									<th scope="col">Hata Durumu</th>
									<th scope="col">Hata Mesajı</th>
									<th scope="col">Yapılan işlem</th>
								</tr>
							</thead>
							<tbody id="dataTableReport"></tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
			</div>
		</div>
	</div>
</div>

<?php

$pageJs=array(
	'assets/js/xmlRunner.js'
);

?>