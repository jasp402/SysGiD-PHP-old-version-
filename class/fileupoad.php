<?php
include("SimpleImage.class.php");
if($_FILES["file"]["name"]){
$file = $_FILES["file"]["name"];
if(!is_dir("../dist/img/users"))
mkdir("../dist/img/users", 0777);

$dir = "../dist/img/users/";
move_uploaded_file($_FILES["file"]["tmp_name"], $dir.$file);
$obj_simpleimage = new SimpleImage();
$obj_simpleimage->load($dir.$file);
$obj_simpleimage->resize(128,128);
$obj_simpleimage->save($dir.$file);
}else{ echo "error la imagen cargo"; }

?>
