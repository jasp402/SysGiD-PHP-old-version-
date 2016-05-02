//-----------------------------------------------------------------------------CONTROL FACTURACION
app.controller('ngControlReportes', function(public,query,Factory, SQLGlobal, $scope, $http, $location, $routeParams, $timeout,$filter, sweet, AlertGlobal){ // $scope.chart = CharsGlobal;

  $scope.public   = public;
  $scope.alert    = AlertGlobal;
  $scope.SQL      = SQLGlobal;

  $scope.alert.bienvenida('Facturación','¡Porfavor No desespere!'); 

  $scope.public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
  $scope.public.ngTitle = 'SysGiD | Clientes';



})
