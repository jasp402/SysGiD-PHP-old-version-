    <div class="wrapper"  ng-init="changeClass()">
    <?php include_once('../../../config/topbar.html'); ?>
    <?php include_once('../../../config/menubar.html'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Seguridad <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> SysGiD</li>
            <li><a href="#">{{obj.ngMenu.titulo}}</a></li>
            <li class="active">{{subMenuSelect}}</li>
          </ol>
        </section>

        <!-- Main content -->


<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="" ng-click="ActClass('Registrar Usuario')" data-toggle="tab">Registrar Usuario</a></li>
                  <li><a href="" ng-click="ActClass('Listar Usuario')"  data-toggle="tab">Listar Miembros <span ng-if="UserInactivos.length" class="label label-danger" ng-show="intms">{{UserInactivos.length}} Nuevos</span></a> </li>
                </ul>
                <div class="tab-content" ng-switch on="subMenuSelect">
                <!-- start/ registrar Usuario -->
                  <div ng-switch-default class="active tab-pane" id="activity"><!-- tab-panel Registrar Usario -->
                    <form class="form-horizontal"  ng-submit="registrarUsuario()">

<div class="col-xs-12">
              <h2 class="page-header">
                <span class="pull-right"><a>Inicio de Sesión <i class="fa fa-unlock"></i></a></span>  <br>
              </h2>
</div>
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Login</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Mail" ng-model="fdata.UserEmail" required>
                        </div>
                    </div>
                       <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-5">
                         <input type="password" placeholder="Password" class="form-control" id="inputName" ng-change="validatePassword()"  ng-model='fdata.UserPassword' ng-disabled="!fdata.UserEmail">
                        </div>
                        <div class="col-sm-5">
                           <input type="Password" placeholder="Repetir Password" class="form-control" id="inputName" ng-change="validatePassword()" ng-model='fdata.UserRePassword' ng-disabled="!fdata.UserPassword">
                        </div>
                      </div>
                  <div ng-if='!equals'  ng-class="PassClass">
                    <h4>Espere un momento!</h4>
                    <p>{{PassMsj}}</p>
                  </div>
<div class="col-xs-12">
              <h2 class="page-header">
                <span class="pull-right"><a>Datos del Usuario <i class="fa fa-user-plus"></i></a></span>  <br>
              </h2>
</div>

                    <!--Nombre y Apellido -->
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nombres / Apellidos</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control"  placeholder="Nombres" ng-model="$parent.fdata.UserNombres" required>
                        </div>
                        <div class="col-sm-5">
                          <input type="text" class="form-control"  placeholder="Apellidos" ng-disabled="!fdata.UserNombres" ng-model="$parent.fdata.UserApellidos" required>
                        </div>
                      </div>
                    <!--Area y Cargo-->
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">*Area / Cargo</label>
                        <div class="col-sm-5">
                           <select class="form-control" ng-model="fdata.area"  ng-options="areas for (areas, cargos) in area_cargos" ng-disabled="!fdata.UserApellidos" required>
                                      <option value="" Disabled>- Area -</option>
                          </select>
                        </div>
                        <div class="col-sm-5">
                          <select class="form-control" ng-model="fdata.cargo" ng-disabled="!fdata.area" ng-options="cargos for cargos in fdata.area" required>
                                      <option value="" Disabled>- Cargo -</option>
                          </select>
                        </div>
                      </div>
                    <!-- dni y Email  -->
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">DNI/ sexo/ Fecha de Nacimiento</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputName" placeholder="DNI" ng-model="$parent.fdata.UserDni" ng-disabled="!fdata.cargo" required>
                        </div>
                       
                        <div class="col-sm-3">
                       <select class="form-control"  ng-disabled="!fdata.UserDni" ng-model="$parent.fdata.UserSexo" required>
                            <option value="" Disabled>- Sexo -</option>
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                          </select>
                        </div>
                          <div class="col-sm-4">
                         <input type="date" class="form-control" ng-disabled="!fdata.UserDni" id="inputName" ng-model="$parent.fdata.UserFechaN" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Dirección / Provincia</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="inputName" placeholder="Dirección" ng-model="fdata.UserDir" ng-disabled="!fdata.UserFechaN" required>
                        </div>
                        <div class="col-sm-4">
                          <select class="form-control"   ng-model="fdata.provincia" ng-options="o as o for o in provincias" ng-disabled="!fdata.UserDir" required>
                            <option value="" Disabled>- Provincia -</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                       <label for="inputEmail" class="col-sm-2 control-label">Email / Telefono</label>
                        <div class="col-sm-5">
                          <input type="tel" class="form-control"  placeholder="Telefono Fijo" ng-disabled="!fdata.provincia" ng-model="$parent.fdata.UserTlf">
                        </div>
                        <div class="col-sm-5">
                          <input type="tel" class="form-control"  placeholder="Telefono Celular" ng-disabled="!fdata.UserTlf" ng-model="$parent.fdata.UserTlfCel">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                          <br>
                            <label>
                              <input type="checkbox" required> Acepto los <a href="#">terminos y condiciones</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                  <div ng-if='success' class="callout callout-success">
                    <h4>Usuario Registrado satisfactoriamente</h4>
                    <p>Usuario: {{NewNombres}}<br>
                       Password: {{NewPassword}} <br>
                       Recuerde que debe asignarle los permisos correspondientes en <a href="" ng-click="ActClass('Listar Usuario')"><b>Asignar Permisologia</b></a> </p>
                  </div>


                          <input  type="submit" class="btn btn-danger" ng-if='!success' value="Registrar Usruario">
                        </div>

                      </div>
                    </form>   
                  </div><!-- /.tab-panel Registrar Usario -->

                  <div ng-switch-when="Listar Usuario" class="active tab-pane" id="timeline">
                  
                  <!--Vista Basica-->
                  <div ng-show="!Lista && !ShowPermisos && !EditUser">
                      <ul class="users-list clearfix">
                      <li ng-click="CargarUser(users)" ng-class="active" ng-repeat="users in UserInactivos">
                      <span class="badge bg-red">Sin Permisos</span>
                          <img ng-if="users.sexo == 'mujer' && !users.img_url" src="dist/img/avatar2.png" alt="User Image">
                          <img ng-if="users.sexo == 'hombre' && !users.img_url" src="dist/img/avatar5.png" alt="User Image">
                          <img ng-if="users.img_url" ng-src="{{users.img_url}}" alt="User Image">
                       <!--   <img ng-if="users.sexo == 'hombre'" src="{{users.img_url}}" alt="User Image"> -->
                          <a class="users-list-name" href="">{{users.nombres}}</a>
                          <span class="users-list-date">{{users.cargo}}</span>
                        </li>
                        </ul>
                        <ul class="users-list clearfix">
                         <li ng-click="CargarUser(users)" ng-class="active" ng-repeat="users in UserActivos">
                          <img ng-if="users.sexo == 'mujer' && !users.img_url" src="dist/img/avatar2.png" alt="User Image">
                          <img ng-if="users.sexo == 'hombre' && !users.img_url" src="dist/img/avatar5.png" alt="User Image">
                          <img ng-if="users.img_url" ng-src="{{users.img_url}}" alt="User Image">
                          <a class="users-list-name" href="">{{users.nombres}}</a>
                          <span class="users-list-date">{{users.cargo}}</span>
                        </li>
                      </ul><!-- /.Lsita de Usarios -->
                  </div>
                      
<!-- Vista Avanzada -->
<table ng-show="Lista && !ShowPermisos && !EditUser"  class="table table-bordered">
                    <tbody>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre</th>
                      <th>DNI</th>
                      <th>Cargo</th>
                      <th>E-mail</th>
                      <th>Telefono</th>
                      <th>Sexo</th>
                      <th>Funciones</th>

                    </tr>
                    <tr> <th colspan="8" class="bg-green color-palette text text-center">Usuarios Activos</th> </tr>
                    <tr ng-repeat="users in UserActivos" class='small'>
                      <td>{{$index+1}}.-</td>
                      <td>{{users.nombres}}</td>
                      <td>{{users.cedula}}</td>
                      <td>{{users.cargo}}</td>
                      <td>{{users.mail}}</td>
                      <td>{{users.telefono}}</td>
                      <td>{{users.sexo}}</td>
                      <td><a href="" ng-if="usuario.id_usuario =='1' || users.id_usuario !='1'" ng-click="EditarUsuario(users.id_usuario, users); CargarUser(users)" class="glyphicon glyphicon-pencil"></a>
                          <a href="" ng-if="usuario.id_usuario =='1' || users.id_usuario !='1'" ng-click="UpdatePermisos(users.id_usuario, users); CargarUser(users); Lista = !Lista" class="glyphicon glyphicon-th-list"></a>
                          <a href="" ng-if="users.id_usuario !='1'" ng-click="UpdateUser(users.id_usuario, 's')" class="glyphicon glyphicon-ban-circle"></a>
                          <a href="" ng-if="users.id_usuario !='1'" ng-click="UpdateUser(users.id_usuario, 'e')" class="glyphicon glyphicon-remove"></a>
                      </td>
                    </tr>
                      <tr ng-show="UserSuspendidos.length"> <th colspan="8" class="bg-yellow color-palette text text-center">Usuarios Suspendidos</th> </tr>
                    <tr ng-repeat="users in UserSuspendidos" class='small'>
                      <td>{{$index+1}}.-</td>
                      <td>{{users.nombres}}</td>
                      <td>{{users.cedula}}</td>
                      <td>{{users.cargo}}</td>
                      <td>{{users.mail}}</td>
                      <td>{{users.telefono}}</td>
                      <td>{{users.sexo}}</td>
                       <td><a href="" class="glyphicon glyphicon-ban-circle" ng-click="UpdateUser(users.id_usuario, 'a')"></a></td>
                    </tr>
                    <tr ng-show="UserEliminados.length"> <th colspan="8" class="bg-red color-palette text text-center">Usuarios Eliminados</th> </tr>
                    <tr ng-repeat="users in UserEliminados" class='small'>
                      <td class="disabled"}>{{$index+1}}.-</td>
                      <td>{{users.nombres}}</td>
                      <td>{{users.cedula}}</td>
                      <td>{{users.cargo}}</td>
                      <td>{{users.mail}}</td>
                      <td>{{users.telefono}}</td>
                      <td>{{users.sexo}}</td>
                       <td>---</td>
                    </tr>
                  </tbody>
                  </table>

              <div ng-show="ShowPermisos && !EditUser" class="box">
                      <ul class="users-list clearfix">
                      <li  ng-class="active">
                      <span ng-if="DataUser.estatus != 'a'" class="badge bg-red">Sin Permisos</span>
                          <img ng-if="DataUser.sexo == 'mujer' && !DataUser.img_url" src="dist/img/avatar2.png" alt="User Image">
                          <img ng-if="DataUser.sexo == 'hombre' && !DataUser.img_url" src="dist/img/avatar5.png" alt="User Image">
                          <img ng-if="DataUser.img_url" ng-src="{{DataUser.img_url}}" alt="User Image"> 
                          <a class="users-list-name" href="">{{DataUser.nombres}}</a>
                          <span class="users-list-date">{{DataUser.cargo}}</span>
                        </li>
                        </ul>
                <div class="box-header">
                  <h3 class="box-title">Asignar &amp; Modificar Permisologia</h3>
                </div>
                <div class="box-body">

                <ul class="todo-list">                 
                <li ng-repeat="permiso in modulos">
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <input type="checkbox" ng-model="checked" ng-click="AsigPermiso(checked, DataUser.id_usuario, permiso.id_modulo, permiso.titulo)" class="minimal" ng-disabled="permiso.id_usuario == '1' && permiso.id_modulo =='5'" ng-checked="{{permiso.estatus}}">
                      <span class="text">Modulo {{permiso.titulo}} </span>
                      <small ng-if="checked" class="label label-default"><i class="fa fa-clock-o"></i>{{checked}}</small>
                      <div class="tools">
                        <i class="fa fa-edit"></i>
                        <i class="fa fa-trash-o"></i>
                      </div>
                    </li>
                </ul>
 
                </div><!-- /.box-body -->
                <div class="box-footer">
                <button class="btn btn-sm btn-primary" ng-click="hidePermisos()">Regresar</button>
                    Todos los cambios se efectuan de forma inmediata | <span class="glyphicon glyphicon-info-sign"></span> <a href="http://fronteed.com/iCheck/">Reportar inconveniente</a>
                </div>
              </div>



              <div ng-show="EditUser && !ShowPermisos" class="box">
              <div class="box-header">
                  <i class="fa fa-edit"></i>
                  <h3 class="box-title">Editar Usuario</h3>
                </div>         
                      <!-- <ul class="users-list clearfix">
                      <li  ng-class="active">
                      <h3 class="box-title">EDITAR USUARIO</h3>
                      <span ng-if="DataUser.estatus != 'a'" class="badge bg-red">Sin Permisos</span>
                          <img ng-if="DataUser.sexo == 'mujer' && !DataUser.img_url" src="dist/img/avatar2.png" alt="User Image">
                          <img ng-if="DataUser.sexo == 'hombre' && !DataUser.img_url" src="dist/img/avatar5.png" alt="User Image">
                          <img ng-if="DataUser.img_url" src="{{DataUser.img_url}}" alt="User Image"> 
                          <a class="users-list-name" href="">{{DataUser.nombres}}</a>
                          <span class="users-list-date">{{DataUser.cargo}}</span>
                        </li>
                        </ul> -->
<div class="row">
<form class="form-horizontal"  ng-submit="ActualizarUsuario(DataUser,fdata)">
                
                <div class="box-body">
                <div class="col-sm-2 users-list clearfix text-center">
                      <span  ng-class="active">
                      <span ng-if="DataUser.estatus != 'a'" class="badge bg-red">Sin Permisos</span>
                          <img ng-hide="previewImage" ng-if="DataUser.sexo == 'mujer' && !DataUser.img_url" src="dist/img/avatar2.png" alt="User Image">
                          <img ng-hide="previewImage" ng-if="DataUser.sexo == 'hombre' && !DataUser.img_url" src="dist/img/avatar5.png" alt="User Image">
                          <img ng-hide="previewImage" ng-if="DataUser.img_url" ng-src="{{DataUser.img_url}}" alt="User Image">
                         <!-- <img class="img-circle" ng-if="UpdateImg" src="{{UpdateImg}}">   -->
                         <img ng-if="previewImage" ng-src="{{previewImage}}" width="128" height="128">
                          <a class="users-list-name" href="">{{DataUser.nombres}}</a>
                          <span class="users-list-date">{{DataUser.cargo}}</span>

                         <file-field class="btn btn-primary btn-block" ng-model="fdata.uploadFile" ng-class="{'btn-success':fdata.uploadFile}" preview="previewImage">Seleccione una Foto</file-field><br>
                     </span>
                </div>

<!--UPDATE USER -->
                    
<div class="col-sm-10"><input class="form-control" ng-if='!mensajeActulizar' type="text" placeholder="{{DataUser.mail}}" ng-disabled="DataUser.mail"><br></div>                   
<div class="col-sm-5"><input class="form-control" ng-if='!mensajeActulizar' type="text" placeholder="{{DataUser.nombres}}" ng-model="fdata.UserNombresUpdate"><br></div>                   
<div class="col-sm-5"><input class="form-control" ng-if='!mensajeActulizar' type="text" placeholder="{{DataUser.apellidos}}" ng-model="fdata.UserApellidosUpdate"><br></div>                    
<div class="col-sm-3"><input class="form-control" ng-if='!mensajeActulizar' type="number" placeholder="{{DataUser.cedula}}" ng-model="fdata.UserDniUpdate"><br></div>
<div class="col-sm-3"><select class="form-control" ng-if='!mensajeActulizar' ng-model="fdata.UserSexoUpdate">
                        <option value="" Disabled>{{DataUser.sexo}}</option>
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                      </select>
</div>                    
<div class="col-sm-4"><input class="form-control" ng-if='!mensajeActulizar' type="date"   placeholder="{{DataUser.fecha_nacimiento}}" ng-model="fdata.UserFechaNUpdate"><br></div>                    
<div class="col-sm-5"><select class="form-control" ng-if='!mensajeActulizar' ng-options="areas for (areas, cargos) in area_cargos" ng-model="fdata.areaUpdate">  
                        <option value="" Disabled>- Area -</option>
                      </select><br>
</div>
<div class="col-sm-5"><select class="form-control" ng-if='!mensajeActulizar' ng-options="cargos for cargos in fdata.areaUpdate" ng-model="fdata.cargoUpdate">
                        <option value="" Disabled> {{DataUser.cargo}} </option>
                      </select><br>
</div>
<div class="col-sm-5"><input class="form-control" ng-if='!mensajeActulizar' type="text"  placeholder="{{DataUser.direccion}}" ng-model="fdata.UserDirUpdate" ><br></div>
<div class="col-sm-5"><select class="form-control" ng-if='!mensajeActulizar' ng-options="o as o for o in provincias" ng-model="fdata.provinciaUdate">
                        <option value="" Disabled>{{DataUser.provincia}}</option>
                      </select><br>
</div>
<div class="col-sm-2"></div>
<div class="col-sm-5"><input class="form-control" ng-if='!mensajeActulizar' type="tel"  placeholder="{{DataUser.telefono}}"  ng-model="fdata.UserTlfUpdate"><br></div>                      
<div class="col-sm-5"><input class="form-control" ng-if='!mensajeActulizar' type="tel"  placeholder="{{DataUser.tlf_mobil}}"  ng-model="fdata.UserTlfCelUpdate"><br></div>
<div class="col-sm-12"><button class="btn btn-warning btn-block btn-flat" ng-if='!mensajeActulizar' type="submit" >Guardar Cambios</button></div>

</form>                     
</div>


<!-- END UDATE USER -->
              
               <div ng-if='mensajeActulizar' class="callout callout-success">
                    <h4>Usuario Modificado satisfactoriamente</h4>
                       Si realizo cambio en su perfil, Le recomendamos <a href="#/" ng-click="ActClass('Listar Usuario')"><b>Refrescar esta pagina</b></a> </p>
                </div>


 
                </div><!-- /.box-body -->
                <div class="box-footer">
                <button class="btn btn-sm btn-primary" ng-click="hideEdit(); clearform()">Regresar</button>
                    Todos los cambios se efectuan de forma inmediata | <span class="glyphicon glyphicon-info-sign"></span> <a href="">Reportar inconveniente</a>
                </div>
              </div>

                    <div class="box-footer text-center">
                      <a href="" class="uppercase" ng-click="Lista = !Lista">
                      <span ng-if="!Lista && !ShowPermisos && !EditUser">Vista Avanzada</span> 
                      <span ng-if="Lista && !ShowPermisos && !EditUser">Vista Basica</span>
                    <!--  <span ng-if="ShowPermisos" ng-click="hidePermisos()">Regresar</span>  -->
                      </a>
                    </div><!-- /.ver lista -->
                  </div><!-- /.tab-panel Listar Usuario -->


                  
                </div><!-- /.End/-registrar Usuario -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col-md-9 -->




      <!-- Esto es el Recudadro col-md-3 --> 
            <div class="col-md-3" ng-switch on="subMenuSelect">           
              <div ng-switch-default class="box box-widget widget-user">
                <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username" ng-if="!fdata.UserNombres">Nombre de Usuario</h3>
                <h3 class="widget-user-username">{{fdata.UserNombres}} {{fdata.UserApellidos}}</h3>
                  <h5 class="widget-user-desc" ng-if="!model_municipio">Puesto de Trabajo: <br> {{fdata.cargo}}</h5>
               
                </div>
                <div class="widget-user-image">
                   <img class="img-circle" ng-src="{{previewImage}}" ng-show="previewImage">

                <!--  -->
                </div>
                <div class="box-body box-profile">
                <br>
                <h3 class="box-title">Datos del Usuario</h3>
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>DNI</b> <a class="pull-right">{{fdata.UserDni}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Nacimiento</b> <a class="pull-right">{{fdata.UserFechaN | date:'dd/M/yyyy'}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Mail</b> <a class="pull-right">{{fdata.UserEmail}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Telefono</b> <a class="pull-right">{{fdata.UserTlf}}</a>
                    </li>
                  </ul>
                 <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            <!--     -->
                </div><!-- /.box-body -->
              </div><!-- /.Registrar Usuario -->
              



            <div ng-switch-when="Listar Usuario" class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div ng-class="classwidget">
                <h3 class="widget-user-username">{{UpdateNombre}}</h3>
                  <h5 class="widget-user-desc">{{UpdateCargo}}</h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" ng-if="Updatesexo == 'mujer' && !UpdateImg" src="dist/img/avatar2.png">
                  <img class="img-circle" ng-if="Updatesexo == 'hombre' && !UpdateImg" src="dist/img/avatar5.png">
                  <img class="img-circle" ng-if="UpdateImg" ng-src="{{UpdateImg}}" alt="User Image">

                 <!-- <img class="img-circle" ng-if="!UpdateImg && !Updatesexo"  src="dist/img/foto.jpg" alt="User Avatar"> -->
                </div>
                <div class="box-footer">
                <h3 class="box-title">Menu de Opciones</h3>
                <div class="box-body no-padding">Modificar registro de Usuarios
                      <ul class="nav nav-pills nav-stacked">

              <li ng-class="active">
                <a href="" ng-if="usuario.id_usuario =='1' || UpdateIdUser !='1'" ng-hide="disable" ng-click="EditarUsuario(UpdateIdUser, dataUser)">
                <i class="fa fa-file-text-o"></i> Editar </a>

                <a href="" ng-if="UpdateIdUser =='1'  || !UpdateIdUser" ng-hide="!disable" >
                <i class="fa fa-file-text-o"></i> Editar </a>
             
              </li>
              <li ng-class="active">
                <a href="" ng-hide="disable" ng-click="UpdatePermisos(UpdateIdUser, dataUser); Lista = !Lista">
                <i class="fa fa-sliders"></i> Asignar Permisologia 
                <span ng-if="UserInactivos.length" class="label label-primary pull-right">{{UserInactivos.length}}</span></a>

                <a ng-hide="!disable"><i class="fa fa-sliders"></i> Asignar Permisologia </a>
              </li>
              <li ng-class="active">
              <a href="" ng-if="UpdateIdUser !='1'" ng-hide="disable" ng-click="UpdateUser(UpdateIdUser, 's')"><i class="fa fa-ban"></i> Suspender 
              <span ng-if="UserSuspendidos.length" class="label label-warning pull-right">{{UserSuspendidos.length}}</span></a>
              
              <a ng-if="UpdateIdUser =='1'  || !UpdateIdUser"  ng-hide="!disable"><i class="fa fa-ban"></i> Suspender </a>
              </li>

              <li ng-class="active">
              <a href="" ng-if="UpdateIdUser !='1'"  ng-hide="disable" ng-click="UpdateUser(UpdateIdUser, 'e')"><i class="fa fa-trash-o"></i> Eliminar
              <span ng-if="UserEliminados.length" class="label label-danger pull-right">{{UserEliminados.length}}</span></a>

              <a ng-if="UpdateIdUser =='1'  || !UpdateIdUser" ng-hide="!disable"><i class="fa fa-trash-o"></i> Eliminar </a>
              </li>
                      </ul>
                    </div>
                </div>
              </div>
          </div><!-- /.row -->
        </section><!-- /.content -->




      </div><!-- /.content-wrapper -->
<?php include_once('../../../config/footer_inside.html');  ?>

      <!-- Control Sidebar -->
<!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

