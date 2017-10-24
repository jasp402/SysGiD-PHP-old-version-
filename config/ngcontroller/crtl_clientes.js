//-----------------------------------------------------------------------------CONTROL CLIENTES
app.controller('ngControlClientes', function(public,query,Factory, SQLGlobal, $scope, $http, $location, $routeParams, $timeout,$filter, sweet, AlertGlobal){ // $scope.chart = CharsGlobal;

  $scope.public   = public;
  $scope.alert    = AlertGlobal;
  $scope.SQL      = SQLGlobal;

  $scope.alert.bienvenida('Clientes','¡Porfavor No desespere!'); 

  $scope.public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
  $scope.public.ngTitle = 'SysGiD | Clientes';

  $scope.cambiarVista =function(value){
    $scope.public.ngVista = value; 
  }

//REGISTRAR CLIENTES
  $scope.RegCliente = function(fdata){
    if(fdata.RUC){  fdata.tipo_cliente = 'Juridico';
    }else{
                  fdata.tipo_cliente = 'Natural';
    }
    fdata.departamento  = fdata.departamento.departamento;
    if(fdata.provincia){fdata.provincia = fdata.provincia.provincia}
    if(fdata.distrito) {fdata.distrito  = fdata.distrito.distrito}
    $http.post("class/angularSql.php", {RegCliente:fdata}).success(function(data){$scope.success = true; $scope.fdata = '';});
    
      $timeout(function(){ $scope.success = false }, 5000)
    
    $scope.alert.success('¡Registro exitoso!','Visualice su registro en listar Usuarios'); 

    $scope.fdata = '';
}




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






///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////<<<<<<<<
$scope.SaldoFactura = function(id){
$scope.sql="SELECT SUM(importe_prod_factura) FROM facturas AS f, pedidos AS p WHERE f.estatus_fact =  'Pagado' AND p.id_pedido = f.id_pedido AND p.id_cliente ="+id+"";
$http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.SaldoFact = data[0]})
}

$scope.cargarCliente = function(cliente){
  var datos;
      if(cliente.tipo_cliente == 'Natural'){
           datos = cliente.DNI+' - '+cliente.nombre+' '+cliente.apellido;
      }else{datos = cliente.RUC+' - '+cliente.razonsocial; }

 sweet.show({
            title: '¿Procesar pedido?',
            text: ''+datos+'',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Aceptar',
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                sweet.show('Listo!', 'EL USUARIO '+datos+' \n ya está cargado.', 'success');
                $timeout(function() {
                  $scope.successInput = true;
                  $scope.datosClientes = cliente;
                  $scope.id_cliente = cliente.id_cliente;
                  $scope.Cliente = datos;
                  $scope.BuscarClientes =cliente.RUC;

                }, 2000);
                
            }else{
                sweet.show('Deacuerdo', 'Puede seleccionar otro usuario', 'error');
            }
        });
}


$scope.CuentaCliente = function(cliente){
  var datos;

  if(cliente.tipo_cliente == 'Natural'){
          datos = cliente.DNI+' - '+cliente.nombre+' '+cliente.apellido;
    }else{datos = cliente.RUC+' - '+cliente.razonsocial; }
 
 sweet.show({
            title: 'Cargar Cuenta del Cliente',
            text: ''+datos+'',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Aceptar',
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                sweet.show('Listo!', 'EL USUARIO '+datos+' \n ya está cargado.', 'success');
                $scope.datosClientes = cliente;
                $scope.id_cliente = cliente.id_cliente;
                $scope.SearchPedidos = true;
                $scope.Cliente = datos;
                $scope.BuscarClientes =cliente.RUC;
                $scope.successInput = true;
                $timeout(function() {
                  $scope.PedidosxCliente(cliente.id_cliente); 
                  $scope.listarFactCliente(cliente.id_cliente); 
                  $scope.ListarAbonosCliente(cliente.id_cliente);
                  $scope.SaldoFactura(cliente.id_cliente)
                  
                  
                  
                }, 500);
                
            }else{
                sweet.show('Deacuerdo', 'Puede seleccionar otro usuario', 'error');
            }
        });
}

$scope.Provincias = function(data){
  $http.post("class/angularSql.php", {listarProvincias:data.idDepa}).success(function(data){$scope.listarProvincias = data});
}
//Funcion para listar Distrito segun Provincia
$scope.Distritos = function(data){
  if(data){ 
  $http.post("class/angularSql.php", {listarDistritos:data.idProv}).success(function(data){$scope.listarDistritos = data}); 
  }else{$scope.fdata.distrito = ''}
}

$http.post("class/angularSql.php", {listarProvincias:''}).success(function(data){$scope.listarProvincias = data}); 
$http.post("class/angularSql.php", {listarDistritos:''}).success(function(data){$scope.listarDistritos = data}); 
$http.post("class/angularSql.php", {listarDepartamentos :''}).success(function(data){$scope.listarDepartamentos = data}); 


  }) //END - ngControlCLiente
