<div class="wrapper"  ng-init="changeClass();">
    <?php include('../../../config/topbar.html'); ?>
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
                </div>
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
                </div>
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
                </div>
            </div>
            <!--/row-->
            <!-- Main content -->
            <!--
               Reg: Registrar
               ET: Empresa de transporte
                -->
            <div class="row" ng-switch on="public.ngVista">
                <div class="col-md-12 ">
                    <div class="nav-tabs-custom box box-default">
                        <div class="tab-content" >
                            <!-- /.tab-panel Registrar Empresa -->
                            <div ng-switch-when="Registrar Empresa de Transporte" class="active tab-pane" id="activity">
                                <!-- tab-panel Registrar Usario -->
                                <div class="box-header">
                                    <br>
                                    <i class="fa fa-edit"></i>
                                    <h3 class="box-title">{{public.ngVista}}</h3>
                                    <hr>
                                </div>
                                <form class="form-horizontal"  ng-submit="RegEmpresaTransporte(fdata)">
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Razón Social</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Razón Social" ng-model="fdata.razon_social" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">RIF</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control text-uppercase" placeholder="RIF" ng-model='fdata.rif' required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Dirección</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Dirección" ng-model="fdata.direccion">
                                        </div>
                                    </div>
                                    <div class="form-group" ng-init="ListarEstados()">
                                        <label for="inputName" class="col-sm-2 control-label">Estado</label>
                                        <div class="col-sm-9">
                                            <select class="form-control"   ng-model="fdata.estado" ng-options="o.nombre_estado as o.nombre_estado for o in listarEstado">
                                                <option value="" Disabled>- Estado -</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Area y Cargo-->
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Telefono</label>
                                        <div class="col-sm-9">
                                            <input type="tel" class="form-control"  placeholder="Telefono"  ng-model="fdata.telefono">
                                        </div>
                                    </div>
                                    <!-- dni y Email  -->
                                    <div class="form-group hidden">
                                        <label for="inputName" class="col-sm-2 control-label">Correo / Pág. Web</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="null" class="form-control" placeholder="Correo" ng-model="fdata.correo" ng-value="null">
                                        </div>
                                    </div>
                                    <div class="form-group hidden">
                                        <label for="inputName" class="col-sm-2 control-label">Representante</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Representante" ng-model="fdata.representante">
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
                            </div>
                            <!-- /.tab-panel Registrar Chofer y Vehiculo -->
                            <div ng-switch-when="Registrar Transporte" class="active tab-pane" id="activity">
                                <!-- tab-panel Registrar Usario -->
                                <div class="box-header">
                                    <br>
                                    <i class="fa fa-edit"></i>
                                    <h3 class="box-title">Registrar Chofer</h3>
                                    <hr>
                                </div>
                                <form class="form-horizontal" ng-submit="RegChofer(fdata)">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Empresa de Transporte</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <span class="input-group-addon" ng-click="removeSearch()"><a href=""><i ng-class="{'fa fa-angle-down':!successInput,'fa fa-trash':successInput}"></i></a></span>
                                                <input ng-show="!successInput"  placeholder="Buscar..." type="text" class="form-control" ng-model="SearchForm">
                                                <input placeholder="" type="text" class="hidden" ng-model="fdata.id_empresa_transporte" disabled="" required="">
                                                <input ng-show="successInput" placeholder="" type="textbox" class="form-control" ng-model="noItem.SearchForm" value="ssfsh" disabled="" required="">
                                                <!-- ngIf: successInput -->
                                            </div>
                                            <table class="table table-hover small" ng-if="!successInput" style="position: absolute; z-index: 999; width: 96.3%; background-color: #fff;">
                                                <tbody>
                                                <tr ng-if="!((listarET|filter:SearchForm).length)">
                                                    <td colspan="2">No se ha encontrado Resultados... </td>
                                                </tr>
                                                <tr ng-if="SearchForm" ng-repeat="result in listarET | filter:SearchForm | limitTo:3" ng-click="autoComplet(result)">
                                                    <td ng-if="result.razon_social"><a href="">{{result.razon_social}}</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Nombre"  ng-model='fdata.nombre' required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Apellido</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Apellido"  ng-model='fdata.apellido' required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Cedula</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="cedula"  ng-model='fdata.cedula' required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Telefono</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Telefono"  ng-model='fdata.telefono'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-9">
                                            <div ng-if='success' class="callout callout-success">
                                                <h4>Transportista Registrado satisfactoriamente</h4>
                                                Puede consultar los transportistas registradas en <a href="" ng-click="cambiarVista('Consultar')"><b>Listar Empresas</b></a> </p>
                                            </div>
                                            <input  type="submit" class="btn btn-danger" ng-if='!success' value="Registrar Transportista" ng-disabled="!successInput">
                                        </div>
                                    </div>
                                </form>
                                <div class="box-header">
                                    <br>
                                    <i class="fa fa-edit"></i>
                                    <h3 class="box-title">Registrar Vehiculo</h3>
                                    <hr>
                                </div>
                                <form class="form-horizontal" ng-submit="RegVehiculo(fdata)">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Empresa de Transporte</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <span class="input-group-addon" ng-click="removeSearch()"><a href=""><i ng-class="{'fa fa-angle-down':!successInput,'fa fa-trash':successInput}"></i></a></span>
                                                <input ng-show="!successInput"  placeholder="Buscar..." type="text" class="form-control" ng-model="SearchForm2">
                                                <input placeholder="" type="hidden" class="form-control" ng-model="fdata.id_empresa_transporte" value="ssfsh" disabled="" required="">
                                                <input ng-show="successInput" placeholder="" type="textbox" class="form-control" ng-model="noItem.SearchForm" value="ssfsh" disabled="" required="">
                                                <!-- ngIf: successInput -->
                                            </div>
                                            <table class="table table-hover small" ng-if="!successInput" style="position: absolute; z-index: 999; width: 96.3%; background-color: #fff;">
                                                <tbody>
                                                <tr ng-if="!((listarET|filter:SearchForm2).length)">
                                                    <td colspan="2">No se ha encontrado Resultados... </td>
                                                </tr>
                                                <tr ng-if="SearchForm2" ng-repeat="result in listarET | filter:SearchForm2 | limitTo:3" ng-click="autoComplet(result)">
                                                    <td ng-if="result.razon_social"><a href="">{{result.razon_social}}</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /END EMPRESA DE TRANSPORTE-->
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Marca</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Marca"  ng-model='fdata.marca'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Modelo</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="modelo"  ng-model='fdata.modelo'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">N° de Placa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="N° de Placa"  ng-model='fdata.placa'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Color"  ng-model='fdata.color'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-9">
                                            <input  type="submit" class="btn btn-danger" ng-if='!success' value="Registrar Transportista" ng-disabled="!blocked">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-panel Consultar -->
                            <div ng-switch-when="Consultar" class="nav-tabs-custom" ng-init="ET = 'Empresas de Transporte'">
                                <ul class="nav nav-tabs pull-right">
                                    <li class=""  ng-click="ET='Vehiculos'"><a href="" data-toggle="tab" aria-expanded="false">Vehiculo</a></li>
                                    <li class=""  ng-click="ET = 'chofer'"><a href="" data-toggle="tab" aria-expanded="false">Chofer</a></li>
                                    <li class="active" ng-click="ET='Empresas de Transporte'"><a href="" data-toggle="tab" aria-expanded="true">Empresa de Transporte</a></li>
                                    <li class="pull-left header"><i class="fa fa-edit"></i><em>{{ET}}</em></li>
                                </ul>
                                <!-- //////////////// listar empresa de Transporte ///////////////-->
                                <table ng-if="ET == 'Empresas de Transporte'" class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th ng-click="sortType = 'razon_social'; sortReverse = !sortReverse"><a href="">razonsocial</a></th>
                                        <th><a href="">Rif</a></th>
                                        <th>direccion</th>
                                        <th ng-click="sortType = 'Estado'; sortReverse = !sortReverse">Estado</th>
                                        <th>Telefono</th>
                                        <th>Funciones</th>
                                    </tr>
                                    <!--   <tr> <th colspan="9" class="bg-green color-palette text text-center">Usuarios Activos</th> </tr>-->
                                    <tr ng-repeat="empresa in listarET | orderBy:sortType:sortReverse" class='small small'>
                                        <td>{{$index+1}}.-</td>
                                        <td><b>{{empresa.razon_social}}</b></td>
                                        <td>{{empresa.rif}}</td>
                                        <td>{{empresa.direccion}}</td>
                                        <td>{{empresa.estado}}</td>
                                        <td>{{empresa.telefono}}</td>
                                        <td align="center">
                                            <a href="" ng-if="users.id_usuario !='1'" ng-click="UpdateUser(users.id_usuario, 'e')" class="glyphicon glyphicon-trash"></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!-- //////////////// listar Transportistas ///////////////-->
                                <table ng-if="ET == 'chofer'"  class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Cedula</th>
                                        <th>Telefono</th>
                                        <th>Funciones</th>
                                    </tr>
                                    <!--   <tr> <th colspan="9" class="bg-green color-palette text text-center">Usuarios Activos</th> </tr>-->
                                    <tr ng-repeat="chofer in listarT | orderBy:sortType:sortReverse" class='small small'>
                                        <td>{{$index+1}}.-</td>
                                        <td><b>{{chofer.nombre}}</b></td>
                                        <td>{{chofer.apellido}}</td>
                                        <td>{{chofer.cedula}}</td>
                                        <td>{{chofer.telefono}}</td>
                                        <td><a href="" class="glyphicon glyphicon-pencil"></a>
                                            <a href="" class="glyphicon glyphicon-ban-circle"></a>
                                            <a href="" class="glyphicon glyphicon-remove"></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!-- //////////////// listar Vehiculos ///////////////-->
                                <table ng-if="ET == 'Vehiculos'"  class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Modelo</th>
                                        <th>Marca</th>
                                        <th>Placa</th>
                                        <th>Color</th>
                                        <th>Funciones</th>
                                    </tr>
                                    <!--   <tr> <th colspan="9" class="bg-green color-palette text text-center">Usuarios Activos</th> </tr>-->
                                    <tr ng-repeat="vehiculo in listarV | orderBy:sortType:sortReverse" class='small small'>
                                        <td>{{$index+1}}.-</td>
                                        <td><b>{{vehiculo.modelo}}</b></td>
                                        <td>{{vehiculo.marca}}</td>
                                        <td>{{vehiculo.placa}}</td>
                                        <td>{{vehiculo.color}}</td>
                                        <td><a href="" class="glyphicon glyphicon-pencil"></a>
                                            <a href="" class="glyphicon glyphicon-ban-circle"></a>
                                            <a href="" class="glyphicon glyphicon-remove"></a>
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
                                    </div>
                                    <!-- /.box-body -->
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
                                       <file-field class="btn btn-primary btn-block" ng-model="fdata.uploadFile" ng-class="{'btn-success':fdata.uploadFile}" preview="previewImage">Seleccione una Foto</file-field>
                                       <br>
                                    </span>
                                                </div>
                                                <!--UPDATE USER -->
                                                <div class="col-sm-10"><input class="form-control" ng-if='!mensajeActulizar' type="text" placeholder="{{DataUser.mail}}" ng-disabled="DataUser.mail"><br></div>
                                                <div class="col-sm-5"><input class="form-control" ng-if='!mensajeActulizar' type="text" placeholder="{{DataUser.nombres}}" ng-model="fdata.UserNombresUpdate"><br></div>
                                                <div class="col-sm-5"><input class="form-control" ng-if='!mensajeActulizar' type="text" placeholder="{{DataUser.apellidos}}" ng-model="fdata.UserApellidosUpdate"><br></div>
                                                <div class="col-sm-3"><input class="form-control" ng-if='!mensajeActulizar' type="number" placeholder="{{DataUser.cedula}}" ng-model="fdata.UserDniUpdate"><br></div>
                                                <div class="col-sm-3">
                                                    <select class="form-control" ng-if='!mensajeActulizar' ng-model="fdata.UserSexoUpdate">
                                                        <option value="" Disabled>{{DataUser.sexo}}</option>
                                                        <option value="hombre">Hombre</option>
                                                        <option value="mujer">Mujer</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4"><input class="form-control" ng-if='!mensajeActulizar' type="date"   placeholder="{{DataUser.fecha_nacimiento}}" ng-model="fdata.UserFechaNUpdate"><br></div>
                                                <div class="col-sm-5">
                                                    <select class="form-control" ng-if='!mensajeActulizar' ng-options="areas for (areas, cargos) in area_cargos" ng-model="fdata.areaUpdate">
                                                        <option value="" Disabled>- Area -</option>
                                                    </select>
                                                    <br>
                                                </div>
                                                <div class="col-sm-5">
                                                    <select class="form-control" ng-if='!mensajeActulizar' ng-options="cargos for cargos in fdata.areaUpdate" ng-model="fdata.cargoUpdate">
                                                        <option value="" Disabled> {{DataUser.cargo}} </option>
                                                    </select>
                                                    <br>
                                                </div>
                                                <div class="col-sm-5"><input class="form-control" ng-if='!mensajeActulizar' type="text"  placeholder="{{DataUser.direccion}}" ng-model="fdata.UserDirUpdate" ><br></div>
                                                <div class="col-sm-5">
                                                    <select class="form-control" ng-if='!mensajeActulizar' ng-options="o as o for o in provincias" ng-model="fdata.provinciaUdate">
                                                        <option value="" Disabled>{{DataUser.provincia}}</option>
                                                    </select>
                                                    <br>
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
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button class="btn btn-sm btn-primary" ng-click="hideEdit(); clearform()">Regresar</button>
                                    Todos los cambios se efectuan de forma inmediata | <span class="glyphicon glyphicon-info-sign"></span> <a href="">Reportar inconveniente</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-panel Listar Usuario -->
                    </div>
                    <!-- /.End/-registrar Usuario -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col-md-9 -->
        </section>
        <!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php include_once('../../../config/footer_inside.html');  ?>
    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->