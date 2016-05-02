<?php ob_start(); //<-- No tocar! esto es lo que carga el documento en el cache y es lo que usa el DomPDF para crear el documento
/*
Saludos! 
--> Si puedes leer esto es por que eres el elegido...! <--
Bueno hermano aca te dejo el documento que hace que la magia de PDF sea posible.
intentare explicarte brevemente como funciona cada cosa... esta super sencillo
pero si tienes dudas escribeme...!  
*/
require '../../class/database.php'; //<-- Conecta a la Base de dato y usa las funciones que se crearon para facilitarnos la vida

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

if(isset($_GET['formato'])){  //Si recibe algo de donde lo enviaron... sino solo aparecera la pantalla en blanco

  $formato=$_GET['formato'];  //esto se usara luego (más abajo)


  //CONSULTAS MYSQL (Sin más que decir)
  //////////////////////////////////////////// 
  $db = getConnection();
  $sql="SELECT * FROM `ventas_clientes` as c, pedidos as p WHERE c.id_cliente = p.id_cliente AND p.id_pedido=".$_GET['idPedido']." ORDER BY `p`.`fecha_pedido` ASC";
  $stmt = $db->query($sql);  
  $dataCliente = $stmt->fetchObject();
  ////////////////////////////////////////////
  $sql="SELECT
  vcli.tipo_cliente,
  vcli.nombre,
  vcli.apellido,
  vcli.correo,
  vcli.contacto,
  vcli.telefono,
  vcli.telefono2,
  vcli.provincia,
  vcli.distrito,
  vcli.departamento,
  vcli.direccion,
  vcli.RUC,
  vcli.direccion_RUC,
  vcli.DNI,
  vcli.razonsocial
  FROM
    facturas fac
  INNER JOIN pedidos ped ON ped.id_pedido = fac.id_pedido
  INNER JOIN ventas_clientes vcli ON vcli.id_cliente = ped.id_cliente 
  WHERE
    fac.id_factura =".$_GET['idPedido']." ";
  $stmt = $db->query($sql);  
  $dataCliente2 = $stmt->fetchObject();
  ////////////////////////////////////////////
  // $db = null; 
  //CONSULTAS MYSQL (Sin más que decir)
  ////////////////////////////////////////////
  // $db = getConnection();
  // $sql="SELECT * FROM `pedidos_detalles` WHERE `id_pedido`=".$_GET['idPedido']."";
  $sql = "SELECT
  fac.id_pedido,
  fac.nro_factura,
  fac.fecha_reg_factura,
  fac.fecha_venc_factura,
  fac.cant_prod_factura,
  fac.importe_prod_factura,
  fac.estatus_fact,
  ped.total_importe,
  ped.cant_productos_pedido,
  peddt.precio_prod_detalle,
  peddt.cant_prod_detalle,
  peddt.importe_prod_detalle,
  prod.nombre_producto,
  prod.medida,
  procat.nombre as categoria,
  protip.nombre as tipo_producto
  FROM
    facturas fac
  INNER JOIN pedidos ped ON ped.id_pedido = fac.id_pedido
  INNER JOIN pedidos_detalles peddt ON peddt.id_pedido = ped.id_pedido
  INNER JOIN producto prod ON prod.id_producto = peddt.id_producto
  INNER JOIN producto_categoria procat ON procat.idcategoria = prod.idcategoria
  INNER JOIN producto_tipo protip ON protip.idtipo_producto = prod.idtipo_producto
  WHERE
    fac.id_factura = ".$_GET['idPedido']." ";
  $stmt = $db->query($sql);  
  $dataPedido = $stmt->fetchAll();

  $sql="SELECT
  SUM(pedt.importe_prod_detalle) as suma
  FROM
    facturas fac
  INNER JOIN pedidos ped ON ped.id_pedido = fac.id_pedido
  INNER JOIN pedidos_detalles pedt ON  pedt.id_pedido = ped.id_pedido
  WHERE
  fac.id_factura =".$_GET['idPedido']."";
  $stmt = $db->query($sql);  
  $dataPedido2 = $stmt->fetchObject();
  /////////////////////////////////////////
  $sql = "SELECT
  fac.id_pedido,
  fac.nro_factura,
  fac.fecha_reg_factura,
  fac.fecha_venc_factura,
  fac.cant_prod_factura,
  fac.importe_prod_factura,
  fac.estatus_fact
  FROM
    facturas fac
  WHERE
    fac.id_factura =".$_GET['idPedido']."";
  $stmt = $db->query($sql);  
  $dataFacturaGeneral = $stmt->fetchObject();

//Apartir de aqui el HTML es todo tuyo puedes modificarlo como quieras! :)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Document</title>
    <link rel="stylesheet" href="../../dist/css/Print.css">
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
        $('#buttonEscrito').click();
        var data = $('.escritoEnviar').val().trim();
        $('#escritoText').html(data);
      });
    </script>
</head>

<body>
<div id="body">

<div id="section_header">
</div>

<div id="content">
  
<div class="page" style="font-size: 7pt">

<h1 style="text-align: right;  margin-bottom:-5px"><b>FACTURA # <?php echo $dataFacturaGeneral->nro_factura;?></b></h1>
<h2 style="text-align: right; margin-top:0px">fecha: <?php echo $dataFacturaGeneral->fecha_reg_factura; ?></h2>
<table style="width: 100%;" class="header">
<tr>
<td><h1>
<?php 
if ($dataCliente2->tipo_cliente == 'Juridico') {
    echo $dataCliente2->razonsocial;
  }else if ($dataCliente2->tipo_cliente == 'Natural'){
    $Nom_CliNA = $dataCliente2->nombre;
    $Ape_CliNa = $dataCliente2->apellido;
    echo $Nom_CliNA." ".$Ape_CliNa;
  }else{
    echo 'ERROR DE PROGRAMACIÓN';
  }
?>

</h1></td>
</tr>
</table>

<table style="width: 100%; font-size: 8pt;">
<?php 
if ($dataCliente2->tipo_cliente == 'Juridico') {
    echo '<tr>';
    echo '<td>RUC: <strong>';
    echo $dataCliente2->RUC;
    echo '</strong></td>';
    echo '<td>Departamento: <strong>';
    echo $dataCliente2->departamento;
    echo '</strong></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>CORREO: <strong>';
    echo $dataCliente2->correo;
    echo '</strong></td>';
    echo '<td>Provincia: <strong>';
    echo $dataCliente2->provincia;
    echo '</strong></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>TELEFONO: <strong>';
    echo $dataCliente2->telefono;
    echo '</strong></td>';
    echo '<td>Distrito: <strong>';
    echo $dataCliente2->distrito;
    echo '</strong></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>TELEFONO 2: <strong>';
    echo $dataCliente2->telefono2;
    echo '</strong></td>';
    echo '<td>Dirección: <strong>';
    echo $dataCliente2->direccion_RUC;
    echo '</strong></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>Contacto : <strong>';
    echo $dataCliente2->contacto;
    echo '</strong></td>';
    echo '<td><strong>';
    echo '</strong></td>';
    echo '</tr>';


  }else if ($dataCliente2->tipo_cliente == 'Natural'){
    echo '<tr>';
    echo '<td>DNI: <strong>';
    echo $dataCliente2->DNI;
    echo '</strong></td>';
    echo '<td>Departamento: <strong>';
    echo $dataCliente2->departamento;
    echo '</strong></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>CORREO: <strong>';
    echo $dataCliente2->correo;
    echo '</strong></td>';
    echo '<td>Provincia: <strong>';
    echo $dataCliente2->provincia;
    echo '</strong></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>TELEFONO: <strong>';
    echo $dataCliente2->telefono;
    echo '</strong></td>';
    echo '<td>Distrito: <strong>';
    echo $dataCliente2->distrito;
    echo '</strong></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>TELEFONO 2: <strong>';
    echo $dataCliente2->telefono2;
    echo '</strong></td>';
    echo '<td>Dirección: <strong>';
    echo $dataCliente2->direccion;
    echo '</strong></td>';
    echo '</tr>';
  }else{
    echo 'ERROR DE PROGRAMACIÓN';
  }
?>
</table>

<br>
<br>

<table class="change_order_items">

<tbody><tr><td colspan="6" align="left"><h1 style="text-align:left">Detalles de la factura:</h1></td></tr>

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
<td style="text-align: center; font-size: 10px;">
<?php 
$tipoP      = $dataPedido[$i]['tipo_producto']; 
$categoriaP = $dataPedido[$i]['categoria']; 
$nombreP    = $dataPedido[$i]['nombre_producto'];
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
<td colspan="4" style="">
<input style="display: none;" id="num" value="<?php $total = $dataPedido2->suma; echo ($total * 0.18) + $total; ?>">
<input  style="display:none;" type="button" id="buttonEscrito" onclick="nn(document.getElementById('num').value);">
<br>
<input id="esc" class="escritoEnviar" style="display:none;">
<span style='font-size: 12px; font-weight: bold;' id="escritoText"></span>
</td>
<td colspan="1" style="text-align: right;"><strong>TOTAL:</strong></td>
<td style="text-align: center"><strong><?php $total = $dataPedido2->suma; echo ($total * 0.18) + $total; ?></strong></td>
</tr>
</tbody>
</table>

<table>
  <tr>
    <td>
      <?php  ?>
    </td>
  </tr>
</table>


</div>
</div>
<script>
var o=new Array("DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISÉIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE", "VIENTE", "VEINTIUNO", "VEINTIDÓS", "VEINTITRÉS", "VEINTICUATRO", "VEINTICINCO", "VEINTISÉIS", "VEINTISIETE", "VEINTIOCHO", "VEINTINUEVE");
var u=new Array("CERO", "UNO", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE");
var d=new Array("", "", "", "TREINTA", "CUARENTA", "CINCUENTA", "SESENTA", "SETENTA", "OCHENTA", "NOVENTA");
var c=new Array("", "CIENTO", "DOSCIENTOS", "TRESCIENTOS", "CUATROCIENTOS", "QUINIENTOS", "SEISCIENTOS", "SETECIENTOS", "OCHOCIENTOS", "NOVECIENTOS");
 
function nn(n)
{
  var n=parseFloat(n).toFixed(2); /*se limita a dos decimales, no sabía que existía toFixed() :)*/
  var p=n.toString().substring(n.toString().indexOf(".")+1); /*decimales*/
  var m=n.toString().substring(0,n.toString().indexOf(".")); /*número sin decimales*/
  var m=parseFloat(m).toString().split("").reverse(); /*tampoco que reverse() existía :D*/
  var t="";
 
  /*Se analiza cada 3 dígitos*/
  for (var i=0; i<m.length; i+=3)
  {
    var x=t;
    /*formamos un número de 2 dígitos*/
    var b=m[i+1]!=undefined?parseFloat(m[i+1].toString()+m[i].toString()):parseFloat(m[i].toString());
    /*analizamos el 3 dígito*/
    t=m[i+2]!=undefined?(c[m[i+2]]+" "):"";
    t+=b<10?u[b]:(b<30?o[b-10]:(d[m[i+1]]+(m[i]=='0'?"":(" y "+u[m[i]]))));
    t=t=="CIENTO CERO"?"CIEN":t;
    if (2<i&&i<6)
      t=t=="UNO"?"MIL ":(t.replace("UNO","UN")+" MIL ");
    if (5<i&&i<9)
      t=t=="UNO"?"UN MILLÓN ":(t.replace("UNO","UN")+" MILLONES ");
    t+=x;
    //t=i<3?t:(i<6?((t=="uno"?"mil ":(t+" mil "))+x):((t=="uno"?"un millón ":(t+" millones "))+x));
  }
 
  t+=" CON "+p+"/100 NUEVOS SOLES";
  /*correcciones*/
  t=t.replace("  "," ");
  t=t.replace(" CERO","");
  //t=t.replace("ciento y","cien y");
  //alert("Numero: "+n+"\nNº Dígitos: "+m.length+"\nDígitos: "+m+"\nDecimales: "+p+"\nt: "+t);
  document.getElementById("esc").value=t;
  return t;
}
 
//function st()
//{
//  var t="<table><tr><th>número</th><th>escrito</th></tr>";
//  for (var i=2; i<1000000; i+=892.45)
//    t+="<tr><td>"+i.toFixed(2)+"</td><td>"+nn(i)+"</td></tr>";
//  t+="</table>";
  //document.getElementById('out').innerHTML=t;
//}
//window.onload=st;
</script>
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


