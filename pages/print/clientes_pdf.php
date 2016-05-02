<?php ob_start(); //<-- No tocar! esto es lo que carga el documento en el cache y es lo que usa el DomPDF para crear el documento

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

public function espacios_blanco($num){
  for ($i=0; $i < $num ; $i++) { 
    echo '&nbsp;';
  }
}

public function espacio_abajo($num){
  for ($i=0; $i < $num ; $i++) { 
    echo '<br>';
  }
}

}

$Utilitario = new Utilitario;

if(isset($_GET['formato'])){  //Si recibe algo de donde lo enviaron... sino solo aparecera la pantalla en blanco

  $formato=$_GET['formato'];  //esto se usara luego (más abajo)

  //////////////////////////////////////////// 
  $db = getConnection();
  $sql="SELECT * FROM ventas_clientes vcli WHERE vcli.id_cliente = ".$_GET['idPedido']." ";
  $stmt = $db->query($sql);  
  $dataCliente = $stmt->fetchObject();
  //////////////////////////////////////////// 
  //////////////////////////////////////////// 
  $sql = "SELECT
          ped.fecha_pedido,
          ped.numero_pedido,
          ped.cant_productos_pedido,
          ped.total_importe,
          ped.comentario
        FROM
          pedidos ped
        INNER JOIN ventas_clientes vcli ON vcli.id_cliente =  ped.id_cliente
        WHERE vcli.id_cliente = ".$_GET['idPedido']." ";
  $stmt = $db->query($sql);   
  $dataPedido = $stmt->fetchAll();
  //////////////////////////////////////////// 
  ////////////////////////////////////////////
  $sql = "SELECT
            fac.fecha_reg_factura,
            fac.nro_factura,
            fac.importe_prod_factura,
            fac.estatus_fact
          FROM
            pedidos ped
          INNER JOIN ventas_clientes vcli ON vcli.id_cliente =  ped.id_cliente
          INNER JOIN facturas fac ON fac.id_pedido = ped.id_pedido
          WHERE vcli.id_cliente = ".$_GET['idPedido']." ";
  $stmt = $db->query($sql);   
  $dataFactura = $stmt->fetchAll(); 
  //////////////////////////////////////////// 
  ////////////////////////////////////////////
    $sql = "SELECT
          pag.fecha_pago,
          pag.metodo_pago,
          pag.banco_pago,
          pag.ref_pago,
          pag.monto_abono
        FROM
           pagos pag
        INNER JOIN ventas_clientes vcli ON vcli.id_cliente =  pag.id_cliente
        WHERE vcli.id_cliente = ".$_GET['idPedido']." ";
  $stmt = $db->query($sql);   
  $dataAbono = $stmt->fetchAll(); 



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

<div id="content">
  
<div class="page" style="font-size: 7pt">
<!--/// DATOS DEL CLIENTE -->
<h1 style="text-align: center;  margin-bottom:-5px">
<b>
  <?php
    if ($dataCliente->tipo_cliente == 'Juridico') {
      echo $dataCliente->razonsocial;
    }else if ($dataCliente->tipo_cliente == 'Natural'){
      echo $dataCliente->nombre." ".$dataCliente->apellido;
    }else{
      echo "Error, no se encontro al Cliente";
    }
  ?>
</b>
</h1>
<br/>

<?php 
  $Utilitario->espacio_abajo(4);
?>
<table>
<tbody>
 <?php 
  if ($dataCliente->tipo_cliente == 'Juridico') {
      echo '<tr>';
      echo '<td>';
      echo $Utilitario->espacios_blanco(25);
      echo '</td>';
      echo '<td>';
      echo 'RUC: <strong>';
      echo $dataCliente->RUC;
      echo $Utilitario->espacios_blanco(50);
      echo '</strong> </td>';
      echo '<td>';
      echo 'Dirección: <strong>';
      echo $dataCliente->direccion_RUC;
      echo '</strong> </td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>';
      echo $Utilitario->espacios_blanco(25);
      echo '</td>';
      echo '<td>';
      echo 'Contacto: <strong>';
      echo $dataCliente->contacto;
      echo $Utilitario->espacios_blanco(50);
      echo '</strong> </td>';
      echo '<td>';
      echo 'Telefono: <strong>';
      echo $dataCliente->telefono;
      echo '</strong> </td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>';
      echo $Utilitario->espacios_blanco(25);
      echo '</td>';
      echo '<td>';
      echo 'Correo: <strong>';
      echo $dataCliente->correo;
      echo $Utilitario->espacios_blanco(50);
      echo '</strong> </td>';
      echo '<td>';
      echo 'Telefono 2: <strong>';
      echo $dataCliente->telefono2;
      echo '</strong> </td>';
      echo '</tr>';

    }else if ($dataCliente->tipo_cliente == 'Natural'){
      echo '<tr>';
      echo '<td>';
      echo $Utilitario->espacios_blanco(50);
      echo '</td>';
      echo '<td>';
      echo 'DNI: <strong>';
      echo $dataCliente->DNI;
      echo $Utilitario->espacios_blanco(50);
      echo '</strong> </td>';
      echo '<td>';
      echo 'Dirección: <strong>';
      echo $dataCliente->direccion;
      echo '</strong> </td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>';
      echo $Utilitario->espacios_blanco(50);
      echo '</td>';
      echo '<td>';
      echo 'Telefono: <strong>';
      echo $dataCliente->telefono;
      echo $Utilitario->espacios_blanco(50);
      echo '</strong> </td>';
      echo '<td>';
      echo 'Correo: <strong>';
      echo $dataCliente->Correo;
      echo '</strong> </td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>';
      echo $Utilitario->espacios_blanco(50);
      echo '</td>';
      echo '<td>';
      echo 'Telefono 2: <strong>';
      echo $dataCliente->telefono2;
      echo $Utilitario->espacios_blanco(50);
      echo '</strong> </td>';
      echo '<td>';
      echo 'Departamento: <strong>';
      echo $dataCliente->departamento;
      echo '</strong> </td>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>';
      echo $Utilitario->espacios_blanco(50);
      echo '</td>';
      echo '<td>';
      echo 'Provincia: <strong>';
      echo $dataCliente->provincia;
      echo $Utilitario->espacios_blanco(50);
      echo '</strong> </td>';
      echo '<td>';
      echo 'Distrito: <strong>';
      echo $dataCliente->distrito;
      echo '</strong> </td>';
      echo '</tr>';

    }else{
      echo "Error, no se encontro al Cliente";
    }
  ?>
</tbody>
</table>

<!-- MONTOS Y FECHA-->
<h1 style="text-align: left;  margin-bottom:-5px">
Saldo Actual: <?php echo "S/ ".$dataCliente->saldo_actual; ?> 
</h1>
<h2 style="text-align: left; margin-top:0px">
Fecha y hora de generación: <?php echo date('d/m/Y H:i'); ?>
</h2>
<!-- FIN MONTOS Y FECHA-->

<table class="change_order_items">
  <tbody>
  <tr>
  <th colspan="6">
  <h1>PEDIDOS</h1>
  </th>
  </tr>
  <tr>
  <th>#</th>
  <th>Fecha</th>
  <th>Nro. Guia</th>
  <th>Cant. Productos</th>
  <th>Importe</th>
  <th>Total + IGV</th>
  </tr>
    <?php
      for ($i=0; $i <count($dataPedido); $i++) { 
        echo "<tr>";
          echo "<td style='text-align:center;'>";
          $ii = $i +1; echo $ii;
          echo "</td>";
          echo "<td style='text-align:center;'>";
          $fecha_p = $Utilitario->cambiaf_a_normal($dataPedido[$i]['fecha_pedido']);
          echo $fecha_p;
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataPedido[$i]['numero_pedido'];
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataPedido[$i]['cant_productos_pedido'];
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataPedido[$i]['total_importe'];
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo ($dataPedido[$i]['total_importe'] *0.18)+$dataPedido[$i]['total_importe'];
          echo "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>


<table class="change_order_items">
  <tbody>
  <tr>
  <th colspan="5">
  <h1>FACTURAS</h1>
  </th>
  </tr>
  <tr>
  <th>#</th>
  <th>Fecha</th>
  <th>Nro. Factura</th>
  <th>Importe</th>
  <th>Estado</th>
  </tr>
    <?php
      for ($i=0; $i <count($dataFactura); $i++) { 
        echo "<tr>";
          echo "<td style='text-align:center;'>";
          $ii = $i +1; echo $ii;
          echo "</td>";
          echo "<td style='text-align:center;'>";
          $fecha_p = $Utilitario->cambiaf_a_normal($dataFactura[$i]['fecha_reg_factura']);
          echo $fecha_p;
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataFactura[$i]['nro_factura'];
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataFactura[$i]['importe_prod_factura'];
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataFactura[$i]['estatus_fact'];
          echo "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>

<table class="change_order_items">
  <tbody>
  <tr>
  <th colspan="6">
  <h1>ABONOS</h1>
  </th>
  </tr>
  <tr>
  <th>#</th>
  <th>Fecha</th>
  <th>Tipo de pago</th>
  <th>Banco</th>
  <th>Ref</th>
  <th>Monto</th>
  </tr>
    <?php
      for ($i2=0; $i2 <count($dataAbono); $i2++) { 
        echo "<tr>";
          echo "<td style='text-align:center;'>";
          $ii2 = $i2 +1; echo $ii2;
          echo "</td>";
          echo "<td style='text-align:center;'>";
          $fecha_pago = $Utilitario->cambiaf_a_normal($dataAbono[$i2]['fecha_pago']);
          echo $fecha_pago;
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataAbono[$i2]['metodo_pago'];
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataAbono[$i2]['banco_pago'];
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataAbono[$i2]['ref_pago'];
          echo "</td>";
          echo "<td style='text-align:center;'>";
          echo $dataAbono[$i2]['monto_abono'];
          echo "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>

</div>
</div>
</div>
</body>
</html>

  

<?php
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

