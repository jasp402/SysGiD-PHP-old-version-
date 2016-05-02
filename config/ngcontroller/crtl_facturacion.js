//-----------------------------------------------------------------------------CONTROL FACTURACION
app.controller('ngControlFacturacion', function(public,query,Factory, SQLGlobal, $scope, $http, $location, $routeParams, $timeout,$filter, sweet, AlertGlobal){ // $scope.chart = CharsGlobal;

  $scope.public   = public;
  $scope.alert    = AlertGlobal;
  $scope.SQL      = SQLGlobal;

  $scope.alert.bienvenida('Facturación','¡Porfavor No desespere!'); 

  $scope.public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
  $scope.public.ngTitle = 'SysGiD | Clientes';



$scope.ListarAbonosCliente = function(id){
$scope.sql="SELECT * FROM  `pagos` WHERE  `id_cliente` ="+id+"";
  $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.AbonosCliente = data;});
$scope.sql="SELECT SUM(`monto_abono`) FROM  `pagos` WHERE  `id_cliente` ="+id+"";
$http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.TotalAbonos = data[0]; console.log(data[0])});
}





//--------------------------------------FACTURACION (GESTION DE PaGO)--------------------------------------------------------
$scope.regPago = function(fdata){
  if(fdata.metodo == 'Efectivo'){
     fdata.banco = '';                                                   
     fdata.ref = '';
  }
 $scope.obj.temp = true;
 $scope.newSaldo = ($scope.datosClientes.saldo_actual + fdata.monto);
 $scope.sql="INSERT INTO `pagos`(`id_cliente`, `monto_abono`, `fecha_pago`, `metodo_pago`, `banco_pago`, `ref_pago`, `concepto_pago`, `estatus_pago`) VALUES ("+$scope.datosClientes.id_cliente+","+fdata.monto+",'"+fdata.fechaPago.toISOString().slice(0,10)+"','"+fdata.metodo+"','"+fdata.banco+"','"+fdata.ref+"','"+fdata.concepto+"','a')";
 $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){ 
     $scope.sql="UPDATE `ventas_clientes` SET `saldo_actual`="+$scope.newSaldo+" WHERE `id_cliente`="+$scope.datosClientes.id_cliente+"";
     $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){ 
        window.location = '#/facturacion'; 
     });
    });
$scope.obj.tempMsj = "Fue abonado la cantidad de: /s"+fdata.monto+", en al cuenta de: "+$scope.datosClientes.razonsocial+$scope.datosClientes.nombre;
$timeout(function(){$scope.obj.temp = false; }, 15000);

  //$scope.datosClientes.saldo_actual                               = UPDATE ventas_Cliente saldo_actual
  //$scope.datosClientes.id_cliente
  //fdata.metodo;                                                   = metodo_pago
  //fdata.monto;                                                    = monto_abono
  //fecha.pago=fdata.fechaPago.toISOString().slice(0,10);           = fecha_pago 
  //fdata.banco;                                                    = banco_pago
  //fdata.ref;                                                      = ref_pago
  //fdata.concepto                                                  = concepto_pago

}
$scope.hide = true;
$timeout(function(){ if($scope.hide == true)$scope.hide = false }, 36000);

/*
//Movido al control principal pporque es una funcion generica que no requiere parametros para su ejecucion
$scope.factPagas = function(){
  $scope.sql="SELECT * FROM `facturas` WHERE `estatus_fact`='Pagado'";
  $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){ $scope.FactPagas = data; });
}
*/
$scope.factPagas();






////////////////////////////////////////////////////////////////////////////////////////
$scope.pagarFact = function(data){
 confirmar=confirm("¡Importante! \n El monto de esta factura se acreditara a la cuenta del cliente, aun cuando el saldo actual sea inferior al monto de la factura. \n ¿Desea Continuar?"); 
 if(confirmar){
 $scope.monto = (data.saldo_actual-data.importe_prod_factura);
 $scope.idCliente = data.id_cliente;
 $scope.sql="UPDATE `facturas` SET `estatus_fact`='Pagado' WHERE `id_factura`="+data.id_factura+"";
 $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){
 $scope.ActualizarSaldo($scope.idCliente,$scope.monto);
 $scope.listarFact();
 $scope.factPagas();
 }); 

  }
}






})

