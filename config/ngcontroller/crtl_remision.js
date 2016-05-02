//-----------------------------------------------------------------------------CONTROL FACTURACION
app.controller('ngControlRemision', function(public,query,Factory, SQLGlobal, $scope, $http, $location, $routeParams, $timeout,$filter, sweet, AlertGlobal){ // $scope.chart = CharsGlobal;

  $scope.public   = public;
  $scope.alert    = AlertGlobal;
  $scope.SQL      = SQLGlobal;

  $scope.alert.bienvenida('Remisión','¡Porfavor No desespere!'); 

  $scope.public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
  $scope.public.ngTitle = 'SysGiD | Clientes';





$scope.ActualizarSaldo = function(id, Monto){
$scope.sql="UPDATE ventas_clientes SET saldo_actual =  "+Monto+" WHERE id_cliente =  "+id+";";
$http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){});

}


/*Fue movida a ngControlPrincipal porque no requiere parametros para su ejecucion y se usa en varios lugares
$scope.listarRemision = function(){
  $scope.sql="SELECT * FROM remision AS r, pedidos AS ped, transporte_empresas AS te, transporte_transportistas AS t, ventas_clientes AS c WHERE r.nro_remision !=  '' AND r.id_pedido = ped.id_pedido AND ped.id_cliente = c.id_cliente AND r.idtransportista = t.idtransportista AND t.idempresa_transporte = te.idempresa_transporte";
  $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.ListarRemision = data; $scope.cantRem = data[0].id_remision });
//console.log($scope.sql);
}
//$scope.listarRemision();
*/




$scope.pedidoDespachado = function(id){
$scope.tag = false;
  for (i=0;i<$scope.totalProductos;i++){   
          if($scope.fdata.producto[i] == true){ $scope.tag = true;}
  }
  if(!$scope.tag){
      $scope.sql="UPDATE `pedidos` SET estatus_pedido='ENVIADO' WHERE id_pedido="+id+"";
      $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){ });
  }
}


//////////////////////////////////////////////////////////////////////////////////////////////
$scope.regRemision = function(fdata){
$scope.tag = false;

for (i=0;i<$scope.totalProductos;i++){   
          if($scope.fdata.producto[i] == true){ $scope.tag = true;}
        }   

if($scope.tag){
$scope.sql="INSERT INTO `remision`(`nro_remision`, `fecha_reg`, `fecha_traslado`, `origen`, `destino`, `idtransportista`, `estatus`, `id_pedido`) VALUES ('"+fdata.guia+"','"+$scope.fecha.toISOString().slice(0,10)+"','"+fdata.fecha_inicio.toISOString().slice(0,10)+"','"+fdata.punto_partida+"','"+fdata.punto_llegada+"',"+fdata.usersT.idtransportista+",'"+fdata.radio+"', "+$scope.idPedido+")";

$http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){});


for (i=0;i<$scope.totalProductos;i++){ 
          
          if($scope.fdata.producto[i] == true){

         $scope.sql="UPDATE `pedidos_detalles` SET `nro_remision`='"+fdata.guia+"' WHERE id_pedido_detalle="+fdata.detalleFact[i]+"";
         console.log($scope.sql);
         $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){ });
          $scope.tag = true;
          }

        }  

}else{
  alert('Todos los Productos de este Pedido ya fueron enviados');
}
$scope.obj.temp =true;
$scope.obj.tempMsj = "Se registro la Guia de Remisión N° "+fdata.guia; 


$scope.ListarProdFactRem = '';
$scope.cambiarfact();
fdata='';

if($scope.obj.temp){
  $timeout(function(){  $scope.obj.temp = false }, 15000);
}
window.location = '#/remision';




}
})

