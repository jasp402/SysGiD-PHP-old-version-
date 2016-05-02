//-----------------------------------------------------------------------------CONTROL PRODUCTOS
app.controller('ngControlProductos', function(public,query,Factory, SQLGlobal, $scope, $http, $location, $routeParams, $timeout,$filter, sweet, AlertGlobal){ // $scope.chart = CharsGlobal;
  $scope.public   = public;
  $scope.alert    = AlertGlobal;
  $scope.SQL      = SQLGlobal;

  $scope.alert.bienvenida('Productos','¡Porfavor No desespere!'); 
  $scope.public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
  $scope.public.ngTitle = 'SysGiD | Productos'; 

//LA TABLA sUBMODULO DEBERIA TENER UN CAPO DE DESCRIPCION PARA USARLO EN LA PARTE INFERIOR DE LOS BOTONES
   $scope.cambiarVista =function(value){
  $scope.public.ngVista = value; 
  }
  //-------------------------------INVENTARIO (Productos)--------------------------------------


//REGISTRAR CATEGORIAS DE PRODUCTO


$scope.EditarProducto = function(id, index){
$scope.edit = true;
$scope.indexProduct = index;
}




$scope.ActualizarProducto = function(date,value){
$scope.new = []; //Ojo Esta variable estaba fuera de la funcion
var cambios = 0;
  if (typeof(value.disponible) == "undefined"){value.disponible=date.disponible; cambios = cambios+1}
   // if (typeof(value.color) == "undefined"){value.color=date.color; cambios = cambios+1} //,`color`='"+value.color+"'
      if (typeof(value.precio) == "undefined"){value.precio=date.precio; cambios = cambios+1}
  if(cambios==3){alert('¡No se realizarion cambios en este prodcuto!')}else{
    $scope.sql = "UPDATE `producto` SET `disponible`="+value.disponible+", `precio`="+value.precio+" WHERE id_producto ="+date.id_producto+"";
    $http.post("class/angularSql.php", {ExecutetSQL:$scope.sql}).success(function(data){$scope.listarProductos(); $scope.alert.success('¡Registro exitoso!','Producto actualizado correctamente'); }); 
  }
    $scope.edit = false;
    $scope.new = [];
}





$scope.listarProductos = function(){
  $http.post("class/angularSql.php", {listarCAT:''}).success(function(data){$scope.ListrarCategoria = data});
  $http.post("class/angularSql.php", {listarTIP:''}).success(function(data){$scope.ListrarTipoProd = data});
  $http.post("class/angularSql.php", {listarProductos:''}).success(function(data){$scope.ListarProductos = data; });   
}
//$scope.listarProductos();

$scope.RegInventario = function(fdata){
  $http.post("class/angularSql.php", {InvCategoria:fdata}).success(function(data){$scope.listarProductos(); });
  $scope.fdata = '';
}
$scope.EliminarCatProduc = function(id){ confirmar=confirm("¿Desea eliminar este Registro?\n Esta acción afectara todos los productos registrados previamente"); 
  if(confirmar){$http.post("class/angularSql.php", {EliminarCatProduc:id}).success(function(data){ $scope.listarProductos();});}
}

//REGISTRAR TIPOS DE PRODUCTOS
$scope.RegTipoProd = function(fdata){ 
  $http.post("class/angularSql.php", {InvTipoProd:fdata}).success(function(data){ $scope.listarProductos(); }); 
  $scope.fdata = '';
}
$scope.EliminarTipoProduc = function(id){ confirmar=confirm("¿Desea eliminar este Registro?\n Esta acción afectara todos los productos registrados previamente"); 
  if(confirmar){$http.post("class/angularSql.php", {EliminarTipoProduc:id}).success(function(data){ $scope.listarProductos();});}
}

//REGISTRAR PRODUCTO
$scope.RegProducto = function(fdata){
var detener = false;

if(fdata.medida==''){fdata.medida=0}

  for (var i = 0; i < $scope.ListarProductos.length; i++) {
    if(fdata.cod_producto === $scope.ListarProductos[i].cod_producto){
     alert('El codigo de Producto ya se encuentra registrdo \n Porfavor Verifiquelo e intente nuevamente');
     detener = true;
    }
  }
  if(!detener){
  fdata.idcategoria = fdata.categoria.idcategoria; 
  fdata.idtipo_producto = fdata.Tipo.idtipo_producto;
  $http.post("class/angularSql.php", {RegProducto:fdata}).success(function(data){ $scope.listarProductos(); $scope.success = true; });   

    $timeout(function(){ 
    $scope.success = false; 
    fdata.cod_producto = '';
    fdata.nombre_producto ='';
    fdata.medida ='';
    fdata.peso ='';
    fdata.precio  ='';
    fdata.color  ='';
    fdata.cant  ='';
    },2000);
  }
}


$scope.ListarProductosID = [];
//Buscar Producto Segun Id_Tipo y Id_Categoria
$scope.BuscarPRO = function(id_tipo, idcatg, index){
 // alert(index);
$scope.fdata.idtipo = id_tipo.idtipo_producto;
$scope.fdata.idCatg = idcatg.idcategoria; 

$http.post("class/angularSql.php", {BuscarPRO:$scope.fdata}).success(function(data){$scope.ListarProductosID[index] = data});

}


//Eliminar Productos
$scope.EliminarProducto = function(id){
        sweet.show({
            title: '¿Desea quitar este Producto de forma permanente?',
            text: '<p class="text-red"><b>¡Advertencia!</b> No podra recuperar la información eliminada</p>',
            type: 'warning',
            html: true,
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Si, Eliminar!',
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                $http.post("class/angularSql.php", {EliminarProducto:id}).success(function(data){$scope.listarProductos()});
                sweet.show('Eliminado!', 'El producto se ha eliminado de forma permanente.', 'success');
            }else{
                sweet.show('Cancelado', 'El producto no se ha eliminado', 'error');
            }
        });
}
})