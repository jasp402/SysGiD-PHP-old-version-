var app = angular
.module('app', ["ngRoute","ngResource","ui.bootstrap","countTo","bootstrap.fileField","chart.js", "hSweetAlert", "angular.filter"])

    .factory("API", function ($resource) {
        return $resource("http://localhost/RestServer/sysgid/v1/:instance", {}, {
            query: {method: "POST", isArray: false}
        });
    })

    .factory('SQL', function ($http, $q) {
        //Global var
        var Query;
        var Value;
        var strSQL;
        return {
            INSERT: INSERT,
            SELECT: SELECT,
            UPDATE: UPDATE,
            DELETE: DELETE
        };

        function INSERT(table, fdata) {
            Query = 'INSERT INTO ' + table + '(';
            Value = 'VALUE(';
            angular.forEach(fdata, function (value, key) {
                if (value != '') {
                    Query = Query + "`" + key + "`, ";
                    Value = Value + "'" + value + "',";
                }

            });
            Query = Query + '`estatus`) ';
            Value = Value + "'a');";
            strSQL = Query + Value;
            console.log(strSQL);
// ---- $http promise ----
            var defered = $q.defer();
            var promise = defered.promise;
            $http.post("class/angularSql.php", {ExecutetSQL: strSQL})
                .success(function (data) {
                    defered.resolve(data);
                })
                .error(function (err) {
                    defered.reject(err)
                });
            return promise;
        }

        function SELECT(field, table, where) {
            Value = '';
            Query = "SELECT " + field + " FROM " + table + "";
            if (where) {
                Query = Query + ' WHERE ';
            }
            if (where.length == 1) {
                angular.forEach(where[0], function (value, key) {
                    Value = key + '="' + value + '";';
                });
                strSQL = Query + Value;
            }

            if (where.length > 1) {
                angular.forEach(where, function (value, key) {
                    Value = Value + key + '="' + value + '" AND ';
                });
                strSQL = Query + Value;

            }
// ---- $http promise ----
            console.log(strSQL);
            var defered = $q.defer();
            var promise = defered.promise;
            $http.post("class/angularSql.php", {SelectSQL: strSQL})
                .success(function (data) {
                    defered.resolve(data);
                })
                .error(function (err) {
                    defered.reject(err)
                });
            return promise;
        }

        function UPDATE(table, fdata) {
            console.log(fdata);
        }

        function DELETE(table, fdata) {
            console.log(fdata);
        }
    })

    .factory('Factory', function ($http, $q) {
        return {
            getAll: getAll, //inicial mente para recibir... Veamos que mas se puede hacer
        }

// parametros: |php|query|sql|
        function getAll(query) {
            var defered = $q.defer();
            var promise = defered.promise;

            $http.post("class/angularSql.php", {SelectSQL: query})
                .success(function (data) {
                    defered.resolve(data);
                })
                .error(function (err) {
                    defered.reject(err)
                });

            return promise;
        }
    })

    .service('query', function () {
        //S = SELECT
        //I = INSERT
        //U = UPDATE
        //D = DELETE
        return {
            S001: 'SELECT * FROM `empresa`',
            S002: 'SELECT * FROM `config_sysgid`'
        }
    })






















//-----------------------------------------------------------------------------CONTROL PRINCIPAL
/* 
ControlPrincipal: 
Controla toda que pasa en el index.php sirve para cuando se refresca la pagina
no se pierda la sesion. porque verifica la Variable de sesion y deja al usuario donde estaba.
*/
    .controller('ControlPrincipal', function (public, Factory, query, $scope, $timeout, $http, API) {

        $scope.public = public;

        $scope.public.ngClassBody = 'hold-transition login-page';

                API.query({ instance: 'users' },{
                    user: 'jasp402@gmail.com',
                    password: '1234'
                }, function(data) {
                    console.log(data.id); //print data
                    //$scope.post = data;

                });
/*
                $http.post("http://localhost/RestServer/sysgid/v1/load/testing", {
                    user: 'jasp402@gmail.com',
                    password: '1234'
                }).success(function (data) {
                    console.log(data);
                });
        */
        Factory.getAll(query.S001, 'SelectSQL').then(function (data) {
            console.log(data); //print data
            public.DataCompany = data[0];
        }).catch(function (err) {
        });
        Factory.getAll(query.S002, 'SelectSQL').then(function (data) {
            public.DataSystem = data[0];
        }).catch(function (err) {
        });


        $scope.inventario = function (value1, value2) {
            if (value1 === value2) alert('No hay mas productos disponibles')
            return value1;
        }




$scope.cambiarVista =function(value){
$scope.public.ngVista = value; 
}

//FUNCIONES GLOBALES QUE AFECTAN EL $SCOPE - Sin hacer uso de Variables globales
$scope.listarClientes = function(){
  $http.post("class/angularSql.php", {listarClientes:''}).success(function(data){$scope.ListarClientes = data});
}

$scope.listarClientesPedidos=function(){
$scope.slq="SELECT * FROM `ventas_clientes`as c, pedidos as p WHERE c.total_pedidos != '' and c.id_cliente = p.id_cliente";
$http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.ListarClientesPedidos = data;});  
}

$scope.SaldoClientes = function(){
$scope.sql="SELECT * FROM `ventas_clientes` ORDER BY `ventas_clientes`.`saldo_actual` DESC";
$http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.ListarSaldoClientes = data;});
}


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

$scope.factPagas = function(){
  $scope.sql="SELECT * FROM `facturas` WHERE `estatus_fact`='Pagado'";
  $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){ $scope.FactPagas = data; });
};


$scope.listarRemision = function(){
  $scope.sql="SELECT * FROM remision AS r, pedidos AS ped, transporte_empresas AS te, transporte_transportistas AS t, ventas_clientes AS c WHERE r.nro_remision !=  '' AND r.id_pedido = ped.id_pedido AND ped.id_cliente = c.id_cliente AND r.idtransportista = t.idtransportista AND t.idempresa_transporte = te.idempresa_transporte";
  $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.ListarRemision = data; $scope.cantRem = data[0].id_remision });

};

$scope.ListarEstados = function () {
        $http.post("class/angularSql.php", {listarEstado :''}).success(function(data){$scope.listarEstado = data});
};


})


































//-----------------------------------------------------------------------------CONTROL LOGIN
/*
ngControlLogin: 
Valida el inicio de sesion del usuario. busca y compara los usuarios segun su estatus, 
para saber si es un usuario nuevo, suspendido, eliminado o normal.
tambien carga los valores del usuario en las variables del ServicioGlobal. 
*/

.controller('ngControlLogin', function(public, Factory, query, $scope, $http, $timeout, $window){
$scope.public = public;



//Instanciamos el ServicioGlobal para tener acceso a sus variables y cargarle contenido 
         // $scope.obj = ServiceGlobal;

          
          $scope.public.ngTitle = 'SysGiD | Login';
          $scope.public.ngClassBody = 'hold-transition login-page';
          $scope.public.msgTitle = 'Iniciar sesión al panel de administración';
          //------------------------------------
          $scope.formGroup  = true;
          //------------------------------------
//Creamo un Objeto fdata que recojera todos los datos del formulario (login & password)
          $scope.fdata = {};

//Permite limpiar todos los campos inputs que tengan el objeto ftada en su ng-model 
          $scope.clearformLogin = function(){ $scope.fdata = ''}



/*
ngValidate(fdata):
Realiza la validación de usuario y su inicio de sesion segun su estatus.
*/
    $scope.ngValidate = function(fdata){   
//Usamos el ($http.post) para comunicarnos con la base de datos, pasando con key:iniciarSesion y value:Array(ngName & ngPassword)
    $http.post("class/angularSql.php", {inciarSesion: fdata})
//Evaluamos la respuesta de la peticion del $http.post
      .success(function(data){
              //console.log(data);
//Si el estatus del usuario es == 's' el usuario esta suspendido.
           if (data.estatus == 's'){   
               $scope.AlertMensaje='suspendido'  //mostramos un mensaje informando el estatus del usuario (usamos el ng-switch)
               $scope.clearformLogin();          //Limpiamos el formulario para que el usuario vuelva a intentarlo

//Si el estatus del usuario es == 'S/V' (Sin validar) al usuario no se le ha añandido permisos.
           }else if (data.estatus == 'S/V'){  
              $scope.AlertMensaje='nuevo' 
              $scope.clearformLogin();

//Si el estatus del usuario no esta difinido es porque no esta en la base de datos. por ende introdujo mal el login o el password.
           }else if (typeof(data.id_usuario) == "undefined"){ 
              $scope.AlertMensaje='incorrecto' 
              $scope.clearformLogin();
                     
//Si todo es correcto
            }else{
//Solo en este punto cargamos la variable de Session en session.php con el id_usuario
              $http.post("class/session.php", {inciarSesion: data.id_usuario}).success(function(data){ });
              $scope.AlertMensaje='correcto'                                      //Mostramos un cuadro de mensaje verde
              $scope.formGroup = false;                                           //Ocultamos el Formulario
              $scope.msgTitle = 'Porfavor espere, cargando el contenido';         //Cambiamos el mensaje de cabecera del form
              //$scope.msgTitle2= 'Porfavor espere, cargando el contenido';


//Cargamos la varaible ngUser con todos los datos del usuario
              public.ngUser = data;
//Retrasamos la carga del home.php para crear el preloader (para la version 2)
//cargamos la pagina home.php
              $timeout( function(){ window.location = '#/dashboard' }, 1000);
              
            } 
      })
    };

    
  })





































//-----------------------------------------------------------------------------CONTROL HOME
/*
ngControlHome:
Controla el entorno globla de todo el sistema con variables globales no hay que estar haceindo peticiones
inecesarias al servidor por lo que todo es en tiempo real o asincrono
*/  
.controller('ngControlMenuBar', function(public,query,Factory,SQLGlobal,$scope,$http,$timeout){


  $scope.public = public;
  $scope.SQL = SQLGlobal;

  var idUSer = public.idUSer;
  var ngUser = public.ngUser.id_usuario;


$scope.ClicMenu = function(valor,tempUrl){ 
  $scope.public.ngMenu.titulo = valor;
  $scope.public.ngMenu.clase = 'active';
  $scope.public.ngTempUrl = tempUrl; 
}

$scope.menu = function(){
if(idUSer || ngUser){
  if(idUSer){var id = idUSer}else{var id = ngUser}
 $timeout(function(){ 
 $scope.SQL.getDataUser(ngUser,idUSer).modulos.success(function(data){
  $scope.public.ngMenu.modulos=data; 
  //$scope.DatosMenu = data; 
  //$scope.submodulos();  
})
 }, 1000);
$scope.sql="SELECT * FROM config_modulos as m, config_submodulos as sm, permisos as p WHERE p.`id_modulo` = m.`id_modulo` AND m.`estatus`='a' AND p.id_usuario ="+id+" AND m.id_modulo = sm.id_modulo ORDER BY `m`.`id_modulo` ASC";
       $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.public.SubModulo=data});
 //console.log($scope.sql)
 }
}





/*

  $scope.submodulos = function(){
  if(!$scope.public.SubModulo){
     $scope.public.SubModulo = [];
    // $scope.public.SubModulo.push('');
    for(i=1;i<=$scope.DatosMenu.length; i++){
       $scope.sql="SELECT * FROM config_submodulos WHERE id_modulo="+i+"";
       $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){console.log(data);$scope.public.SubModulo.push(data);});
    }
  }
}
*/




//REVISARESTA FUNCION CON DETENIMIENTO
$scope.subMenuSelect = '';
$scope.intms = false;
 $scope.ActClass = function(valor){ $scope.subMenuSelect = valor;
   if(valor === 'Listar Usuario') 
    $scope.intms = true;
   else
    $scope.intms = false;
  } 
})



















.controller('ngControlTopBar', function(public,Factory,$scope,$http){
  
  $scope.public = public;

  $scope.changeClass = function(){
  if ($scope.public.ngClassBody == "hold-transition skin-blue sidebar-mini")
      $scope.public.ngClassBody = "skin-blue sidebar-mini sidebar-open sidebar-collapse";
  else
      $scope.public.ngClassBody = "hold-transition skin-blue sidebar-mini";
}

var idUSer = public.idUSer
var ngUser = public.ngUser.id_usuario
$scope.SQL.getDataUser(ngUser,idUSer).usuario.success(function(data){$scope.usuario = data[0] });


//Bloquear Pantalla
$scope.lockscreen = function(){
  window.location = '#/lockscreen';
}

//Cerrar Sesión
$scope.closeSesion = function(){
  $scope.public.idUSer = 0;
  $scope.public.ngUser = 0;
  $http.post("class/session.php", {close:''}).success(function(data){window.location = '#/';  });
}

})































.controller('ngControlChars',  function($scope,$http,$timeout,public){
$scope.public = public;
var year = new Date().getFullYear();//para determinar el Año en curso


  $scope.labels = ["enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]; 
  $scope.labelsMin = ["ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]; 
  
  //$scope.Clientes = ['Registrados 2015'];
  

//OPCION 1 GRAFICA PEDIDOS
$scope.Charts_Pedidos = ['Registro 2015'];
$scope.data3 = [[2,13,56,0,3,12,23,29,42,75,8,30]];





$scope.cxmes =function(){ // Clientes x Mes
  $scope.data1 = [];
  $scope.DataChats_1 = [];
  for(i=0; i<12; i++){
   $scope.sql="SELECT * FROM `ventas_clientes` WHERE `fecha_reg_cliente` BETWEEN '"+year+"-"+(i+1)+"-01' AND '"+year+"-"+(i+1)+"-31'";
   $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.DataChats_1.push(parseInt(data))});
  }
  if(i == 12){ $timeout(function(){ $scope.data1.push($scope.DataChats_1); $scope.public.loadingChars = true}, 1000); }
}


$scope.pxmes =function(){ //Pedidos x Mes
   $scope.data2 = [];
   $scope.DataChats_2 = []; 
  for(i=0; i<12; i++){
   $scope.sql="SELECT * FROM `pedidos` WHERE `fecha_pedido` BETWEEN '"+year+"-"+(i+1)+"-01' AND '"+year+"-"+(i+1)+"-31' ORDER BY id_pedido DESC";
   $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.DataChats_2.push(parseInt(data))});
  }
  if(i == 12){ $timeout(function(){ $scope.data2.push($scope.DataChats_2); $scope.public.loadingChars = true}, 1000); }
}

$scope.fxmes =function(){ //Facturas x Mes
   var year = new Date().getFullYear(); //para determinar el Año en curso
   $scope.DataChats_3 = []; 
  for(i=0; i<12; i++){
   $scope.sql="SELECT * FROM `facturas` WHERE `fecha_reg_factura` BETWEEN '"+year+"-"+(i+1)+"-01' AND '"+year+"-"+(i+1)+"-31'";
   $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.DataChats_3.push(parseInt(data))});
  }
}

//PRODUCTOS VENDIDOS POR MES
$scope.producxmes = function(){ //Clientes x Mes

  $scope.data_produc = [];
  $scope.DataChats   = [];
  for(i=0; i<12; i++){
    $scope.sql2="SELECT SUM(`cant_prod_factura`) as value FROM `facturas` WHERE `fecha_reg_factura` BETWEEN '"+year+"-"+(i+1)+"-01' AND '"+year+"-"+(i+1)+"-31' AND estatus_fact = 'Pagado'";
   //console.log($scope.sql2)
   $http.post("class/angularSql.php", {SelectSQL:$scope.sql2}).success(function(data){
if(data[0].value){$scope.DataChats.push(data[0].value)}else{$scope.DataChats.push(0)}
  });
  }
  if(i == 12){
    $timeout(function(){ $scope.data_produc.push($scope.DataChats); $scope.public.loadingChars = true;}, 1000);
  }
}


//Grafica General 
$scope.GraficaGeneral = function(){
$scope.series1 = ['Clientes'];
$scope.series0 = ['Pedidos', 'Facturas', 'Remisiones'];

$scope.cxmes();
$scope.pxmes();
$scope.fxmes();

$timeout(function(){
  $scope.data0 = []; //dasboard
  $scope.data1 = []; //Clientes
  $scope.data2 = []; //Pedidos
  $scope.data3 = []; //Facturas
  $scope.data4 = []; //Remisiones

  $scope.data1.push($scope.DataChats_1);
  $scope.data2.push($scope.DataChats_2);
  //$scope.data3.push($scope.DataChats_3);
  //Este compila todas las graficas en 1 sola
  $scope.data0.push($scope.DataChats_1);
  $scope.data0.push($scope.DataChats_2);
  //$scope.data0.push($scope.DataChats_3);
  $scope.loading = true;
}, 1000);
}
})

































.controller('ngControlDashboard', function(public, query,Factory,$scope, $http,  $location, $routeParams, $timeout,$filter, sweet, AlertGlobal, SQLGlobal ){
$scope.public = public;
$scope.SQL = SQLGlobal;
//$scope.Query    = query;      //Modelo 
$scope.alert  = AlertGlobal;    //Vista
//$scope.obj    = ServiceGlobal;  //Controlador
$scope.fecha  = new Date();
$scope.fechaAnterir = new Date($scope.fecha.getFullYear(), $scope.fecha.getMonth()-1,1);


 $timeout( function(){
    $scope.fechafin = (new Date($scope.public.DataCompany.fecha_bloqueo))-$scope.fecha;
    $scope.diasfin = Math.floor($scope.fechafin/(1000*60*60*24))
  }, 1000);









$scope.public.ngTempUrl = '#/dashboard'; 

$scope.alert.bienvenida('Panel de Control','¡Porfavor No desespere!');

$scope.public.ngTitle = 'SysGiD | Dashboard'

$scope.public.ngClassBody = "hold-transition login-page";   

Factory.getAll(query.S001,'SelectSQL').then(function(data) {$scope.public.DataCompany= data[0]; }).catch(function(err) {  });
Factory.getAll(query.S002,'SelectSQL').then(function(data) {$scope.public.DataSystem = data[0]; }).catch(function(err) {  });

 
// [Widgets CLientes] - cantidad Gobal de clientes


// [Widgets CLientes] - Registrados mes anterior y Mes actual
  $scope.mesA = new Date().getMonth()+1;
  $scope.mesP = new Date().getMonth();
  $scope.anoA = new Date().getFullYear(); 

  $scope.WidgetsClientes =function(){ //Facturas x Mes
    $scope.getReporte_clientes = [];
    for(i=0; i<2; i++){
      if(i==0){
        $scope.sql="SELECT * FROM `ventas_clientes` WHERE `fecha_reg_cliente` BETWEEN '"+$scope.anoA+"-"+$scope.mesP+"-01' AND '"+$scope.anoA+"-"+$scope.mesP+"-31'";
        $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.getReporte_clientes.push(parseInt(data))});
      }else if(i==1){
        $scope.sql="SELECT * FROM `ventas_clientes` WHERE `fecha_reg_cliente` BETWEEN '"+$scope.anoA+"-"+$scope.mesA+"-01' AND '"+$scope.anoA+"-"+$scope.mesA+"-31'";
        $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.getReporte_clientes.push(parseInt(data))});
      }
     
    }
}


// [Widgets Productos] - Registrados mes anterior y Mes actual
  $scope.WidgetsProducto =function(){ //Facturas x Mes
    $scope.sql="SELECT SUM(`cant_prod_factura`) as value FROM `facturas`"; // WHERE estatus_fact = 'pagado'
    $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){$scope.getReporte_productosTotal = data[0].value; });

    $scope.getReporte_productos = [];
    for(i=0; i<2; i++){
      if(i==0){
        $scope.sql="SELECT SUM(`cant_prod_factura`) as value FROM `facturas` WHERE `fecha_reg_factura` BETWEEN '"+$scope.anoA+"-"+$scope.mesP+"-01' AND '"+$scope.anoA+"-"+$scope.mesP+"-31'";
        $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){
            if(data[0].value==null){$scope.getReporte_productos.push(0)}else{$scope.getReporte_productos.push(parseInt(data[0].value))}
          });
      }else if(i==1){
        $scope.sql="SELECT SUM(`cant_prod_factura`) as value FROM `facturas` WHERE `fecha_reg_factura` BETWEEN '"+$scope.anoA+"-"+$scope.mesA+"-01' AND '"+$scope.anoA+"-"+$scope.mesA+"-31'";
         $http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){
          if(data[0].value==null){$scope.getReporte_productos.push(0)}else{
              $scope.getReporte_productos.push(parseInt(data[0].value))
            }
        });
      }
     
    }
}


// [Widgets Productos] - Cantidades de Empresas y transportistas
//NOTA: Nose puede calcular por mes porque no se tiene fechas de registro.
  $scope.WidgetsTransporte =function(){ 
    $scope.sql="SELECT * FROM `transporte_transportistas`"; // WHERE estatus_fact = 'pagado'
    $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.getReporte_TransporteTotal = data});

    $scope.sql="SELECT * FROM `transporte_empresas`"; // WHERE estatus_fact = 'pagado'
    $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.getReporte_transporte = data});
}





// [Widgets Pedidos] - Cantidades de Pedidos solicitados en mes anterior y presente
  $scope.WidgetsPedidos =function(){ 
    $scope.getReporte_pedidos = [];
    for(i=0; i<2; i++){
      if(i==0){
        $scope.sql="SELECT * FROM `pedidos` WHERE `fecha_pedido` BETWEEN '"+$scope.anoA+"-"+$scope.mesP+"-01' AND '"+$scope.anoA+"-"+$scope.mesP+"-31'";
        $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.getReporte_pedidos.push(parseInt(data))});
      }else if(i==1){
        $scope.sql="SELECT * FROM `pedidos` WHERE `fecha_pedido` BETWEEN '"+$scope.anoA+"-"+$scope.mesA+"-01' AND '"+$scope.anoA+"-"+$scope.mesA+"-31'";
        $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.getReporte_pedidos.push(parseInt(data))});
      }
     
    }
}



// [Widgets Facturacion] - Cantidades de Pedidos solicitados en mes anterior y presente
  $scope.WidgetsFacturacion =function(){ 
    $scope.getReporte_factura = [];
    for(i=0; i<2; i++){
      if(i==0){
        $scope.sql="SELECT * FROM `facturas` WHERE `fecha_reg_factura` BETWEEN '"+$scope.anoA+"-"+$scope.mesP+"-01' AND '"+$scope.anoA+"-"+$scope.mesP+"-31'";
        $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.getReporte_factura.push(parseInt(data))});
      }else if(i==1){
        $scope.sql="SELECT * FROM `facturas` WHERE `fecha_reg_factura` BETWEEN '"+$scope.anoA+"-"+$scope.mesA+"-01' AND '"+$scope.anoA+"-"+$scope.mesA+"-31'";
        $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){console.log(data);$scope.getReporte_factura.push(parseInt(data))});
      }
     
    }
}




// [Widgets Remisiones] - Cantidades de Pedidos solicitados en mes anterior y presente
  $scope.WidgetsRemision =function(){ 
    $scope.getReporte_remision = [];
    for(i=0; i<2; i++){
      if(i==0){
        $scope.sql="SELECT * FROM `remision` WHERE `fecha_reg` BETWEEN '"+$scope.anoA+"-"+$scope.mesP+"-01' AND '"+$scope.anoA+"-"+$scope.mesP+"-31'";
        $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){$scope.getReporte_remision.push(parseInt(data))});
      }else if(i==1){
        $scope.sql="SELECT * FROM `remision` WHERE `fecha_reg` BETWEEN '"+$scope.anoA+"-"+$scope.mesA+"-01' AND '"+$scope.anoA+"-"+$scope.mesA+"-31'";
        $http.post("class/angularSql.php", {NumRowsSQL:$scope.sql}).success(function(data){console.log(data);$scope.getReporte_remision.push(parseInt(data))});
      }
     
    }
}



})




































//-----------------------------------------------------------------------------CONTROL Lockscreen
.controller('ngControlLockscreen', function(public, query,Factory,$scope, $http,  $location, $routeParams, $timeout,$filter, sweet, AlertGlobal, SQLGlobal ){

  $scope.public = public;
  $scope.public.ngClassBody = 'hold-transition login-page';

  
if(!$scope.public.ngUser && $scope.public.idUSer){
$scope.sql = "SELECT * FROM usuarios WHERE id_usuario = "+$scope.public.idUSer+" AND estatus != 'e'"; 
$http.post("class/angularSql.php", {SelectSQL:$scope.sql}).success(function(data){console.log(data);$scope.public.ngLockscreen = data[0];});  
}

$timeout( function(){ 
if($scope.public.ngUser ||  $scope.public.ngLockscreen){
if($scope.public.ngLockscreen){
       $scope.usuario = $scope.public.ngLockscreen;
  }else if($scope.public.ngUser){
    $scope.usuario = $scope.public.ngUser;
    $scope.public.ngLockscreen = $scope.public.ngUser;
  }  
  }else{ window.location = '#/'}


  $scope.msgTitle2 = 'Introdusca su password para reabrir su sesión';
  $scope.public.idUSer = 0;
  $scope.public.ngUser = 0;
  //$http.post("class/session.php", {close:''}) Si cerramos seccion destruimos la variable de session y luego no podemos actualizar la pagina
}, 1000);



$scope.openscreen = function(value){
  if(value.ngPassword == $scope.public.ngLockscreen.password){
    $scope.public.ngUser =  $scope.public.ngLockscreen;
    window.location = $scope.public.ngTempUrl;
  }else{ 
    sweet.show('Lo sentimos...!', 'Contraseña invalida \n porfavor autentifíquese', 'error');
    window.location = '#/'
  }
}


})


//-----------------------------------------------------------------------------CONTROL error
  .controller('ngControlError', function($scope){  })



//-----------------------------------------------------------------------------CONFIGURAR LAS RUTAS
  .config(function($routeProvider, $locationProvider){
    $routeProvider

    .when('/',{
                   templateUrl:'pages/system/login.php',
                   controller: 'ngControlLogin'
                  })
    .when('/dashboard',{
                   templateUrl:'pages/module/dashboard/home.php',
                   controller: 'ngControlDashboard'
    })
    .when('/mailbox',{
                   templateUrl:'pages/module/mailbox/mailbox.html',
                   controller: 'ngControlError'
    })
    .when('/seguridad',{
                   templateUrl:'pages/module/security/admin_security.php',
                   controller: 'ngControlSeguridad'
    })
    .when('/error',{
                   templateUrl:'pages/system/402.html',
                   controller: 'ngControlError'
    })
    .when('/lockscreen',{
                   templateUrl:'pages/system/lockscreen.php',
                   controller: 'ngControlLockscreen'
    })
    .when('/transporte',{
                   templateUrl:'pages/module/transporte/transporte.php',
                   controller: 'ngControlTransporte'
    })
    .when('/facturacion',{
                   templateUrl:'pages/module/facturacion/facturacion.php',
                   controller: 'ngControlFacturacion'
    })
    .when('/clientes',{
                   templateUrl:'pages/module/clientes/clientes.php',
                   controller: 'ngControlClientes' 
    })
    .when('/productos',{
                   templateUrl:'pages/module/productos/productos.php',
                   controller: 'ngControlProductos'
    })
    .when('/reportes',{
                   templateUrl:'pages/module/reportes/reportes.php',
                   controller: 'ngControlReportes'
    })
    .when('/pedidos',{
                   templateUrl:'pages/module/pedidos/pedidos.php',
                   controller: 'ngControlPedidos'
    })
    .when('/remision',{
                   templateUrl:'pages/module/remision/guia_remision.php',
                   controller: 'ngControlRemision'
    })
    .when('/coleccion_bicentenaria',{
                   templateUrl:'pages/module/_coleccion_bicentenaria/recepcion.html',
                   controller: 'ngCtrl_Coleccion_Bicentenaria'
    })
    .when('/soporte',{
                   templateUrl:'pages/UI/icons.html',
                   controller: 'ngCtrl_Coleccion_Bicentenaria'
    })

    .otherwise({
     // template: '<h1>AQUI NO HAY UN COÑO</h1>',
          redirectTo: '/',
          controller: 'ngControlLogin'
        });
    //$locationProvider.html5Mode(true);
  })



