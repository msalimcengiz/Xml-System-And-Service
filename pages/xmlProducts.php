<div class="body-title">Xml Ürün Listesi</div>
<div class="body-body">
	<div class="row">
		<div class="col-lg-12" style="margin-bottom:25px;">
			<button type="button" class="btn btn-primary float-left">Ürünleri Gönder</button>
			<button type="button" class="btn btn-danger float-left" onclick="allRemove(<?php echo $_GET['xmlId']; ?>)">Tüm Ürünleri Sil</button>
		</div>
		<div class="col-lg-12">
			<table id="dataTable" class="display" width="100%"></table>
		</div>
	</div>
</div>

<?php

$pageJs=array(
	'assets/js/xmlProducts.js'
);
echo '<script type="text/javascript">var selectedXmlId='.$_GET['xmlId'].';</script>';

?>