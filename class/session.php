<?php
require 'database.php';

if(isset($request->inciarSesion)){ 
session_start();    
$_SESSION['usuario'] =   $request->inciarSesion;  
//$_SESSION['usuario'];           
}


if(isset($request->close)){
session_start();
 //session_destroy(); 
 unset($_SESSION['usuario']); 
//$_SESSION['usuario']=""; 
//echo 'Estuvo en sesion destroy';
//
}

?>

