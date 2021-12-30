<?php

$getUrl=sprintf("%s://%s%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['SERVER_NAME'],$_SERVER['SCRIPT_NAME']);
$getUrl=str_replace('index.php','',$getUrl);
$defineUrl=array(
	"webUrl"=>$getUrl,
	"apiUrl"=>$getUrl.'xhr/',
);

$pageJs=array();

$pageName=(isset($_GET['pn'])?$_GET['pn']:'');
if($pageName!=''){
	if(!file_exists('pages/'.$pageName.'.php')){
		$pageName='home';
	}
}else{
	$pageName='home';
}

include('header.php');
include('pages/'.$pageName.'.php');
include('footer.php');

foreach($pageJs as $k=>$v){
	echo '<script type="text/javascript" src="'.$defineUrl['webUrl'].$v.'"></script>';
}

?>