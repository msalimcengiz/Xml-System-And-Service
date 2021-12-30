<?php

$serverType='localhost';

//error_reporting(0);
$mysqli=new mysqli("localhost","root","","xmlOperation");
if(mysqli_connect_errno()){errorOp('Database connection error !');}
$mysqli->character_set_name();
if(!$mysqli->set_charset("utf8")){errorOp('Database error.');}
//$mysqli->close();

?>