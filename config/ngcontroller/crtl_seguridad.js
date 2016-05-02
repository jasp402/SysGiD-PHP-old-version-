//-----------------------------------------------------------------------------CONTROL FACTURACION
app.controller('ngControlSeguridad', function(public,query,Factory, SQLGlobal, $scope, $http, $location, $routeParams, $timeout,$filter, sweet, AlertGlobal){ // $scope.chart = CharsGlobal;

  $scope.public   = public;
  $scope.alert    = AlertGlobal;
  $scope.SQL      = SQLGlobal;

  $scope.alert.bienvenida('Facturación','¡Porfavor No desespere!'); 

  $scope.public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
  $scope.public.ngTitle = 'SysGiD | Clientes';


$scope.fdata={};
$scope.equals = true;
$scope.validatePassword = function(){

$scope.equals = angular.equals($scope.fdata.UserPassword, $scope.fdata.UserRePassword);
if(!$scope.equals){$scope.equals = false; $scope.PassMsj = "La contraseña debe coincidir."; $scope.PassClass="callout callout-info"}
if($scope.fdata.UserPassword.length < 6){ $scope.equals = false; $scope.PassMsj = "La contraseña debe ser mayor a 6 Caracteres."; $scope.PassClass="callout callout-warning"}
if($scope.fdata.UserPassword.length > 8){ $scope.equals = false; $scope.PassMsj = "La contraseña no puede ser mayor a 8 Caracteres."; $scope.PassClass="callout callout-danger"}
}








$scope.regresarMensaje = function(){

$http.post("class/angularSql.php", {ListarUsuario:'S/V'}).success(function(data){$scope.UserInactivos = data});
$http.post("class/angularSql.php", {ListarUsuario:'a'}).success(function(data){$scope.UserActivos = data});
$http.post("class/angularSql.php", {ListarUsuario:'s'}).success(function(data){$scope.UserSuspendidos = data});
$http.post("class/angularSql.php", {ListarUsuario:'e'}).success(function(data){$scope.UserEliminados = data});
$timeout( function(){ if($scope.mensajeActulizar){$scope.mensajeActulizar = false} }, 5000);
}



//-------------------------Cotroles de Seguridad------------------------------------
//Consultar Usuarios sugun su estatus
$http.post("class/angularSql.php", {ListarUsuario:'S/V'}).success(function(data){$scope.UserInactivos = data});
$http.post("class/angularSql.php", {ListarUsuario:'a'}).success(function(data){$scope.UserActivos = data});
$http.post("class/angularSql.php", {ListarUsuario:'s'}).success(function(data){$scope.UserSuspendidos = data});
$http.post("class/angularSql.php", {ListarUsuario:'e'}).success(function(data){$scope.UserEliminados = data});


//PENDIENTE VARIABLES GOBALES
//Consultar direcciones (Provincias, Distritos y Departamentos)
$http.post("class/angularSql.php", {listarProvincias:''}).success(function(data){$scope.listarProvincias = data}); 
$http.post("class/angularSql.php", {listarDistritos:''}).success(function(data){$scope.listarDistritos = data}); 
$http.post("class/angularSql.php", {listarDepartamentos :''}).success(function(data){$scope.listarDepartamentos = data}); 




//SEGURIDAD
$scope.provincias = ['Amazonas',
'Ancash','Apurímac','Arequipa','Ayacucho','Cajamarca','Cuzco','Huancavelica','Huánuco ','Ica','Junín','La Libertad', 
'Lambayeque' ,'Lima','Loreto','Madre de Dios','Moquegua','Pasco','Piura','Puno','San Martín','Tacna','Tumbes','Ucayali'];





//SEGURIDAD
$scope.distritos = ['La Victoria','Ate Vitarte','Callao','Cercado','La Victoria','Lima','Lince','Los Olivos','RIMAC','S.M.P','San Isidro',
'San Luis','Santa Anita'];

//SEGURIDAD
$scope.area_cargos = {
                'Administración':['Gerente de administración', 'Analista Principal'],
                'Contabilidad':  ['Gerente de Contabilidad', 'Analista de Compras', 'Analista de Ventas', 'analista de banco'],
                'Almacen':       ['Gerente de Almacen', 'Supervisor de Almacen', 'Amlacenista']   
                          };








$scope.registrarUsuario = function(){
  if($scope.equals){
      $http.post("class/angularSql.php", {registrarUsuario:$scope.fdata}).success(function(data){
        //console.log(data);
       $scope.success=true; 
       $scope.NewNombres = $scope.fdata.UserEmail;
       $scope.NewPassword = $scope.fdata.UserPassword;
       $scope.fdata = '';
       $http.post("class/angularSql.php", {ListarUsuario:'S/V'}).success(function(data){$scope.UserInactivos = data});
      });
  }
}

$scope.disable = true;
$scope.active = 'disabled';
$scope.classwidget = 'widget-user-header';
$scope.UpdateNombre = 'Nombre de Usuario';
$scope.UpdateCargo = 'Puesto de Trabajo';
$scope.CargarUser = function(value){
$scope.disable = false;
$scope.classwidget = 'widget-user-header  bg-aqua-active';
$scope.active = '';
$scope.UpdateIdUser = value.id_usuario;
$scope.UpdateNombre = value.nombres;
$scope.UpdateCargo =  value.cargo;
$scope.UpdateImg = value.img_url;
$scope.Updatesexo = value.sexo;
$scope.dataUser = value;
}

$scope.UpdateUser = function(value, status){
switch(status) {
case 'e':
$scope.msj = 'eliminar'; 
$scope.msj2 = '!Usuario Elminado! \n para revertir está acción debe contactar a los Administradores del Sistema';
break;
case 's':
$scope.msj = 'suspender';
$scope.msj2 = '!Usuario Suspendido! \n Puede revertir está Acción en opciones avanzadas';
break;
case 'a':
$scope.msj = 'reactivar';
$scope.msj2 = '!Usuario Reactivado!';
break;
}

confirmar=confirm("¿Desea " + $scope.msj + " este Usuario?"); 
if (confirmar){ // si pulsamos en aceptar
$http.post("class/angularSql.php", {IdUser:value, statusUser:status}).success(function(data){
$http.post("class/angularSql.php", {ListarUsuario:'a'}).success(function(data){$scope.UserActivos = data});
$http.post("class/angularSql.php", {ListarUsuario:'e'}).success(function(data){$scope.UserEliminados = data});
$http.post("class/angularSql.php", {ListarUsuario:'s'}).success(function(data){$scope.UserSuspendidos = data});
$http.post("class/angularSql.php", {ListarUsuario:'S/V'}).success(function(data){$scope.UserInactivos = data});
});
alert($scope.msj2);
}else{ // si pulsamos en cancelar bg-green
exit;
}
}

//-------------------------------------------Editar Permisos 
$scope.ShowPermisos = false;
$scope.UpdatePermisos = function(value, data){
$scope.DataUser = data;
$http.post("class/angularSql.php", {ListarModulo:data.id_usuario}).success(function(data){$scope.modulos = data});
$scope.ShowPermisos = true;
$scope.Lista = false;
}

$scope.AsigPermiso =function(value,idUser, idModulo, title){
  var value = new String(value); 
  if(value=='true'){ var msj = 'Habilitado' }else{var msj = 'Deshabilitado'}
  alert("Usted a " +msj +" el Modulo " + title);
$http.post("class/angularSql.php", {UpdatePermiso:value, idUser:idUser, idModulo:idModulo}).success(function(data){
$http.post("class/angularSql.php", {ngIdUsuario: $scope.usuario.id_usuario}).success(function(data){ return $scope.DatosMenu = data})});
$http.post("class/angularSql.php", {ListarUsuario:'S/V'}).success(function(data){$scope.UserInactivos = data});
$http.post("class/angularSql.php", {ListarUsuario:'a'}).success(function(data){$scope.UserActivos = data});
}

$scope.hidePermisos = function(){
  $scope.ShowPermisos = false;
}
// --------------------------------------------Editar Usuario
$scope.EditarUsuario = function(value, data){
$scope.DataUser = data;
$scope.EditUser = true; 
$scope.ShowPermisos = false; 
$scope.Lista = false;
//console.log("EditarUsuario() "+$scope.EditUser +"/"+$scope.ShowPermisos +"/"+ $scope.Lista); 
}

$scope.hideEdit = function(){
  $scope.EditUser = false;  
}
//console.log($scope.EditUser +"/"+$scope.ShowPermisos +"/"+ $scope.Lista); 









//-------------------------Cotroles de Seguridad / Registrar Usario------------------

//------------------------- Update Usuario (Editar) //----------------------------------------


 $scope.doUpload = function(){

        console.log('title',$scope.fdata.UserDniUpdate);
        console.log('uploadFile',$scope.fdata.uploadFile);
        //alert('Do upload. See console for data');


        

        //create form data object
        var fd = new FormData();
        fd.append('name', $scope.fdata.UserDniUpdate);
        fd.append('file', $scope.fdata.uploadFile);
        fd.append('with', 128); 

        //send the file / data to your server
        $http.post('class/fileupoad.php', fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        }).success(function(data){
          console.log('success \n' + data)  //do something on success
        }).error(function(err){
          console.log('error')  //do something on error
        })
                  
    }







$scope.fdata = {};
 $scope.clearform = function(){ 
 $scope.fdata.UserNombresUpdate = '';
 $scope.fdata.UserApellidosUpdate = '';
 $scope.fdata.UserDniUpdate = '';
 $scope.fdata.UserSexoUpdate = '';
 $scope.fdata.UserFechaNUpdate = '';
 $scope.fdata.cargoUpdate = '';
 $scope.fdata.UserDirUpdate = '';
 $scope.fdata.provinciaUdate = '';
 $scope.fdata.UserTlfUpdate = '';
 $scope.fdata.UserTlfCelUpdate = '';
 }


$scope.ActualizarUsuario = function(value,fdata){

  $scope.doUpload();


  if(!fdata.UserNombresUpdate)   {fdata.UserNombresUpdate   = value.nombres}
  if(!fdata.UserApellidosUpdate) {fdata.UserApellidosUpdate = value.apellidos}
  if(!fdata.UserDniUpdate)       {fdata.UserDniUpdate       = value.cedula}
  if(!fdata.UserSexoUpdate)      {fdata.UserSexoUpdate      = value.sexo}
  if(!fdata.UserFechaNUpdate)    {fdata.UserFechaNUpdate    = value.fecha_nacimiento}
  if(!fdata.cargoUpdate)         {fdata.cargoUpdate         = value.cargo}
  if(!fdata.UserDirUpdate)       {fdata.UserDirUpdate       = value.direccion}
  if(!fdata.provinciaUdate)      {fdata.provinciaUdate      = value.provincia}
  if(!fdata.UserTlfUpdate)       {fdata.UserTlfUpdate       = value.telefono}
  if(!fdata.UserTlfCelUpdate)    {fdata.UserTlfCelUpdate    = value.tlf_mobil}
  if(!fdata.uploadFile)          {fdata.uploadFile          = value.img_url}else{fdata.uploadFile = "dist/img/users/" + $scope.fdata.uploadFile.name}

  console.log(fdata.uploadFile);
  fdata.IdUser = value.id_usuario;
 $http.post("class/angularSql.php", {ActulizarUsuarioSQL:fdata})
  .success(function(data){
    //console.log(data);
    $scope.mensajeActulizar = true;  
    $scope.regresarMensaje();
    $scope.clearform();
  }); 
}

})