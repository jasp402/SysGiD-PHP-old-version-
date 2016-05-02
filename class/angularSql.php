<?php
session_start(); 
error_reporting (0);
require 'database.local.php';


if(isset($request->inciarSesion)){ 
    $usuario  = $request->inciarSesion->ngName; 
    $contrasena = $request->inciarSesion->ngPassword;
    cargarUsuario($usuario,$contrasena); 
}

if(isset($request->SessionId)){
$id = $request->SessionId;
cargarUsuarioID($id);
}

if(isset($request->ngIdUsuario)){
    $idUsuario = $request->ngIdUsuario;
    permisosUsuarios($idUsuario);
}


if(isset($request->RegistrarUsu)){
    $submenu = $request->submenu;
    echo json_encode($submenu);
}

//Registrar Usuario
if(isset($request->registrarUsuario)){
    $NewUser = $request->registrarUsuario;
   RegistrarUsuario($NewUser);
}

//Listar Usuario
if(isset($request->ListarUsuario)){
  $status = $request->ListarUsuario;
   ListarUsuario($status);
}


//Eliminar/suspender/reactivar Usuario (Manipulación Logica)
if(isset($request->statusUser)){
    $idUser = $request->IdUser;
    $Status = $request->statusUser;
   UpdateUsuario($idUser, $Status);
}

//Listar Modulos 
if(isset($request->ListarModulo)){
    $idUser = $request->ListarModulo;
   ListarModulo($idUser);
}

//Modificar Permisos
if(isset($request->UpdatePermiso)){
    $value = $request->UpdatePermiso;
    $diusr = $request->idUser;
    $idmod = $request->idModulo;
   UpdatePermisos($value, $diusr, $idmod);
}

//Editar Usuario (ActulizarUsuarioSQL)
if(isset($request->ActulizarUsuarioSQL)){
    $User = $request->ActulizarUsuarioSQL;
   ActualizarUsuario($User);
}

//Registrar Empresas de Transporte (TablaSQL: empresa_transporte)
if(isset($request->RegEmpresaTransporte)){
    $ET = $request->RegEmpresaTransporte;
   RegEmpresaTransporte($ET);
}

//Listar Todas las empresas de Transporte
if(isset($request->listarET)){
   listarEmpresaTransporte();
}

//Listar Todos los Transportistas registrados
if(isset($request->listarT)){
   listarTransporte();
}

//Registrar Empresas de Transporte (TablaSQL: transportista)
if(isset($request->RegTransporte)){
    $T = $request->RegTransporte;
   RegTransporte($T);
}


//Registrar Categoria de Productos
if(isset($request->InvCategoria)){
    $Cat = $request->InvCategoria;
   RegInvCategoria($Cat);
}





//Eliminar la Categoria de Productos
if(isset($request->EliminarCatProduc)){
   $IdCat = $request->EliminarCatProduc;
   EliminarCatProduc($IdCat);
}


//Registrar Tipo de Productos
if(isset($request->InvTipoProd)){
    $TipoProd = $request->InvTipoProd;
   RegInvTipoProd($TipoProd);
}


//Eliminar la Categoria de Productos
if(isset($request->EliminarTipoProduc)){
   $IdTipo = $request->EliminarTipoProduc ;
   EliminarTipoProduc($IdTipo);
}

//Registrar Productos
if(isset($request->RegProducto)){
   $prod = $request->RegProducto;
   RegistrarProducto($prod);
}

//Listar tipos de productos
if(isset($request->listarTIP)){
   listarTipoProductos();
}
//Listar Categorias de Productos
if(isset($request->listarCAT)){
   listarCategoriaProductos();
}

//Listar los productos
if(isset($request->listarProductos)){
   listarProductos();
}


//Dirección (Provincia, Distritos y Departamentos)
if(isset($request->listarDepartamentos)){listarDepartamentos();}
if(isset($request->listarProvincias)){$id = $request->listarProvincias;   listarProvincias($id);}
if(isset($request->listarDistritos)){$id =  $request->listarDistritos;    listarDistritos($id);}


if(isset($request->RegCliente)){
   $cliente = $request->RegCliente;
   RegCliente($cliente);
}

//buscar Categoria segun IdTipo Producto
if(isset($request->BuscarPRO)){
   $idTipo = $request->BuscarPRO->idtipo;
   $idCatg  = $request->BuscarPRO->idCatg;
   BuscarPRO($idTipo,$idCatg);
}

//Listar los Clientes
if(isset($request->listarClientes)){
   listarClientes();
}

//Listar estatus de facturas 
if(isset($request->ListarEstatusFact)){
   ListarEstatusFact();
}


//Listar estatus de facturas 
if(isset($request->ListarFact)){
   ListarFact();
}


//Eliminar Productos
if(isset($request->EliminarProducto)){
$id =$request->EliminarProducto;
   EliminarProducto($id);
}

//Registrar Factura
if(isset($request->registrarFact)){
$data =$request->registrarFact;
   registrarFact($data);
}
//registrar Detalle de factura
if(isset($request->registrarFactDetalle)){
$data = $request->registrarFactDetalle;
ExecutetSQL($data);
   //registrarFactDetalle($data);
}


if(isset($request->SelectSQL)){
SelectSQL($request->SelectSQL);
}

if(isset($request->ExecutetSQL)){
ExecutetSQL($request->ExecutetSQL);
}

if(isset($request->NumRowsSQL)){
NumRowsSQL($request->NumRowsSQL);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function cargarUsuario($usuario,$contrasena){
   $sql = "SELECT * FROM usuarios WHERE login = '$usuario' AND password ='$contrasena' AND estatus != 'e'"; 
    try {
        $db = getConnection();
        $stmt = $db->query($sql);  
        $usuario = $stmt->fetchObject();
        $db = null;
       echo  json_encode($usuario);
       $_SESSION['usuario'] =  $usuario->id_usuario; //Cargamos la variable de sesion
    } 
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
   
}

function cargarUsuarioID($id){
   $sql = "SELECT * FROM usuarios WHERE id_usuario = '$id' AND estatus != 'e'"; 
   SelectObjectSQL($sql);
}


  function permisosUsuarios($idUsuario){
    
      $sql="SELECT * FROM config_modulos AS m, permisos AS p WHERE p.id_usuario = '$idUsuario' AND p.id_modulo = m.id_modulo and p.estatus='true'  ORDER BY m.orden ASC";
      try {
        $db = getConnection();
        $stmt = $db->query($sql);  
        $data = $stmt->fetchAll();
        $db = null;
        echo json_encode($data);
    } 
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
  }

   /* function CargarSubMenu($submenu){
    $sql="SELECT m.submodulo  FROM modulos AS m, permisos AS p WHERE p.id_usuario = '1' AND p.id_modulo = m.id_modulo and p.estatus='true'  ORDER BY m.orden ASC";
    $itemsMenu = explode(';', SelectOneSQL($sql));
    return $itemsMenu;
  } */

    function RegistrarUsuario($NewUser){
        $fecha_registro=date("j-M-Y | h:i a");
        $sql="INSERT INTO usuarios(login, password, nombres, apellidos, sexo, cedula, mail, telefono, tlf_mobil, fecha_nacimiento, direccion, provincia, cargo,  fecha_registro, estatus) VALUES ('$NewUser->UserEmail','$NewUser->UserPassword','$NewUser->UserNombres','$NewUser->UserApellidos','$NewUser->UserSexo','$NewUser->UserDni','$NewUser->UserEmail','$NewUser->UserTlf','$NewUser->UserTlfCel','$NewUser->UserFechaN','$NewUser->UserDir','$NewUser->provincia','$NewUser->cargo','$fecha_registro','S/V')";
        InsertSQL($sql);

        $sql="SELECT id_usuario from usuarios order by id_usuario desc limit 1";
        $idNewUser = SelectOneSQL($sql);

        $sql="SELECT * FROM config_modulos WHERE estatus='a'";
        $numModulos = NumRowsSQL($sql);

        for($i=0; $i<$numModulos; $i++){
        $j = ($i+1);
        $sql="INSERT INTO permisos(id_usuario, id_modulo, estatus) VALUES ('$idNewUser','$j','false')";
        InsertSQL($sql);
        }
    } 

    function ListarUsuario($status){
        $sql ="SELECT * FROM usuarios WHERE estatus = '$status'";
        SelectSQL($sql);
    }

    function UpdateUsuario($idUser, $Status){
            $sql="UPDATE usuarios SET estatus = '$Status' WHERE id_usuario='$idUser'";
            UpdateSQL($sql);
    }       


  function ListarModulo($idUsuario){
    
     $sql="SELECT * FROM config_modulos AS m, permisos AS p WHERE p.id_usuario = '$idUsuario' AND p.id_modulo = m.id_modulo ORDER BY m.orden ASC";
     SelectSQL($sql);
  }

 function UpdatePermisos($value, $idUsr, $idMod){
    $sql="SELECT estatus FROM usuarios WHERE id_usuario= '$idUsr'";
    $estatus = SelectOneSQL($sql);

    if($estatus == 'S/V'){ $sql="UPDATE usuarios SET estatus='a' WHERE id_usuario=$idUsr"; UpdateSQL($sql);  }

    $sql="UPDATE permisos SET estatus='$value' WHERE id_usuario = '$idUsr' and id_modulo = '$idMod'";
    UpdateSQL($sql);
 }  
//
 function ActualizarUsuario($User){
 $sql="UPDATE `usuarios` SET 
 `nombres`='$User->UserNombresUpdate',
 `apellidos`='$User->UserApellidosUpdate',
 `sexo`='$User->UserSexoUpdate',
 `cedula`='$User->UserDniUpdate',
 `telefono`='$User->UserTlfUpdate',
 `tlf_mobil`='$User->UserTlfCelUpdate',
 `fecha_nacimiento`='$User->UserFechaNUpdate',
 `direccion`='$User->UserDirUpdate',
 `provincia`='$User->provinciaUdate',
 `img_url`='$User->uploadFile',
 `cargo`='$User->cargoUpdate'
  WHERE id_usuario='$User->IdUser'";


 // $sql="UPDATE usuarios SET nombres='$User->UserNombres', apellidos='$User->UserApellidos' WHERE id_usuario='$User->IdUser'";
  UpdateSQL($sql);
 }



 function RegEmpresaTransporte($ET){
$sql="INSERT INTO `transporte_empresas`(`RUC`, `razonsocial`, `direccion`, `distrito`, `telefono`, `correo`, `representante`, `lugar_despacho`, `estatus`) VALUES 
('$ET->ET_RUC',
 '$ET->ET_razonsocial',
 '$ET->ET_direccion',
 '$ET->ET_distrito',
 '$ET->ET_telefono',
 '$ET->ET_correo',
 '$ET->ET_representante',
 '$ET->ET_lugar_despacho',
 'a')";
 InsertSQL($sql);
 }

function listarEmpresaTransporte(){
  $sql='SELECT * FROM `transporte_empresas`';
  SelectSQL($sql);
}


function RegTransporte($T){
$sql="INSERT INTO `transporte_transportistas`(`nombre`, `apellidos`, `telefono`, `direccion`, `marca`, `numero_placa`, `licencia_conducir`, `idempresa_transporte`) VALUES
     ('$T->T_nombre',
      '$T->T_apellidos',
      '$T->T_telefono',
      '$T->T_direccion',
      '$T->T_marca',
      '$T->T_numero_placa',
      '$T->T_licencia_conducir',
      '$T->T_idempresa_transporte')";
 InsertSQL($sql);
}

function listarTransporte(){
  $sql='SELECT * FROM `transporte_transportistas` as tt , `transporte_empresas` as te WHERE te.idempresa_transporte = tt.idempresa_transporte';
  SelectSQL($sql);
}


function RegInvCategoria($Cat){
  $sql="INSERT INTO `producto_categoria`(`nombre`, `descripcion`) VALUES ('$Cat->cat_nombre','$Cat->cat_descripcion')";
  InsertSQL($sql);
}

function listarCategoriaProductos(){
$sql="SELECT * FROM `producto_categoria`";
  SelectSQL($sql);
}


function EliminarCatProduc($IdCat){
$sql="DELETE FROM `producto_categoria` WHERE idcategoria = '$IdCat'";
ExecutetSQL($sql); 
}


function listarTipoProductos(){
  $sql="SELECT * FROM `producto_tipo`";
  SelectSQL($sql);
}


function RegInvTipoProd($TipoProd){
  $sql="INSERT INTO `producto_tipo`(`nombre`, `descipcion`) VALUES ('$TipoProd->Tipo_nombre','$TipoProd->Tipo_descipcion')";
  ExecutetSQL($sql);
}

function EliminarTipoProduc($IdTipo){
  $sql="DELETE FROM `producto_tipo` WHERE `idtipo_producto` = '$IdTipo'";
  ExecutetSQL($sql);
}

function RegistrarProducto($prod){
 echo $sql="INSERT INTO `producto`(`cod_producto`, `nombre_producto`, `medida`, `disponible`, `peso`, `precio`, `idcategoria`, `idtipo_producto`, `color`) VALUES 
  ('$prod->cod_producto',
   '$prod->nombre_producto',
   '$prod->medida',
   '$prod->cant',
   '$prod->peso',
   '$prod->precio',
   '$prod->idcategoria',
   '$prod->idtipo_producto',
   '$prod->color')";
  ExecutetSQL($sql);
}

function listarProductos(){
  $sql="SELECT * FROM `producto` as p, producto_categoria as c, producto_tipo as t WHERE p.idtipo_producto = t.idtipo_producto and p.idcategoria = c.idcategoria order by `id_producto`";
  SelectSQL($sql);
}



function listarDepartamentos(){ 
  $sql="SELECT * FROM `ub_departamentos` order by `departamento`";  
  SelectSQL($sql);
}
function listarProvincias($id){    
  $sql="SELECT * FROM `ub_provincias` WHERE ubdepartamento_idDepa = '$id' order by `provincia`";     
  SelectSQL($sql);
}
function listarDistritos($id){     
  $sql="SELECT * FROM `ub_distritos` WHERE idProv = '$id' order by `distrito`";      
SelectSQL($sql);
}



function RegCliente($cliente){
   $fecha=date("Y-m-d");
 echo $sql="INSERT INTO `ventas_clientes`(`DNI`, `RUC`, `direccion_RUC`, `razonsocial`, `nombre`, `apellido`, `contacto`, `telefono`, `telefono2`, `correo`, `banco`, `cuenta_bancaria`,  `departamento`, `provincia`, `distrito`, `direccion`, `fecha_reg_cliente`,`tipo_cliente`, `saldo_actual`, `estatus`) VALUES 
  ('$cliente->DNI',
  '$cliente->RUC',
  '$cliente->direccion_RUC',
  '$cliente->razonsocial',
  '$cliente->nombre',
  '$cliente->apellido',
  '$cliente->contacto',
  '$cliente->telefono',
  '$cliente->telefono2',
  '$cliente->correo',
  '$cliente->banco',
  '$cliente->cuenta_bancaria',
  '$cliente->departamento',
  '$cliente->provincia',
  '$cliente->distrito',
  '$cliente->direccion',
  '$fecha',
  '$cliente->tipo_cliente',
  0,
  'a')";
ExecutetSQL($sql);
}


function BuscarPRO($idTipo,$idCatg){
  $sql="SELECT * FROM `producto` WHERE `idcategoria` ='$idCatg' AND `idtipo_producto`='$idTipo'";
  SelectSQL($sql);
}

function ListarClientes(){
  $sql="SELECT * FROM `ventas_clientes`";
  SelectSQL($sql);
}

function ListarEstatusFact(){
  $sql="SELECT * FROM `factura_estado`";
  SelectSQL($sql);
}


function ListarFact(){
  $sql="SELECT * FROM `factura_guia` as f, ventas_clientes as c, factura_estado as fe WHERE f.`id_cliente`=c.`id_cliente` AND fe.`id_estado_fac` = f.`id_estado_fac` ORDER BY `id_fact_guia` DESC";
  SelectSQL($sql);
}


function EliminarProducto($id){
  $sql="DELETE FROM `producto` WHERE `id_producto`='$id'";
  ExecutetSQL($sql);
}

function registrarFact($data){
  $fecha=date("Y-m-d");
  $hora=date("h:i");
echo $sql="INSERT INTO `factura_guia`(`numero_factura`, `fecha_creacion`, `hora`, `comentario`, `tipo_pago`, `total`, `total_productos`, `id_cliente`, `id_estado_fac`, `descuento`) VALUES
 ('$data->numero_factura',
  '$fecha',
  '$hora',
  '$data->comentario',
  '$data->tipo_pago',
  '$data->total',
  '$data->cantTotal',
  '$data->id_cliente',
  '$data->id_estado_fac',
  $data->descuento')";
  ExecutetSQL($sql);
  ListarFact();
}


?>