    <div class="wrapper"  ng-init="changeClass();">
    <?php include_once('../../../config/topbar.html'); ?>
    <?php include_once('../../../config/menubar.html'); ?>
      


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Transportistas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> SysGiD</li>
            <li><a href="#">{{public.ngMenu.titulo}}</a></li>
            <li class="active">{{public.ngVista}}</li>
          </ol>
        </section>

<section class="content">



<!---(boton) Registrar Empresa de Transporte-->
          <div class="row">


            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
                  <p>Registrar Empresa de<br>Transporte</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-bus"></i>
                </div>
                <a href="" class="small-box-footer" ng-click="cambiarVista('Registrar Empresa de Transporte')">Más info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->



<!---(boton) Registrar Transporte-->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
              <!--    <h3>150</h3> -->
                  <p>Registrar Transporte <br> &nbsp;</p>
                </div>
                <div class="icon">
                  <i class="ion ion-compose"></i>
                </div>
                <a href="" class="small-box-footer" ng-click="cambiarVista('Registrar Transporte')">Más info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
             </div><!-- ./col -->
            
                     
            
<!---(boton) Consultar Transportista & Empresa de Transporte-->
            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-teal-active">
                <div class="inner">
         <!--        <h3>44</h3> -->
                  <p>Consultar Transportista <br> & Empresa de Transporte</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
                <a href="" class="small-box-footer" ng-click="cambiarVista('Consultar')">Más info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->



</div> <!--/row-->




        <!-- Main content -->
 <!--
Reg: Registrar
ET: Empresa de transporte
 -->
          <div class="row" ng-switch on="public.ngVista">
            <div class="col-md-12 ">
              <div class="nav-tabs-custom box box-default">
                <div class="tab-content" >
                  
                  <div ng-switch-when="Registrar Empresa de Transporte" class="active tab-pane" id="activity"><!-- tab-panel Registrar Usario -->
                  
                  <div class="box-header">
                  <br>
                    <i class="fa fa-edit"></i>
                    <h3 class="box-title">{{public.ngVista}}</h3><hr>
                  </div>
                    
                    <form class="form-horizontal"  ng-submit="RegEmpresaTransporte(fdata)">
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Razón Social</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Razón Social" ng-model="fdata.ET_razonsocial" required>
                        </div>
                    </div>
                       <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">RUC</label>
                        <div class="col-sm-9">
                         <input type="number" class="form-control" placeholder="RUC" ng-model='fdata.ET_RUC' required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Dirección</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Dirección" ng-model="fdata.ET_direccion" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Distrito</label>
                        <div class="col-sm-9">
                          <select class="form-control"   ng-model="fdata.ET_distrito" ng-options="o as o for o in distritos" ng-disabled="!fdata.ET_direccion" required>
                            <option value="" Disabled>- Distritos -</option>
                          </select>
                        </div>
                      </div>
                    <!--Area y Cargo-->
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Telefono</label>
                        <div class="col-sm-9">
                          <input type="tel" class="form-control"  placeholder="Telefono"  ng-model="fdata.ET_telefono">
                        </div>
                      </div>
                    <!-- dni y Email  -->
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Correo / Pág. Web</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Correo" ng-model="fdata.ET_correo">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Representante</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Representante" ng-model="fdata.ET_representante">
                        </div>
                      </div>
                      <div class="form-group">
                       <label for="inputEmail" class="col-sm-2 control-label">Lugar de Despacho</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control"  placeholder="Lugar de Despacho"  ng-model="fdata.ET_lugar_despacho" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                  <div ng-if='success' class="callout callout-success">
                    <h4>Usuario Registrado satisfactoriamente</h4>
                       Puede consultar las empresa registradas en <a href="" ng-click="cambiarVista('Consultar')"><b>Listar Empresas</b></a> </p>
                  </div>


                          <input  type="submit" class="btn btn-danger" ng-if='!success' value="Registrar empresa de Transporte">
                        </div>

                      </div>
                    </form>   
                  </div><!-- /.tab-panel Registrar Usario -->

















<div ng-switch-when="Registrar Transporte" class="active tab-pane" id="activity"><!-- tab-panel Registrar Usario -->
                  
                  <div class="box-header">
                  <br>
                    <i class="fa fa-edit"></i>
                    <h3 class="box-title">{{public.ngVista}}</h3><hr>
                  </div>
                    
                    <form class="form-horizontal" ng-init="listarET()" ng-submit="RegTransporte(fdata)">

                      <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Empresa de Transporte</label>
                        <div class="col-sm-9">
                          <select class="form-control" ng-model="fdata.T_idempresa_transporte" ng-options="EmpresasT.razonsocial for EmpresasT in ListrarTablaET" required>
                                      <option value="" Disabled>- Empresas de Transporte -</option>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-9">
                         <input type="text" class="form-control" placeholder="Nombre"  ng-model='fdata.T_nombre' required>
                        </div>
                      </div>
                  
                       <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Apellido</label>
                        <div class="col-sm-9">
                         <input type="text" class="form-control" placeholder="Apellido"  ng-model='fdata.T_apellidos' required>
                        </div>
                      </div>                  

                       <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Telefono</label>
                        <div class="col-sm-9">
                         <input type="text" class="form-control" placeholder="Telefono"  ng-model='fdata.T_telefono'>
                        </div>
                      </div>


                       <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Dirección</label>
                        <div class="col-sm-9">
                         <input type="text" class="form-control" placeholder="Dirección"  ng-model='fdata.T_direccion'>
                        </div>
                      </div>

                       <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Marca</label>
                        <div class="col-sm-9">
                         <input type="text" class="form-control" placeholder="Marca"  ng-model='fdata.T_marca'>
                        </div>
                      </div>
                      
                       <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">N° de Placa</label>
                        <div class="col-sm-9">
                         <input type="text" class="form-control" placeholder="N° de Placa"  ng-model='fdata.T_numero_placa'>
                        </div>
                      </div>

                       <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Licencia de Condicir</label>
                        <div class="col-sm-9">
                         <input type="text" class="form-control" placeholder="Licencia de Condicir"  ng-model='fdata.T_licencia_conducir' required>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                  <div ng-if='success' class="callout callout-success">
                    <h4>Transportista Registrado satisfactoriamente</h4>
                       Puede consultar los transportistas registradas en <a href="" ng-click="cambiarVista('Consultar')"><b>Listar Empresas</b></a> </p>
                  </div>
                          <input  type="submit" class="btn btn-danger" ng-if='!success' value="Registrar Transportista">
                        </div>

                      </div>
                    </form>   
                  </div><!-- /.tab-panel Registrar Usario -->




















                  <div ng-switch-when="Consultar" class="nav-tabs-custom" id="timeline" ng-init="listarT();listarET(); ET = 'Empresas de Transporte'; classActive = 'active'">
                 <ul class="nav nav-tabs pull-right">
                  <li ng-class="classActive2"><a href="" ng-click="ET = 'Transportista'; classActive2 = 'active'; classActive = ''">Listar Transportistas</a></li>
                  <li ng-class="classActive"><a href="" ng-click="ET = 'Empresas de Transporte'; classActive = 'active'; classActive2 = ''">{{public.ngVista}}</a></li>
                  <li class="pull-left header"><i class="fa fa-edit"></i><em>{{ET}}.   Lima - Callao</em></li>
                </ul>
<!-- //////////////// listar empresa de Transporte ///////////////-->
                 <table ng-if="ET == 'Empresas de Transporte'" class="table table-bordered">                  
                    <tbody>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th ng-click="sortType = 'razonsocial'; sortReverse = !sortReverse"><a href="">razonsocial</a></th>
                      <th ng-click="sortType = 'RUC'; sortReverse = !sortReverse"><a href="">RUC</a></th>
                      <th>direccion</th>
                      <th>telefono</th>
                      <th>correo</th>
                      <th ng-click="sortType = 'representante'; sortReverse = !sortReverse"><a href="">representante</a></th>
                      <th ng-click="sortType = 'lugar_despacho'; sortReverse = !sortReverse"><a href="">Lugar de Despacho</a></th>
                      <th>Funciones</th>

                    </tr>
                 <!--   <tr> <th colspan="9" class="bg-green color-palette text text-center">Usuarios Activos</th> </tr>-->
                    <tr ng-repeat="users in ListrarTablaET | orderBy:sortType:sortReverse" class='small small'>
                      <td>{{$index+1}}.-</td>
                      <td><b>{{users.razonsocial}}</b></td>
                      <td>{{users.RUC}}</td>
                      <td>{{users.direccion}}</td>
                      <td>{{users.telefono}}</td>
                      <td>{{users.correo}}</td>
                      <td>{{users.representante}}</td>
                      <td>{{users.lugar_despacho}}</td>
                      <td align="center">
                          <a href="" ng-if="users.id_usuario !='1'" ng-click="UpdateUser(users.id_usuario, 'e')" class="glyphicon glyphicon-trash"></a>
                      </td>
                    </tr>
                  </tbody>
                  </table>

<!-- //////////////// listar Transportistas ///////////////-->
                  <table ng-if="ET == 'Transportista'"  class="table table-bordered">                  
                    <tbody>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th ng-click="sortType = 'nombre'; sortReverse = !sortReverse"><a href="">Nombres</a></th>
                      <th ng-click="sortType = 'apellidos'; sortReverse = !sortReverse"><a href="">Apellidos</a></th>
                      <th>Telefono</th>
                      <th>Dirección</th>
                      <th>Marca</th>
                      <th ng-click="sortType = 'representante'; sortReverse = !sortReverse"><a href="">Placa</a></th>
                      <th ng-click="sortType = 'lugar_despacho'; sortReverse = !sortReverse"><a href="">licencia</a></th>
                      <th ng-click="sortType = 'lugar_despacho'; sortReverse = !sortReverse"><a href="">Empresa Transportista</a></th>
                      <th>Funciones</th>

                    </tr>
                 <!--   <tr> <th colspan="9" class="bg-green color-palette text text-center">Usuarios Activos</th> </tr>-->
                    <tr ng-repeat="users in ListrarTablaT | orderBy:sortType:sortReverse" class='small small'>
                      <td>{{$index+1}}.-</td>
                      <td><b>{{users.nombre}}</b></td>
                      <td>{{users.apellidos}}</td>
                      <td>{{users.telefono}}</td>
                      <td>{{users.direccion}}</td>
                      <td>{{users.marca}}</td>
                      <td>{{users.numero_placa}}</td>
                      <td>{{users.licencia_conducir}}</td>
                      <td><em>{{users.razonsocial}}</em></td>
                      <td><a href="" ng-if="usuario.id_usuario =='1' || users.id_usuario !='1'" ng-click="EditarUsuario(users.id_usuario, users); CargarUser(users)" class="glyphicon glyphicon-pencil"></a>
                          <a href="" ng-if="users.id_usuario !='1'" ng-click="UpdateUser(users.id_usuario, 's')" class="glyphicon glyphicon-ban-circle"></a>
                          <a href="" ng-if="users.id_usuario !='1'" ng-click="UpdateUser(users.id_usuario, 'e')" class="glyphicon glyphicon-remove"></a>
                      </td>
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
                       Si realizo cambio en su perfil, Le recomendamos <a href="#/" ng-click="cambiarVista('Consultar')"><b>Refrescar esta pagina</b></a> </p>
                </div>


 
                </div><!-- /.box-body -->
                <div class="box-footer">
                <button class="btn btn-sm btn-primary" ng-click="hideEdit(); clearform()">Regresar</button>
                    Todos los cambios se efectuan de forma inmediata | <span class="glyphicon glyphicon-info-sign"></span> <a href="">Reportar inconveniente</a>
                </div>
              </div>
                  </div><!-- /.tab-panel Listar Usuario -->
                </div><!-- /.End/-registrar Usuario -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col-md-9 -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once('../../../config/footer_inside.html');  ?>

      <!-- Control Sidebar -->
<!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->



