<?php ob_start(); 
require '../../class/database.php';

if(isset($_GET['formato'])){ 
  $formato=$_GET['formato']; 
  ////////////////////////////////////////////
  $db = getConnection();
  $sql="SELECT * FROM `ventas_clientes` as c, pedidos as p WHERE c.id_cliente = p.id_cliente AND p.id_pedido=".$_GET['idPedido']." ORDER BY `p`.`fecha_pedido` ASC";
  $stmt = $db->query($sql);  
  $dataCliente = $stmt->fetchObject();
  $db = null; 
  ////////////////////////////////////////////
  $db = getConnection();
  $sql="SELECT * FROM `pedidos_detalles` WHERE `id_pedido`=".$_GET['idPedido']."";
  $stmt = $db->query($sql);  
  $dataPedido = $stmt->fetchAll();
  $db = null; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>Document</title>

</head>

<body>
<div id="body">

<div id="section_header">
</div>

<div id="content">
  
<div class="page" style="font-size: 7pt">

<h1 style="text-align: right;  margin-bottom:-5px"><b>PEDIDO #<?php echo $dataCliente->numero_pedido;?></b></h1>
<h2 style="text-align: right; margin-top:0px">fecha:<?php echo $dataCliente->fecha_pedido ?></h2>
<table style="width: 100%;" class="header">
<tr>
<td><h2 style="text-align: left; font-size:24px; margin-bottom:-5px"><?php if(!empty($dataCliente->RUC)){echo $dataCliente->razonsocial;}else{echo $dataCliente->nombre."  ".$dataCliente->apellido; }  ?></h2>
</td>
<td><h1 style="text-align: right"></h1></td>
</tr>
</table>

<table style="width: 100%; font-size: 8pt;">
<tr>
<td>Job: <strong>132-003</strong></td>
<td>Purchasers(s): <strong>Palmer</strong></td>
</tr>

<tr>
<td>Created: <strong>2004-08-13</strong></td>
<td>Last Change: <strong>2004-08-16  9:28 AM</strong></td>
</tr>

<tr>
<td>Address: <strong>667 Pine Lodge Dr.</strong></td>
<td>Legal: <strong>N/A</strong></td>
</tr>
</table>

<table style="width: 100%; border-top: 1px solid black; border-bottom: 1px solid black; font-size: 8pt;">

<tr>
<td>Model: <strong>Franklin</strong></td>
<td>Elevation: <strong>B</strong></td>
<td>Size: <strong>1160 Cu. Ft.</strong></td>
<td>Style: <strong>Reciprocating</strong></td>
</tr>
</table>
<br>
<br>

<table class="change_order_items">

<tbody><tr><td colspan="6" align="left"><h1 style="text-align:left">Detalles del Pedido:</h1></td></tr>

</tbody><tbody>
<tr>
<th>Item</th>
<th>Importe</th>
<th>Quantity</th>
<th colspan="2">Unit Cost</th>
<th>Total</th>
</tr>

<?php
for ($i=0; $i < count($dataPedido); $i++) { ?>
<tr class="even_row">
<td style="text-align: center">1</td>
<td><?php echo $dataPedido[$i]['importe_prod_detalle'] ?></td>
<td style="text-align: center">50</td>
<td style="text-align: right; border-right-style: none;">$10.00</td>
<td class="change_order_unit_col" style="border-left-style: none;">Ea.</td>
<td class="change_order_total_col">$5,000.00</td>
</tr>
<?php } ?>





</tbody>




<tbody><tr>
<td colspan="3" style="text-align: right;">(Tax is not included; it will be collected on closing.)</td>
<td colspan="2" style="text-align: right;"><strong>GRAND TOTAL:</strong></td>
<td class="change_order_total_col"><strong>/s <?php echo number_format($dataCliente->total_importe,2,',','.') ?></strong></td></tr>
</tbody>
</table>


</div>
</div>
</body>
</html>

  

<?php
}
if($formato=='PDF'){
require_once("../../plugins/dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();

$dompdf->load_html(ob_get_clean());

$dompdf->render();
$pdf = $dompdf->output();
$filename = $dataCliente->numero_pedido.'.pdf';
file_put_contents('../../reportes/'.$filename, $pdf);
$file_to_save = '../../reportes/'.$filename;
$dompdf->stream($filename, array("Attachment" => 0));
}
?>


