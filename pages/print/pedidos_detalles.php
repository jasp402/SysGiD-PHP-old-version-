<?php ob_start(); //<-- No tocar! esto es lo que carga el documento en el cache y es lo que usa el DomPDF para crear el documento
/*
Saludos! 
--> Si puedes leer esto es por que eres el elegido...! <--
Bueno hermano aca te dejo el documento que hace que la magia de PDF sea posible.
intentare explicarte brevemente como funciona cada cosa... esta super sencillo
pero si tienes dudas escribeme...!  
*/
require '../../class/database.php'; //<-- Conecta a la Base de dato y usa las funciones que se crearon para facilitarnos la vida
date_default_timezone_set('America/Lima');
class Utilitario{

//Convierte fecha de mysql a normal
public function cambiaf_a_normal($fecha){ 
  ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
  $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
  return $lafecha; 
} 

//Convierte fecha de normal a mysql
public function cambiaf_a_mysql($fecha){ 
  ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
  $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
  return $lafecha; 
}

}
$Utilitario = new Utilitario;

if(isset($_GET['formato'])){  //Si recibe algo de donde lo enviaron... sino solo aparecera la pantalla en blanco

  $formato=$_GET['formato'];  //esto se usara luego (más abajo)


  //CONSULTAS MYSQL (Sin más que decir)
  //////////////////////////////////////////// 
  $db = getConnection();
  $sql="SELECT * FROM `ventas_clientes` as c, pedidos as p WHERE c.id_cliente = p.id_cliente AND p.id_pedido=".$_GET['idPedido']." ORDER BY `p`.`fecha_pedido` ASC";
  $stmt = $db->query($sql);  
  $dataCliente = $stmt->fetchObject();
  //$db = null; 
  //CONSULTAS MYSQL (Sin más que decir)
  ////////////////////////////////////////////
  //$db = getConnection();
  // $sql="SELECT * FROM `pedidos_detalles` WHERE `id_pedido`=".$_GET['idPedido']."";
  $sql = "SELECT ped.precio_prod_detalle, ped.cant_prod_detalle, ped.importe_prod_detalle,pro.nombre_producto as nombre, pro.medida as medida, catp.nombre as categoria, proti.nombre as tipo
        FROM pedidos_detalles ped
        INNER JOIN producto pro ON pro.id_producto = ped.id_producto
        INNER JOIN producto_categoria catp ON catp.idcategoria = pro.idcategoria
        INNER JOIN producto_tipo proti ON proti.idtipo_producto = pro.idtipo_producto
        WHERE ped.id_pedido =".$_GET['idPedido']." ";
  $stmt = $db->query($sql);  
  $dataPedido = $stmt->fetchAll();
  //$db = null; 
  ////////////////////////////////////////////
  //$db = getConnection();
  $sql="SELECT SUM(`importe_prod_detalle`) as suma FROM `pedidos_detalles` WHERE `id_pedido`=".$_GET['idPedido']."";
  $stmt = $db->query($sql);  
  $dataPedido2 = $stmt->fetchObject();

//Apartir de aqui el HTML es todo tuyo puedes modificarlo como quieras! :)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Document</title>
    <link rel="stylesheet" href="../../dist/css/Print.css">
</head>

<body>
<div id="body">

<div id="section_header">
</div>

<div id="content">
  
<div class="page" style="font-size: 7pt">

<h1 style="text-align: right;  margin-bottom:-5px"><b>PEDIDO #<?php echo $dataCliente->numero_pedido;?></b></h1>
<h2 style="text-align: right; margin-top:0px">fecha: <?php $fecha_pedidoP = $Utilitario->cambiaf_a_normal($dataCliente->fecha_pedido); echo $fecha_pedidoP;  ?></h2>
<table style="width: 100%;" class="header">
<tr>
<td><h2 style="text-align: left; font-size:24px; margin-bottom:-5px"><?php if(!empty($dataCliente->RUC)){echo $dataCliente->razonsocial;}else{echo $dataCliente->nombre."  ".$dataCliente->apellido; }  ?></h2>
</td>
<td><h1 style="text-align: right"></h1></td>
</tr>
</table>

<table style="width: 100%; font-size: 8pt;">
<tr>
<td>
<?php 
    if($dataCliente->RUC == ''){
      echo 'DNI'; 
    }else{
      echo 'RUC:';
    } 
?> 
<strong>
<?php 
    if($dataCliente->RUC == ''){
      echo $dataCliente->DNI; 
    }else{
      echo $dataCliente->RUC;
    } 
?>
</strong>
</td>
<td>Departamento: <strong><?php echo $dataCliente->departamento; ?> </strong></td>
</tr>

<tr>
<td>Dirección: <strong> <?php echo $dataCliente->direccion; ?></strong></td>
<td>Provincia: <strong><?php echo $dataCliente->provincia; ?></strong></td>
</tr>

<tr>
<td>
Telefono: 
<strong>
<?php 
    if($dataCliente->telefono == ''){
      echo $dataCliente->telefono; 
    }else{
      echo $dataCliente->telefono2;
    } 
?></strong></td>
<td>Distrito: <strong><?php echo $dataCliente->distrito; ?></strong></td>
</tr>

</table>

<br>
<br>

<table class="change_order_items">
<tbody><tr><td colspan="6" align="left"><h1 style="text-align:left">Detalles del Pedido:</h1></td></tr>
</tbody>
<tbody>
<tr>
<th>#</th>
<th>Nombre</th>
<th>Importe</th>
<th>Cantidad</th>
<th>Sub Total</th>
<th colspan="2">Total</th>
</tr>

<?php
for ($i=0; $i < count($dataPedido); $i++) { ?>
<tr class="even_row">
<td style="text-align: center"><?php $ii = $i +1; echo $ii; ?></td> 
<td style="text-align: center; font-size: 8px;">
<?php 
$tipoP      = $dataPedido[$i]['tipo']; 
$categoriaP = $dataPedido[$i]['categoria']; 
$nombreP    = $dataPedido[$i]['nombre'];
$medidaP    = $dataPedido[$i]['medida'];
echo $tipoP." ".$categoriaP." ".$nombreP." ".$medidaP; 
?></td>
<td style="text-align: center"> <?php echo $dataPedido[$i]['precio_prod_detalle'] ?></td>
<td style="text-align: center"><?php echo $dataPedido[$i]['cant_prod_detalle'] ?></td>
<td style="text-align: center"><?php $importe = $dataPedido[$i]['importe_prod_detalle']; echo $importe; ?></td>
<td colspan="2" style="text-align: center"><?php echo ($importe * 0.18) + $importe; ?></td>
</tr>
<?php } ?>
</tbody>
<tbody>
<tr>
<td colspan="4" style=""></td>
<td colspan="1" style="text-align: right;"><strong>TOTAL:</strong></td>
<td style="text-align: center"><strong><?php $total = $dataPedido2->suma; echo ($total * 0.18) + $total; ?></strong></td>
</tr>
</tbody>
</table>


</div>
</div>
</body>
</html>

  

<?php

/*
Saludos de nuevo!
En estas pocas lineas es que ocurre la magia de generar el PDF. 
Te explico un poco como funciona.
*/
}
if($formato=='PDF'){ // <-- Recuerdas que arriba teneias de $formato=$_GET['formato']; y te dije: "//esto se usara luego (más abajo)"
//Esto confirma si hay que generar un PDF o solo mostrar el HTML

require_once("../../plugins/dompdf/dompdf_config.inc.php"); //<--Esto es la libreria DomPDF

$dompdf = new DOMPDF(); //<-- Instancias la class para hacer uso de las propiedades del DomPDF

$dompdf->load_html(ob_get_clean()); //<-- Recuerdas que te dije  ob_start(); //<-- No tocar!. Pues aqui es que se carga la informacón del HTML precargada

$dompdf->render(); //<-- Aqui renderiza... es decir procesa el HTML y lo pone como pagina

$pdf = $dompdf->output(); //<-- Aqui es que le da salida en la pantalla al lo que acaba de renderizar

$filename = $dataCliente->numero_pedido.'.pdf'; // <-- Aqui le asignas nombre al documento

file_put_contents('../../reportes/'.$filename, $pdf); // <-- Permite crear la carpeta o el documento sino existe o sobreescribir el existente para no saturar el servidor.

$file_to_save = '../../reportes/'.$filename; //<-- aqui Guarda de forma atomatica los documentos creados en PDF

$dompdf->stream($filename, array("Attachment" => 0)); //Esto no recuerdo para que es... ^_^ pero no se debe tocar
}

/*
Gracias por leer con detenimiento.
*/
?>


