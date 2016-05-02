//-----------------------------------------------------------------------------CONTROL TRANSPORTE
app.controller('ngControlPedidos', function(public,query,Factory, SQLGlobal, $scope, $http, $location, $routeParams, $timeout,$filter, sweet, AlertGlobal){ // $scope.chart = CharsGlobal;
  $scope.public   = public;
  $scope.alert    = AlertGlobal;
  $scope.SQL      = SQLGlobal;

  $scope.alert.bienvenida('Pedidos','¡Porfavor No desespere!'); 
  $scope.public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
  $scope.public.ngTitle = 'SysGiD | Productos'; 

//LA TABLA sUBMODULO DEBERIA TENER UN CAPO DE DESCRIPCION PARA USARLO EN LA PARTE INFERIOR DE LOS BOTONES
   $scope.cambiarVista =function(value){
  $scope.public.ngVista = value; 
  }









//---------------------------------PEDIDOS---------------------------------------------------------



$scope.listarClientes();



 $scope.inputCounter = 0;

 //Asigna un id="" al input
    $scope.inputs = [{
      id: 'input'
    }];

//funcion para agregar
    $scope.add = function() {
//Crea un inputTemporal o Plantilla donde agrega id="imput-0" y name=""      
      $scope.inputTemplate = {
        id: 'input-' + $scope.inputCounter,
        name: ''
      };
//Incrementa el contador ++
      $scope.inputCounter += 1;
//Agrega el input temporal a inputs. cuando incrementa el array se puede usar el ng-repeat
      $scope.inputs.push($scope.inputTemplate);
    }

      $scope.removeItem = function (item) {
        confirmar=confirm("¿Desea quitar este Producto?");
        if(confirmar){
        $scope.inputs.splice(item, 1);
        $scope.sumar(fdata);
        }
      }
 
$scope.suma = 0;
$scope.sumar = function(fdata){
$scope.suma = 0;
  for(i=0;i<$scope.inputs.length;i++){
    if(typeof(fdata.productos[i].precio) != "undefined"){
     // alert($scope.inputs[i].cant[i])
$scope.subtotal=(parseInt($scope.inputs[i].cant[i]) * parseInt(fdata.productos[i].precio));
$scope.suma = $scope.subtotal+$scope.suma;
}
    // console.log($scope.subtotal)
  }
return $scope.suma;
 
}

//-----------------------------Control de Ventas [PEDIDOS]------------------------------------------------------------------------------
//LISTAR PEDIDOS
/* Mudada esta funcion al ngControlPrincipal - Por ser generica y no requerir de parametros para su ejecucion
$scope.listarPedidos = function(){
   $scope.sql = "SELECT * FROM `pedidos` ORDER BY id_pedido DESC"; 
   $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.ListarPedidos = data;});
  //Total de Importe en Pedidos
   $scope.sql ="SELECT sum(`total_importe`) as importe_acumulado FROM `pedidos`";
   $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.Acumulado = data[0].importe_acumulado;});
  //Consulta los pedido mas los detalles Usa las tabla (Pedidos, ventas_clietnes)
   $scope.sql="SELECT * FROM `ventas_clientes` as c, pedidos as p WHERE c.id_cliente = p.id_cliente ORDER BY `p`.`fecha_pedido` ASC";
   $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.consularPedido = data;});
}
*/
$scope.listarPedidos();


$scope.PedidosxCliente =function(id){
$scope.sql="SELECT * FROM `pedidos` WHERE `id_cliente` ="+id+"";
console.log($scope.sql)
$http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.CantPedidos = data;});
}

$scope.detallePedido = function(){
  $scope.DetallePedidos = [];
  for(i=0;i<$scope.CantPedidos.length;i++){
    $scope.sql="SELECT * FROM producto_tipo as prt, producto_categoria as prc, producto as pr, `pedidos_detalles` as pd, pedidos as p WHERE pr.idtipo_producto=prt.idtipo_producto AND pr.idcategoria = prc.idcategoria AND pd.id_producto = pr.id_producto AND `id_cliente` ="+$scope.CantPedidos[i].id_cliente+" AND pd.id_pedido = p.id_pedido AND p.numero_pedido='"+$scope.CantPedidos[i].numero_pedido+"'";    console.log($scope.sql);
    $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.DetallePedidos.push(data);});
    
  }
}




//Registrar Pre-Factura (Pedidos)
$scope.registrarPedido = function(fdata){
  $scope.PedidosxCliente(fdata.id_cliente);

  //alert(fdata.ventaPedido)
  $scope.fecha = new Date(); 
  $scope.TotalCant = 0;
    for (i=0;i<$scope.inputs.length;i++) {
    $scope.TotalCant   = ($scope.inputs[i].cant[i]+$scope.TotalCant); 
    }
  fdata.cantTotal = $scope.TotalCant;
  fdata.id_cliente = $scope.id_cliente;
  fdata.total = $scope.suma;
    if( typeof(fdata.comentario) == 'undefined'){fdata.comentario=''}
    if($scope.ListarPedidos=='')
      {//alert('si esta vacio');
    $scope.numPedido=0}
    else{$scope.numPedido=parseInt($scope.ListarPedidos[0].numero_pedido)}

  //Insertar Registro en Pedidos
  $scope.sql="INSERT INTO `pedidos`(`numero_pedido`,`fecha_pedido`, `cant_productos_pedido`, `total_importe`, `id_cliente`, `comentario`, `estatus_pedido`, `tipo_venta`) VALUES ('"+($scope.numPedido+1)+"','"+$scope.fecha.toISOString().slice(0,10)+"','"+fdata.cantTotal+"','"+fdata.total+"','"+fdata.id_cliente+"','"+fdata.comentario+"','PENDIENTE','"+fdata.ventaPedido+"')";
  $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){   });
  console.log($scope.sql);
  //Actualizar Usuario Total_Pedidos

  $scope.sql="UPDATE `ventas_clientes` SET `total_pedidos`="+($scope.CantPedidos.length+1)+" WHERE `id_cliente`="+fdata.id_cliente+"";
  $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){});
  
console.log($scope.sql);
  $scope.public.temp = true;


//descontar del Stock de porductos los que se acaban de registrar
  for (i=0;i<$scope.inputs.length;i++) {
    fdata.id_producto= fdata.productos[i].id_producto;
    fdata.cantidad   = (fdata.productos[i].disponible - $scope.inputs[i].cant[i]); 
    $scope.sqlUpdate ="UPDATE `producto` SET `disponible`="+fdata.cantidad+"  WHERE `id_producto`="+fdata.id_producto+";";
    $http.post("class/angularSql.php", {ExecutetSQL:$scope.sqlUpdate}).success(function(data){ }); 
  }
  
  if($scope.ListarPedidos==''){fdata.id_pedido = 1}else{fdata.id_pedido = ($scope.ListarPedidos[0].id_pedido+1)}

//registrar los detalles del Pedido en la tabla [pedidos_detalles]
  for (i=0;i<$scope.inputs.length;i++) {
    fdata.id_producto= fdata.productos[i].id_producto;
    fdata.cantidad   = $scope.inputs[i].cant[i]; 
    fdata.precio     = fdata.productos[i].precio;
    fdata.total_precio=(fdata.productos[i].precio*$scope.inputs[i].cant[i]); 
    $scope.sql="INSERT INTO `pedidos_detalles`(`id_pedido`, `id_producto`, `cant_prod_detalle`, `precio_prod_detalle`, `importe_prod_detalle`, `color_pedido`) VALUES ('"+fdata.id_pedido+"', '"+fdata.id_producto+"', '"+fdata.cantidad+"', '"+fdata.precio+"',  '"+fdata.total_precio+"', '"+fdata.color[i]+"')"; 
    console.log($scope.sql);
    $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){ window.location = '#/pedidos' }); 
  }


  window.location = '#/pedidos';  
  alert('¡Pedido Registrado exitosamente!');
  $scope.listarPedidos();
}


if($scope.public.temp){
  $timeout(function(){  $scope.public.temp = false }, 15000);
}





//-----------------------------------[PEDIDOS]-------------------------------------------------------------
//Variables iniciales
/*
$scope.fdata.producto     = [];
$scope.fdata.idproducto   = [];
$scope.fdata.detalleFact  = [];
$scope.fdata.precioFact   = [];
$scope.sumarFact = [];
$scope.BuscarFactura = "";
$scope.select =true; 
*/
//if($scope.ListarProdcFact){$scope.isChecked()}








$scope.cargarFactura=function(factura){
  confirmar=confirm("¿Crear Factura para la guia N° "+factura.numero_pedido+"?"); 
  if (confirmar){
  $scope.id_factura = factura.id_pedido; //tenemos una variable $scope con el id_factura (Lo usaremos luego para registrar la guia de Remision)
  $scope.successInput = true;             //Decimos que esta activo para mostrar la lista de las facturas
    var datos;
        if(factura.DNI === 0){datos = factura.RUC;
        }else{                datos = factura.DNI; }
        if(factura.razonsocial == ''){datos = datos+' - '+factura.nombre;
        }else{                        datos = datos+' - '+factura.razonsocial; }
  $scope.Cliente = datos;
   $scope.nroGuia = factura.numero_pedido;
  $scope.Factura =factura.nro_factura;
  $scope.idCliente =factura.id_cliente;
$scope.datosClientes = factura;
  
  $scope.sql="SELECT * FROM producto_tipo as prt, producto_categoria as prc, producto as pr, `pedidos_detalles` as pd, pedidos as p WHERE pr.idtipo_producto=prt.idtipo_producto AND pr.idcategoria = prc.idcategoria AND pd.id_producto = pr.id_producto AND `id_cliente` ="+factura.id_cliente+" AND pd.id_pedido = p.id_pedido AND p.numero_pedido='"+factura.numero_pedido+"'";
  $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.ListarProdcFact = data; $scope.isChecked();});
  }
}


    /*
    $scope.cargarFacturaRemision=function(factura){
      
      confirmar=confirm("¿Crear Guia de Remision para la Pedido N° "+factura.nro_factura+"?"); 
      if (confirmar){
      $scope.id_factura = factura.id_pedido; //tenemos una variable $scope con el id_factura (Lo usaremos luego para registrar la guia de Remision)
      $scope.successInput = true;             //Decimos que esta activo para mostrar la lista de las facturas
        var datos;
            if(factura.DNI === 0){datos = factura.RUC;
            }else{                datos = factura.DNI; }
            if(factura.razonsocial == ''){datos = datos+' - '+factura.nombre;
            }else{                        datos = datos+' - '+factura.razonsocial; }
      $scope.Cliente = datos;
       $scope.nroGuia = factura.numero_pedido;
      $scope.Factura =factura.nro_factura;
      $scope.idCliente =factura.id_cliente;
    $scope.datosClientes = factura;
      
      $scope.sql="SELECT * FROM producto_tipo as prt, producto_categoria as prc, producto as pr, `pedidos_detalles` as pd, pedidos as p WHERE pr.idtipo_producto=prt.idtipo_producto AND pr.idcategoria = prc.idcategoria AND pd.id_producto = pr.id_producto AND `id_cliente` ="+factura.id_cliente+" AND pd.id_pedido = p.id_pedido AND p.numero_pedido='"+factura.numero_pedido+"' AND pd.nro_factura='"+factura.nro_factura+"'";
      console.log($scope.sql)
      $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.ListarProdFactRem = data; $scope.isChecked2();});
      }
    }
    */

$scope.cargarProdRemision=function(factura){
  
  confirmar=confirm("¿Crear Guia de Remision para la Pedido N° "+factura.numero_pedido+"?"); 
  if (confirmar){
  $scope.id_factura = factura.id_pedido; //tenemos una variable $scope con el id_factura (Lo usaremos luego para registrar la guia de Remision)
  $scope.successInput = true;             //Decimos que esta activo para mostrar la lista de las facturas
    var datos;
        if(factura.DNI === 0){datos = factura.RUC;
        }else{                datos = factura.DNI; }
        if(factura.razonsocial == ''){datos = factura.nombre +' - '+ datos;
        }else{                        datos = factura.razonsocial +' - '+ datos;}
  $scope.Cliente = datos;
  $scope.nroGuia = factura.numero_pedido;
  $scope.idPedido =factura.id_pedido;
  $scope.idCliente =factura.id_cliente;
  $scope.datosClientes = factura;
  
  $scope.sql="SELECT * FROM producto_tipo as prt, producto_categoria as prc, producto as pr, `pedidos_detalles` as pd, pedidos as p WHERE pr.idtipo_producto=prt.idtipo_producto AND pr.idcategoria = prc.idcategoria AND pd.id_producto = pr.id_producto AND `id_cliente` ="+factura.id_cliente+" AND pd.id_pedido = p.id_pedido AND p.numero_pedido='"+factura.numero_pedido+"'";
  console.log($scope.sql)
  $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.ListarProdFactRem = data; $scope.isChecked2(); $scope.pedidoDespachado($scope.idPedido)});
  }
}




$scope.cambiarfact = function(){
 $scope.successInput = false;
 $scope.BuscarFactura= "";
 $scope.ListarProdcFact='';
}



$scope.restarFact = function(e,value){
  if(e==false){
    $scope.sumarfact = ($scope.sumarfact-value)
  }else{
    $scope.sumarfact = ($scope.sumarfact+value)
  }
}


$scope.isChecked = function(){
  $scope.sumarfact = 0;
  $scope.totalProductos = ($scope.ListarProdcFact.length); //Total de Productos en la Factura

//Recorremos cada producto y extraemos el id_producto/id_pedido_detalle/importe_producto_detalle
  for (i=0;i<$scope.ListarProdcFact.length;i++){
    $scope.fdata.idproducto[i] = $scope.ListarProdcFact[i].id_producto; 
    $scope.fdata.detalleFact[i] = $scope.ListarProdcFact[i].id_pedido_detalle;
    $scope.fdata.precioFact[i] = $scope.ListarProdcFact[i].importe_prod_detalle;
//Si a ese Producto tiene asignado un estatus (Nro. Factura) entonces se ignora. colocandole un False en fdata.producto
      if($scope.ListarProdcFact[i].estatus == null){
            $scope.fdata.producto[i] = true;
            $scope.sumarfact = parseInt($scope.ListarProdcFact[i].importe_prod_detalle)+$scope.sumarfact;
      }else{$scope.fdata.producto[i] = false}
  }

}
//PARA GUAS
$scope.isChecked2 = function(){
  $scope.totalProductos = ($scope.ListarProdFactRem.length);
  for (i=0;i<$scope.totalProductos;i++){
    $scope.fdata.idproducto[i] = $scope.ListarProdFactRem[i].id_producto;
    $scope.fdata.detalleFact[i] = $scope.ListarProdFactRem[i].id_pedido_detalle;

      if($scope.ListarProdFactRem[i].nro_remision == null){
            $scope.fdata.producto[i] = true;
      }else{$scope.fdata.producto[i] = false}
  }
}



$scope.sumarDescuento = 0;
//Sumar el Importe de producto de la factura
$scope.sumarFactura = function(e,value,cant){
  if(value){
    if(e==false){
      $scope.sumarDescuento -= (parseInt(value)*parseInt(cant)); 
      
    }else{
      $scope.sumarDescuento += (parseInt(value)*parseInt(cant)); 
    }
  }

          

return  $scope.sumarDescuento;
 
}






//RESGISTRAR FACTURA
$scope.registrarGuia=function(fdata){     

  /*
    Campos requeridos para llenar la tabla [facturas]
    //     = id_factura (AutoIcrementable)
    //     = id_pedido
    //     = nro_factura
    //     = fecha_reg_factura
    //     = fecha_venc_factura
    //     = cant_prod_factura
    //     = importe_prod_factura
    //     = estatus

    Valores a utiliza
      console.log($scope.datosClientes.id_pedido)      
      console.log(fdata.nro_factura)               
      console.log($scope.fecha_inicio.toISOString().slice(0,10)) 
      console.log(fdata.fecha_venc_factura.toISOString().slice(0,10))  
      console.log($scope.productoEnGuia) 
      console.log($scope.fdata.importeFact) 
  */

  $scope.fecha_inicio = new Date();
  $scope.slqArray = [];
  $scope.productoEnGuia=0;
  $scope.fdata.importeFact = 0 

//Analizamos si de los productos listados alguno ya fue facturado; 
//si tienen algun valor en el campo nro_factura entonces si fue facturado ese producto.
  for (i=0;i<$scope.ListarProdcFact.length;i++){  
        if($scope.ListarProdcFact[i].nro_factura){
          $scope.productoEnGuia += 1;
        }
  }
//Analizamos si todos los productos ya fueron facturados 
// y determinamos cuantos productos van hacer facturados
  if($scope.ListarProdcFact.length === $scope.productoEnGuia){
      alert('¡Todos los Productos de esta Factura Fueron entregados!')
  }else{
    for (i=0;i<$scope.totalProductos;i++){ 
      if($scope.fdata.producto[i] == true){
        $scope.fdata.importeFact += $scope.ListarProdcFact[i].importe_prod_detalle;
        $scope.productoEnGuia += 1;
      }
   }

if($scope.productoEnGuia==0){
  alert('Debe seleccionar al menos (1) Producto');
}else{
  //Si son marcados todos los productos disponibles entonces el estatus de la factura sera COMPETO.
  //if($scope.totalProductos === $scope.productoEnGuia){fdata.estatus='Completo'}else{fdata.estatus='Incompleto'} <<--Revisar para ver si podemos cambiar el status de PEDIDO

  //$scope.sql="INSERT INTO `pedidos`(`numero_pedido`, `punto_partida`, `punto_llegada`, `id_factura`, `id_cliente`, `idtransportista`, `estatus`) VALUES ('"+fdata.fecha_inicio.toISOString().slice(0,10)+"','"+fdata.punto_partida+"','"+fdata.punto_llegada+"','"+$scope.id_factura+"','"+$scope.idCliente+"','"+fdata.usersT.idtransportista+"','"+fdata.estatus+"')"; 
  $scope.sql="INSERT INTO `facturas`(`id_pedido`, `nro_factura`, `fecha_reg_factura`, `fecha_venc_factura`, `cant_prod_factura`, `importe_prod_factura`, `estatus_fact`, `descuento`) VALUES ("+$scope.datosClientes.id_pedido+",'"+fdata.nro_factura+"','"+$scope.fecha_inicio.toISOString().slice(0,10)+"','"+$scope.fecha_inicio.toISOString().slice(0,10)+"',"+$scope.productoEnGuia+","+ $scope.sumarDescuento+",'"+fdata.estado.estado+"', "+( $scope.sumarDescuento-$scope.fdata.importeFact)+")";
  console.log($scope.sql)
  $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){
        
     // $scope.sql="SELECT * FROM `guia_remision` order by `id_guia_remision` desc"; 

     // $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.guia = data[0].id_guia_remision;

        for (i=0;i<$scope.totalProductos;i++){ 
          
          if($scope.fdata.producto[i] == true){
          
           $scope.slqArray[i]="UPDATE `pedidos_detalles` SET `nro_factura`='"+fdata.nro_factura+"' WHERE `id_producto`= '"+$scope.fdata.idproducto[i]+"' AND `id_pedido` ='"+$scope.datosClientes.id_pedido+"' AND `id_pedido_detalle`='"+ $scope.fdata.detalleFact[i]+"'";
          
         $http.post("class/angularSql.php", {ExecutetSQL:$scope.slqArray[i]}).success(function(data){console.log(data)});
          
          }

        } 

     });

  if(fdata.estado.estado == 'Pagado'){
  $scope.monto=($scope.datosClientes.saldo_actual-$scope.fdata.importeFact);
  $scope.ActualizarSaldo($scope.datosClientes.id_cliente,$scope.monto);
  }
 $scope.ListarClientes();
 $scope.listarFact();
 $scope.factPagas();
   // });

    // LIMPIAR CAMPOS
  $scope.cambiarfact();
  $scope.BuscarFactura=' ';
  $scope.fdata.fecha_inicio='';
  $scope.fdata.usersT='';
  $scope.fdata.punto_partida='';
  $scope.fdata.punto_llegada='';
  $scope.fdata.descuento = 0;
  $scope.descuento='';
  $scope.sumarfact = 0 ;
  fdata.precioProducto='';
  $scope.sumarDescuento=0;
  }
  $scope.obj.temp =true;
  $scope.obj.tempMsj = "Se registro la factura Factura N° "+fdata.nro_factura; 
 }
}


//PAGAR FACTURA
/*
$scope.pagarFact = function(value){
  if(value =='Pagado'){}

}


*/
/*
$scope.onClick = function(points,evt){
  console.log(points,evt);
}
*/






})