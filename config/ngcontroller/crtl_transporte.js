//-----------------------------------------------------------------------------CONTROL TRANSPORTE
app.controller('ngControlTransporte', function(public,query,Factory, SQLGlobal, $scope, $http, $location, $routeParams, $timeout,$filter, sweet, AlertGlobal){ // $scope.chart = CharsGlobal;
  $scope.public   = public;
  $scope.alert    = AlertGlobal;
  $scope.SQL      = SQLGlobal;

  $scope.alert.bienvenida('Transporte','¡Porfavor No desespere!'); 
  $scope.public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
  $scope.public.ngTitle = 'SysGiD | Productos'; 

//LA TABLA sUBMODULO DEBERIA TENER UN CAPO DE DESCRIPCION PARA USARLO EN LA PARTE INFERIOR DE LOS BOTONES
   $scope.cambiarVista =function(value){
  $scope.public.ngVista = value; 
  }

//---------------------------------Transporte---------------------------------------------------------

$scope.RegEmpresaTransporte = function(fdata){
$scope.success = true;
//console.log(fdata);
$http.post("class/angularSql.php", {RegEmpresaTransporte:fdata}).success(function(data){
  $timeout(function(){ $scope.success = false }, 5000);
});
$scope.fdata = '';
}



$scope.RegTransporte = function(fdata){
fdata.T_idempresa_transporte = fdata.T_idempresa_transporte.idempresa_transporte;
$http.post("class/angularSql.php", {RegTransporte:fdata}).success(function(data){
  $timeout(function(){ $scope.alert.success('¡Registro exitoso!','Trasnportista Registrado'); }, 5000);
});
$scope.fdata = '';
}



$scope.listarET = function(){$http.post("class/angularSql.php", {listarET:''}).success(function(data){$scope.ListrarTablaET = data});}
$scope.listarT = function(){$http.post("class/angularSql.php", {listarT:''}).success(function(data){$scope.ListrarTablaT = data});}
//$scope.listarT();
//$scope.listarET();

$scope.log = function(value){
   console.log(value.idempresa_transporte); 
}  
})