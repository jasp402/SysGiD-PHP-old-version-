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

public function NombreDelMes($numMes){
  switch($numMes){
    case 1: return 'Enero'; break;
    case 2: return 'Febrero'; break;
    case 3: return 'Marzo'; break;
    case 4: return 'Abril'; break;
    case 5: return 'Mayo'; break;
    case 6: return 'Junio'; break;
    case 7: return 'Julio'; break;
    case 8: return 'Agosto'; break;
    case 9: return 'Septiembre'; break;
    case 10: return 'Octubre'; break;
    case 11: return 'Noviembre'; break;
    case 12: return 'Diciembre'; break;
    default: return 'Mes no existe';
  }
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

function numtoletras($xcifra)
{
    $xarray = array(0 => "Cero",
        1 => "", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                            
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                            
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO CON $xdecimales/100 SOLES";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN SOL CON $xdecimales/100";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= "CON $xdecimales/100 SOLES "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

// END FUNCTION

function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

// END FUNCTION

$Utilitario = new Utilitario;

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
//// guia de remisión
  $sql = "SELECT
    rem.nro_remision
  FROM
    facturas fac
  INNER JOIN remision rem ON rem.id_factura = fac.id_factura
  WHERE
    fac.id_factura = ".$_GET['idPedido']." ";
  $stmt = $db->query($sql);  
  $dataRemi = $stmt->fetchAll();
////
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


$miDia  = date('d');
$miMes  = $Utilitario->NombreDelMes(date('m'));
$miAnio = date('y');

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
<div style="font-size: 12px;">

<?php
$Utilitario->espacio_abajo(8);
echo $Utilitario->espacios_blanco(15);
echo $miDia; 
echo $Utilitario->espacios_blanco(15); 
echo $miMes; 
echo $Utilitario->espacios_blanco(19); 
echo $miAnio;


/// DATOS DEL CLIENTE
if ($dataCliente2->tipo_cliente == 'Juridico') {
    echo $Utilitario->espacio_abajo(2);
    echo $Utilitario->espacios_blanco(15);
    echo $dataCliente2->razonsocial;
    echo $Utilitario->espacio_abajo(2);
    echo $Utilitario->espacios_blanco(15);
    echo $dataCliente2->direccion_RUC." ".$dataCliente2->distrito." ".$dataCliente2->provincia." ".$dataCliente2->departamento;
    echo $Utilitario->espacio_abajo(2);
    echo $Utilitario->espacios_blanco(15);
    echo $dataCliente2->RUC;
    echo $Utilitario->espacios_blanco(100);
    for ($iR=0; $iR <count($dataRemi) ; $iR++) { 
      echo $dataRemi[$iR]['nro_remision'];
      echo $Utilitario->espacios_blanco(2);
    }
  }else if ($dataCliente2->tipo_cliente == 'Natural'){
    echo $Utilitario->espacio_abajo(2);
    echo $Utilitario->espacios_blanco(15);
    echo $dataCliente2->nombre." ".$dataCliente2->apellido;
    echo $Utilitario->espacios_blanco(100);
    echo $dataCliente2->DNI;
    echo $Utilitario->espacio_abajo(2);
    echo $Utilitario->espacios_blanco(15);
    echo $dataCliente2->direccion;
  }else{
    echo 'ERROR DE PROGRAMACIÓN';
  }

////PRODUCTOS
  echo $Utilitario->espacio_abajo(4);
if (count($dataPedido)>17) {
  echo 'EXISTE MUCHOS PRODUCTOS, POR FAVOR VERIFIQUE';
}else{
  echo '<table>';
  for ($i=0; $i <count($dataPedido); $i++) {
    $tipoP      = $dataPedido[$i]['tipo_producto']; 
    $categoriaP = $dataPedido[$i]['categoria']; 
    $nombreP    = $dataPedido[$i]['nombre_producto'];
    $medidaP    = $dataPedido[$i]['medida'];
    echo "<tr>";
    echo "<td>";
    echo $Utilitario->espacios_blanco(14);
    echo $dataPedido[$i]['cant_prod_detalle'];
    echo $Utilitario->espacios_blanco(5);
    echo "</td>";
    echo "<td>";
    echo $tipoP." ".$categoriaP." ".$nombreP." ".$medidaP;
    echo "</td>";
    echo "<td>";
    echo $Utilitario->espacios_blanco(10);
    echo "S/  ".$dataPedido[$i]['precio_prod_detalle'];
    echo "</td>";
    echo "<td>";
    echo $Utilitario->espacios_blanco(20);
    echo "S/  ".$dataPedido[$i]['importe_prod_detalle'];
    echo "</td>";
    echo "</tr>";
  }
  echo '</table>';
  $total     = $dataPedido2->suma; 
  $total_igv = $total * 0.18;
  $re_total  = ($total * 0.18) + $total;
  echo "<div style='bottom: 0 !important;bottom: -1px;position: absolute;'>";
  echo $Utilitario->espacios_blanco(22);
  echo numtoletras($re_total);
  echo $Utilitario->espacio_abajo(2);
  echo $Utilitario->espacios_blanco(200);
  echo "S/  ".$total;
  echo $Utilitario->espacio_abajo(2);
  echo $Utilitario->espacios_blanco(200);
  echo "S/  ".$total_igv;
  echo $Utilitario->espacio_abajo(2);
  echo $Utilitario->espacios_blanco(200);
  echo "S/  ".$re_total;
  echo $Utilitario->espacio_abajo(7);
  echo "</div>";
}


?>

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


