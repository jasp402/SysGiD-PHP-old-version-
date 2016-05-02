    <div class="wrapper">
    <?php include_once('../../../config/topbar.html') ?>
    <?php include_once('../../../config/menubar.html') ?>
      
      <!-- Content Wrapper. Contains page content ng-init="cambiarVista('estado')"-->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Clientes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> SysGiD</li>
            <li><a href="#">{{public.ngMenu.titulo}}</a></li>
            <li class="active">{{public.ngVista}}</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
          <!--Grafica Usuarios Nuevos -->
            <div class="col-md-12" ng-controller="ngControlChars" ng-init="cxmes()">
              <div class="box">
                 <div ng-if="!public.loadingChars" class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-area-chart"></i>Clientes Registrados</h3>
                      
                    <div class="box-tools pull-right">
                      <div class="btn-group">
                      <button class="btn btn-box-tool" ng-click="public.loadingChars=false; cxmes()"l><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href=""><i class="fa fa-floppy-o"></i> Estadisticas</a></li>
                            <li class="divider"></li>
                            <li><a href=""><i class="fa fa-print"></i> Estadisticas</a></li>
                            <li><a href=""><i class="fa fa-print"></i> Estado de Cuentas</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  <p class="text-center">
                   <!-- <strong>Ventas: 1 Enero, 2016 - 30 Julio, 2016</strong> -->
                  </p>
          <div class="box-body">
                <div class="chart" >
                    <!-- Sales Chart Canvas -->
                  <canvas 
                  id="line" 
                  class="chart chart-line"  
                  chart-data="data1" 
                  chart-labels="labels" 
                  chart-series="Clientes" style="width: 790px important!; height: 100px;"></canvas>
                </div><!-- /.chart-responsive -->
              </div><!-- /.col -->
            </div>
          </div>

<a href="" ng-click="cambiarVista('estado')">
<div class="col-md-4 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':public.ngVista!='estado','bg-navy':public.ngVista=='estado'}">
                <i class="fa fa-calculator"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Cuenta Clientes</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> consultar estado de cuenta cliente</span>                  
                </div>
              </div><!-- /.info-box -->
            </div>
</a>



<a href="" ng-click="cambiarVista('registro')">
<div class="col-md-4 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':public.ngVista!='registro','bg-navy':public.ngVista=='registro'}">
                <i class="ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Registrar Nuevos Clientes</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> {{data1[0][<?php echo date("m")-1 ?>]}} Clientes este mes<br></span>             
                </div>
              </div><!-- /.info-box -->
            </div>
</a>

<a href="" ng-click="cambiarVista('listar')">
<div class="col-md-4 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':public.ngVista!='listar','bg-navy':public.ngVista=='listar'}">
                <i class="fa fa-file-text-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Listar Clientes</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> {{ListarSaldoClientes.length}}  Clientes registrados <br></span>
                 
                </div>
              </div><!-- /.info-box -->
            </div>
</a>
          </div><!-- /.row -->
          



























          <!-- Main row -->
          <div class="row" ng-switch on="public.ngVista">


          <div class="col-md-12" ng-switch-when="listar">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Lista de Clientes</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped table-hover small" ng-init="listarClientes()">
                  <thead> 
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">DNI/RUC</th>
                      <th class="text-center">Nombre / Razón Social</th>
                      <th class="text-center">Dirección</th>
                      <th class="text-center">Telefonos</th>
                      <th class="text-center">Correo</th>
                      <th class="text-center">Categoria</th>


                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="cliente in ListarClientes">
                      <td class="text-center">{{$index+1}}</td>
                      <td class="text-center">
                      <span ng-if="cliente.DNI>0">{{cliente.DNI}}</span>
                      <span ng-if="cliente.RUC>0"> {{cliente.RUC}}</span></td>
                      <td class="text-center">{{cliente.razonsocial}} {{cliente.nombre}} {{cliente.apellido}} </td>
                      <td class="text-center">{{cliente.direccion_RUC}} {{cliente.direccion}}</td>
                      <td class="text-right">
                       <span ng-if="cliente.telefono>0">{{cliente.telefono}}</span>
                       <span ng-if="cliente.telefono && cliente.telefono2">/</span> 
                       <span ng-if="cliente.telefono2>0">{{cliente.telefono2}}</span>
                      </td>
                      <td  class="text-center">{{cliente.correo}}</td>
                      <td >{{cliente.tipo_cliente}}</td>

                    </tr>
                  </tbody>
                </table>
            </div><!-- /.col -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>






































          <div class="col-md-12" ng-switch-when="registro">
              <div class="nav-tabs-custom box box-default">
                <div class="tab-content">

<div class="active tab-pane" id="activity"><!-- tab-panel Registrar Usario -->
                  <div class="box-header" ng-init="classActive2 = 'active'">
                    <i class="fa fa-edit"></i><h3 class="box-title">Registrar un Nuevo Cliente</h3><p>Seleccione la pestaña correspondiente al tipo de Cliente</p>
                    <ul class="col-sm-12 nav nav-tabs pull-left">
                      <li ng-class="classActive2"><a href="" ng-click="classActive2 = 'active'; classActive = ''">Cliente Natural (DNI)</a></li>
                      <li ng-class="classActive"><a href="" ng-click="classActive = 'active'; classActive2 = ''" class="ng-binding">Cliente Juridico (RUC)</a></li>
                    </ul>
                  </div>
<br>
                    <form ng-show="classActive2" class="form-horizontal"  ng-submit="RegCliente(fdata)">
                        <div class="form-group">
                        <label class="col-sm-2 control-label">DNI</label>
                          <div class="col-sm-9">
                           <input type="number" class="form-control" placeholder="DNI" ng-model='fdata.DNI' required>
                          </div>
                        </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Nombre / Apellido</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" placeholder="Nombre" ng-model="fdata.nombre" required>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="Apellido" ng-model="fdata.apellido" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Correo</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Correo" ng-model="fdata.correo">
                        </div>
                      </div>
                    <!--Area y Cargo-->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Telefono fijo / mobil</label>
                        <div class="col-sm-5">
                          <input type="tel" class="form-control"  placeholder="Telefono Fijo"  ng-model="fdata.telefono">
                        </div>
                        <div class="col-sm-4">
                          <input type="tel" class="form-control"  placeholder="Telefono Mobil"  ng-model="fdata.telefono2">
                        </div>
                      </div>
                    <!-- dni y Email  -->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Dirección</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Dirección" ng-model="fdata.direccion">
                        </div>
                      </div>
                      <div class="form-group">
                       <label class="col-sm-2 control-label">Región</label>
                          <div class="col-sm-3">
                            <select class="form-control" ng-model="fdata.departamento"  ng-options="departamentos.departamento for departamentos in listarDepartamentos" ng-change="Provincias(fdata.departamento)" required>  
                            <option value="" Disabled>- Departamento -</option>
                          </select>
                          </div>
                          <div class="col-sm-3">
                          <select class="form-control" ng-model="fdata.provincia" ng-options="provicias.provincia for provicias in listarProvincias" ng-change="Distritos(fdata.provincia)">
                            <option value="" Disabled>- Provincia -</option>
                          </select>
                          </div>
                        <div class="col-sm-3">
                          <select class="form-control" ng-model="fdata.distrito" ng-options="distritos.distrito for distritos in listarDistritos">
                            <option value="" Disabled>- Distritos -</option>
                          </select>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Datos Bancarios </label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="Banco" ng-model="fdata.banco">
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder="N° de Cuente Bancaria" ng-model="fdata.cuenta_bancaria">
                          </div>

                      </div>
                      <div class="form-group">
                         <label class="col-sm-2 control-label">Contacto </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Persona de contacto" ng-model="fdata.contacto">
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                          <input  type="submit" class="btn btn-danger" ng-if='!success' value="Registrar Cliente">
                        </div>
                      </div>
                    </form>   














                    <form ng-show="classActive" class="form-horizontal" ng-submit="RegCliente(fdata)">
                       <div class="form-group">
                       <label class="col-sm-2 control-label">RUC</label>
                        <div class="col-sm-9">
                         <input type="text" class="form-control" placeholder="RUC" ng-model='fdata.RUC' required>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Razón Social</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Razón Social" ng-model="fdata.razonsocial" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Correo</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Correo" ng-model="fdata.correo">
                        </div>
                      </div>
                    <!--Area y Cargo-->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Telefono fijo / mobil</label>
                        <div class="col-sm-5">
                          <input type="number" class="form-control"  placeholder="Telefono Fijo"  ng-model="fdata.telefono">
                        </div>
                        <div class="col-sm-4">
                          <input type="number" class="form-control"  placeholder="Telefono Mobil"  ng-model="fdata.telefono2">
                        </div>
                      </div>
                    <!--Area y Cargo-->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Dirección</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Dirección" ng-model="fdata.direccion_RUC">
                        </div>
                      </div>
                      <div class="form-group">
                       <label class="col-sm-2 control-label">Región</label>
                          <div class="col-sm-3">
                            <select class="form-control" ng-model="fdata.departamento"  ng-options="departamentos.departamento for departamentos in listarDepartamentos" ng-change="Provincias(fdata.departamento)" required>  
                            <option value="" Disabled>- Departamento -</option>
                          </select>
                          </div>
                          <div class="col-sm-3">
                          <select class="form-control" ng-model="fdata.provincia" ng-options="provicias.provincia for provicias in listarProvincias" ng-change="Distritos(fdata.provincia)">
                            <option value="" Disabled>- Provincia -</option>
                          </select>
                          </div>
                        <div class="col-sm-3">
                          <select class="form-control" ng-model="fdata.distrito" ng-options="distritos.distrito for distritos in listarDistritos">
                            <option value="" Disabled>- Distritos -</option>
                          </select>
                          </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Datos Bancarios </label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="Banco" ng-model="fdata.banco">
                          </div>
                          <div class="col-sm-6">
                            <input type="number" class="form-control" placeholder="N° de Cuente Bancaria" ng-model="fdata.cuenta_bancaria">
                          </div>

                      </div>
                      <div class="form-group">
                         <label class="col-sm-2 control-label">Contacto </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Persona de contacto" ng-model="fdata.contacto">
                          </div>
                      </div>                                 
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                          <input  type="submit" class="btn btn-danger" ng-if='!success' value="Registrar Cliente">
                        </div>

                      </div>
                    </form>    
                  </div><!-- /.tab-panel Registrar Usario -->
    </div>
  </div>
</div>























            <!-- Left col -->
            <section class="col-md-5 connectedSortable" ng-switch-when="estado">            
            <!-- Map box -->
              <div class="box box-default">

                <div class="box-header">

                  <i class="fa fa-users"></i>
                  <h3 class="box-title">
                    Cuenta Clientes
                  </h3>
                </div>
<div class="input-group">
              <input type="text" class="form-control" placeholder="Buscar..." ng-model="buscarCuentaClientes">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>

                <div class="direct-chat-messages" style="height:636px"> 
<div class="box-body no-padding small">
                  <table class="table table-striped table-hover" ng-init="SaldoClientes()">
                    <tbody>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre / Razón Social</th>
                      <th>Pedidos</th>
                      <th>Facturas</th>
                      <th>Saldo</th>
                    </tr>
                    <tr ng-repeat="clientes in ListarSaldoClientes | filter:buscarCuentaClientes" ng-click="CuentaCliente(clientes)">
                      <td>{{$index+1}}.</td>
                      <td ng-if="!clientes.razonsocial"><a href="">{{clientes.nombre}} {{clientes.apellido}}</a></td>
                      <td ng-if="!clientes.nombre"><a href="">{{clientes.razonsocial}}</a></td>
                      <td align="center"><a href="">{{clientes.total_pedidos}}</a></td>
                      <td align="center"><a href="">{{clientes.total_facturas}} </a></td>
                      <td><span ng-class="{'badge bg-red':clientes.saldo_actual<0,'badge bg-green':clientes.saldo_actual>0}">{{clientes.saldo_actual | currency:'/s '}}</span></td>
                    </tr>                      
                  </tbody>
                  </table>
                </div>
                </div><!-- /.box-body-->

              </div>
              <!-- /.box -->





            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section  class="col-lg-7 connectedSortable" ng-switch-when="estado">
              <!-- TO DO List -->
              <div class="box box-default" >
                <div class="box-header">
                  <i class="fa fa-file-text"></i>
                  <h3 class="box-title">Estado de Cuenta del Cliente</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<!--Datos del Cliente-->
<div ng-if="SearchPedidos" class="row invoice-info">
                           <div class="box-header with-border">
                   <h3 ng-if="datosClientes.tipo_cliente == 'Juridico'" class="page-header"><i class="fa fa-user"></i> {{datosClientes.razonsocial}}<small class="pull-right"><?php echo date('j/M/Y') ?></small></h3>
                   <h3 ng-if="datosClientes.tipo_cliente == 'Natural'" class="page-header"><i class="fa fa-user"></i> {{datosClientes.nombre}} {{datosClientes.apellido}}<small class="pull-right"><?php echo date('j/M/Y') ?></small></h3>
                   <span class="pull-right"><h3><b>Saldo Actual: </b><cite class="Source Title" ng-class="{'text-red':datosClientes.saldo_actual<0,'text-green':datosClientes.saldo_actual>0}"> <b>{{datosClientes.saldo_actual | number:2}}</b> /s</cite></h3> </span> 
                    <address>
                    <b ng-if="datosClientes.RUC">RUC:</b>
                    <b ng-if="datosClientes.DNI">DNI:</b>  
                    <span ng-if="datosClientes.RUC"><cite class="Source Title small"> {{datosClientes.RUC}}</cite ></span>
                    <span ng-if="datosClientes.DNI"><cite class="Source Title small"> {{datosClientes.DNI}}</cite ></span><br>
                     <b>Telefono:</b> 
                    <span ng-if="datosClientes.direccion_RUC"><cite class="Source Title small"> {{datosClientes.telefono}}</cite ></span><br>
                    <b>Dirección:</b> 
                    <span ng-if="datosClientes.direccion_RUC"><cite class="Source Title small"> {{datosClientes.direccion_RUC}}</cite ></span>
                    <span ng-if="datosClientes.direccion"><cite class="Source Title small"> {{datosClientes.direccion}}</cite></span><br>
                    <b>Total Pedidos:</b><cite class="Source Title small">  {{datosClientes.total_pedidos}}</cite>
                    </address>
                </div><!-- /.box-header -->
          </div>



<div class="row" ng-if="datosClientes">
            <div class="col-xs-12">
              <h2 class="page-header">
                <span ng-if="CantPedidos.length">Pedidos del Cliente</span>
                <span ng-if="!CantPedidos.length">Sin Pedidos Registrados</span>
              </h2>
            </div><!-- /.col -->
          </div>
<div class="row" ng-if="datosClientes">
            <div class="col-xs-12 table-responsive">
              <table class="table" ng-if="CantPedidos.length">
                  <thead> 
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Nro. Guia</th>
                      <th class="text-center">Cant. Productos</th>
                      <th class="text-center">Importe</th>
                      <th class="text-center">Observación</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="pedidos in CantPedidos">
                      <td class="text-center">{{$index+1}}</td>
                      <td class="text-center">{{pedidos.fecha_pedido | date:'d/MM/yyyy'}}</td>
                      <td class="text-center">{{pedidos.numero_pedido}} </td>
                      <td class="text-center">{{pedidos.cant_productos_pedido}} </td>
                      <td class="text-right">{{pedidos.total_importe | currency:'/s '}} </td>
                      <td ng-if="pedidos.comentario" class="text-center"><a href="" data-toggle="tooltip" data-original-title="Observación: {{pedidos.comentario}}" >(...)</a></td>
                      <td ng-if="!pedidos.comentario" class="text-center">---</td>

                    </tr>
                  </tbody>
                </table>
            </div><!-- /.col -->
          </div>
<div class="row" ng-if="datosClientes">
            <div class="col-xs-12">
              <h2 class="page-header">
                <span ng-if="ListarFactCliente">Facturas del Cliente</span>
                <span ng-if="!ListarFactCliente">Sin Facturas Registradas</span>
              </h2>
            </div><!-- /.col -->
          </div>
<div class="row" ng-if="datosClientes">
            <div class="col-xs-12 table-responsive">
                <table class="table" ng-if="ListarFactCliente">
                  <thead> 
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Nº factura</th>
                      <th class="text-center">importe</th>
                      <th class="text-center">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="factura in ListarFactCliente | orderBy:'factura.id_cliente'">
                      <td class="text-center">{{$index+1}}</td>
                      <td class="text-center">{{factura.fecha_reg_factura}}</td>
                      <td class="text-center">{{factura.nro_factura}}</td>

                      <td class="text-center">{{factura.importe_prod_factura | currency:'/s '}}</td>
                      <td class="text-center">
                      <span ng-class="{'badge bg-yellow':factura.estatus_fact='Pendiente','badge bg-green':factura.estatus_fact='Pagado'}">{{factura.estatus_fact}}</span></td>
                    </tr>
                  </tbody>
                </table>
            </div><!-- /.col -->
          </div>




<div class="row" ng-if="datosClientes">
            <div class="col-xs-12">
              <h2 class="page-header">
                <span ng-if="AbonosCliente">Abonos del Cliente</span>
                <span ng-if="!AbonosCliente">Sin Abonos Registrados</span>
              </h2>
            </div><!-- /.col -->
          </div>
<div class="row" ng-if="datosClientes">
            <div class="col-xs-12 table-responsive">
               <table class="table" ng-if="AbonosCliente">
                  <thead> 
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Banco</th>
                      <th class="text-center">Ref.</th>
                      <th class="text-center">Monto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="Abono in AbonosCliente">
                      <td class="text-center">{{$index+1}}</td>
                      <td class="text-center">{{Abono.fecha_pago}}</td>
                      <td class="text-center">{{Abono.banco_pago}}</td>
                      <td class="text-center">{{Abono.ref_pago}}</td>
                      <td class="text-center">{{Abono.monto_abono | currency:'/s '}}</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
            </div><!-- /.col -->
          </div>

            <div class="col-xs-6">
                              <p class="text-muted well well-sm no-shadow" align="justify" style="margin-top: 10px;"><i class="fa  fa-warning"></i><cite>
                    Los montos y operaciones aqui reflejadas, se basan en el producto de las transacciones hechas dentro del sistema, si existe alguna incongruencia en los datos le invitamos a revisar detallamamente todas las operaciones.
              </cite></p>
            </div>
<div class="col-xs-6">
              <p class="lead">Saldo al 2/22/2014</p>
              <div class="table-responsive">
                <table class="table">
                  <tbody><tr>
                    <th style="width:50%">Total Facturado:</th>
                    <td>{{SaldoFact[0] | currency:'/s'}}</td>
                  </tr>
                  <tr>
                    <th>Total Abonado:</th>
                    <td>{{TotalAbonos[0] | currency:'/s '}}</td>
                  </tr>
                  <tr>
                    <th>Saldo Actual:</th>
                    <td>{{datosClientes.saldo_actual | currency:'/s '}}</td>
                  </tr>
                </tbody></table>
                              <a class="btn btn-app" onclick="alert('Esta funcion está disponible en la versión Premium')">
                <i class="fa fa-envelope"></i> Enviar
              </a>
              <a ng-if="datosClientes" href="http://gunuweb.net/sysgid/pages/print/clientes_pdf.php?formato=PDF&idPedido={{datosClientes.id_cliente}}" target="_blank" class="btn btn-app">
                <i class="fa fa-file-pdf-o"></i> Generar
              </a>

                </div>
</div>



                </div><!-- /.box-body -->
               
              </div><!-- /.box -->








  
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once('../../../config/footer_inside.html');  ?>

      <!-- Control Sidebar -->
<!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->



