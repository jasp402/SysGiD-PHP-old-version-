    <div class="wrapper">
    <?php include_once('../../../config/topbar.html') ?>
    <?php include_once('../../../config/menubar.html') ?>
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Panel de Control General</small>
          </h1>
          <ol class="breadcrumb">
            <li><a><i class="fa fa-dashboard"></i> SysGiD</a></li>
            <li class="active">Panel de Control</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
<div class="row">
          

<!-- [Widgets CLientes] -->
              <div class="col-md-4 col-sm-6 col-xs-12" ng-init="listarClientes(); WidgetsClientes()">
                <div class="info-box bg-red">
                <a href="#/clientes" style="color:#fff" ng-click="ClicMenu('Clientes','estado');cambiarVista('estado')"> 
                  <span class="info-box-icon"><div class="icon"><i class="fa fa-users"></i></div></span>
                  </a>
                  <div class="info-box-content">                              
                   <a href="#/clientes" style="color:#fff"  data-toggle="tooltip" title="Total clientes registrados" ng-click="ClicMenu('Clientes','estado');cambiarVista('estado')"> 
                      <span class="info-box-text"><b>Modulo Clientes</b></span>
                      <span class="info-box-number">{{ListarClientes.length}} <small class="lead">Clientes Registrados</small></span>
                    </a>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <small data-toggle="tooltip" title="{{getReporte[0]}} - Registros en {{fechaAnterir | date:'MMMM'}}"  data-Placement='bottom'>
                      <span class="small lead">  <i class="fa fa-caret-left"></i>  {{getReporte_clientes[0]}} - {{fechaAnterir | date:"MMMM"}}  </span>
                      </small>
                       <small data-toggle="tooltip" title="{{getReporte[1]}} - Registros mes actual"  data-Placement='bottom'>
                      |  <span class="small lead"><i class="fa fa-caret-down"></i> {{getReporte_clientes[1]}} - {{ fecha | date:"MMMM"}}</span>
                      </small>
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </a>
<!-- [Widgets Productos] -->
              <div class="col-md-4 col-sm-6 col-xs-12" ng-init="WidgetsProducto()">
                <div class="info-box bg-green">
                <a href="#/productos" style="color:#fff"> 
                  <span class="info-box-icon"><div class="icon"><i class="fa fa-cubes"></i></div></span>
                  </a>
                  <div class="info-box-content">                              
                   <a href="#/productos" style="color:#fff"  data-toggle="tooltip" title="Total productos vendidos"> 
                      <span class="info-box-text"><b>Modulo Productos</b></span>
                      <span class="info-box-number">{{getReporte_productosTotal}} <small class="lead">Productos Vendidos</small></span>
                    </a>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <small data-toggle="tooltip" title="{{getReporte_productos[0]}} - Registros en {{fechaAnterir | date:'MMMM'}}"  data-Placement='bottom'>
                      <span class="small lead">  <i class="fa fa-caret-left"></i>  {{getReporte_productos[0]}} - {{fechaAnterir | date:"MMMM"}}  </span>
                      </small>
                       <small data-toggle="tooltip" title="{{getReporte_productos[1]}} - Registros mes actual"  data-Placement='bottom'>
                      |  <span class="small lead"><i class="fa fa-caret-down"></i> {{getReporte_productos[1]}} - {{ fecha | date:"MMMM"}}</span>
                      </small>
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </a>

<!-- [Widgets Transportistas] -->
              <div class="col-md-4 col-sm-6 col-xs-12" ng-init="WidgetsTransporte()">
                <div class="info-box bg-teal">
                <a href="#/transporte" style="color:#fff"> 
                  <span class="info-box-icon"><div class="icon"><i class="fa fa-truck"></i></div></span>
                  </a>
                  <div class="info-box-content">                              
                   <a href="#/transporte" style="color:#fff"  data-toggle="tooltip" title="Total trasportes disponibles"> 
                      <span class="info-box-text"><b>Modulo Transporte</b></span>
                      <span class="info-box-number">{{getReporte_TransporteTotal}} <small class="lead">Trasportistas Disponibles</small></span>
                    </a>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <small data-toggle="tooltip" title="Empresas de transporte Registradas"  data-Placement='bottom'>
                      <span class="small lead">  <i class="fa fa-caret-left"></i>  {{getReporte_transporte}} -  Empresas de transporte </span>
                      </small>
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </a>
<!-- [Widgets Pedidos] -->
              <div class="col-md-4 col-sm-6 col-xs-12" ng-init="WidgetsPedidos(); listarPedidos()">
                <div class="info-box bg-yellow">
                <a href="#/pedidos" style="color:#fff"> 
                  <span class="info-box-icon"><div class="icon"><i class="fa fa-file-text-o"></i></div></span>
                  </a>
                  <div class="info-box-content">                              
                   <a href="#/pedidos" style="color:#fff"  data-toggle="tooltip" title="Total pedidos registrados"> 
                      <span class="info-box-text"><b>Modulo Pedidos</b></span>
                      <span class="info-box-number">{{ListarPedidos.length}} <small class="lead">Pedidos Registrados</small></span>
                    </a>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <span class="progress-description">
                      <small data-toggle="tooltip" title="{{getReporte_productos[0]}} - Registros en {{fechaAnterir | date:'MMMM'}}"  data-Placement='bottom'>
                      <span class="small lead">  <i class="fa fa-caret-left"></i>  {{getReporte_pedidos[0]}} - {{fechaAnterir | date:"MMMM"}}  </span>
                      </small>
                       <small data-toggle="tooltip" title="{{getReporte_productos[1]}} - Registros mes actual"  data-Placement='bottom'>
                      |  <span class="small lead"><i class="fa fa-caret-down"></i> {{getReporte_pedidos[1]}} - {{ fecha | date:"MMMM"}}</span>
                      </small>
                    </span>
                      </small>
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </a>
<!-- [Widgets Facturación] -->
              <div class="col-md-4 col-sm-6 col-xs-12" ng-init="WidgetsFacturacion(); factPagas()">
                <div class="info-box bg-blue">
                <a href="#/facturacion" style="color:#fff"> 
                  <span class="info-box-icon"><div class="icon"><i class="fa fa-money"></i></div></span>
                  </a>
                  <div class="info-box-content">                              
                   <a href="#/facturacion" style="color:#fff"  data-toggle="tooltip" title="Total facturas registradas"> 
                      <span class="info-box-text"><b>Modulo Facturación</b></span>
                      <span class="info-box-number">{{FactPagas.length}} <small class="lead">facturas registradas</small></span>
                    </a>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <span class="progress-description">
                      <small data-toggle="tooltip" title="{{getReporte_productos[0]}} - Registros en {{fechaAnterir | date:'MMMM'}}"  data-Placement='bottom'>
                      <span class="small lead">  <i class="fa fa-caret-left"></i>  {{getReporte_factura[0]}} - {{fechaAnterir | date:"MMMM"}}  </span>
                      </small>
                       <small data-toggle="tooltip" title="{{getReporte_productos[1]}} - Registros mes actual"  data-Placement='bottom'>
                      |  <span class="small lead"><i class="fa fa-caret-down"></i> {{getReporte_factura[1]}} - {{ fecha | date:"MMMM"}}</span>
                      </small>
                    </span>
                      </small>
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </a>
<!-- [Widgets Facturación] -->
              <div class="col-md-4 col-sm-6 col-xs-12" ng-init="WidgetsRemision(); listarRemision()">
                <div class="info-box bg-purple disabled">
                <a href="#/facturacion" style="color:#fff"> 
                  <span class="info-box-icon"><div class="icon"><i class="fa fa-map-signs"></i></div></span>
                  </a>
                  <div class="info-box-content">                              
                   <a href="#/facturacion" style="color:#fff"  data-toggle="tooltip" title="Total Remisiones registradas"> 
                      <span class="info-box-text"><b>Modulo Remisión</b></span>
                      <span class="info-box-number">{{ListarRemision.length}} <small class="lead">Remisiones registradas</small></span>
                    </a>
                    <div class="progress">
                      <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                      <span class="progress-description">
                      <small data-toggle="tooltip" title="{{getReporte_productos[0]}} - Registros en {{fechaAnterir | date:'MMMM'}}"  data-Placement='bottom'>
                      <span class="small lead">  <i class="fa fa-caret-left"></i>  {{getReporte_remision[0]}} - {{fechaAnterir | date:"MMMM"}}  </span>
                      </small>
                       <small data-toggle="tooltip" title="{{getReporte_productos[1]}} - Registros mes actual"  data-Placement='bottom'>
                      |  <span class="small lead"><i class="fa fa-caret-down"></i> {{getReporte_remision[1]}} - {{ fecha | date:"MMMM"}}</span>
                      </small>
                    </span>
                      </small>
                    </span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </div><!-- /.col -->
            </a><!-- Main row -->
            <!-- Left col -->
<div class="col-md-8">
              <div class="box" ng-controller="ngControlChars" ng-init="GraficaGeneral()">
                <div ng-if="!public.loadingChars" class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-area-chart"></i> Estadisticas de Generales</h3>
                  <div class="box-tools pull-right">
                    <div class="btn-group">
                    <button class="btn btn-box-tool" ng-click="public.loadingChars=false; GraficaGeneral()"l><i class="fa fa-refresh"></i></button>
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><i class="fa fa-floppy-o"></i> Estadisticas</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-print"></i> Estadisticas</a></li>
                        <li><a href="#"><i class="fa fa-print"></i> Estado de Cuentas</a></li>
                      </ul>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-5">
                      <p class="text-center">
                        <strong>Cuadro de Estadisticas</strong>
                      </p>
                      <br>
                      <div class="progress-group">
                        <span class="progress-text">Clientes</span>
                        <span class="progress-number"><b>{{ListarClientes.length}}</b>/1.000</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-red progress-bar-striped" style="width: {{(ListarClientes.length/1000)*100}}%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Pedidos</span>
                        <span class="progress-number"><b>{{ListarPedidos.length}}</b>/1.000</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: {{(ListarPedidos.length/1000)*100}}%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Facturas</span>
                        <span class="progress-number"><b>{{FactPagas.length}}</b>/1.000</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: {{(FactPagas.length/1000)*100}}%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Remisiones</span>
                        <span class="progress-number"><b>{{ListarRemision.length}}</b>/10.000</span>
                        <div class="progress sm">
                          <div class="progress-bar progress-bar-purple progress-bar-striped" style="width: {{(ListarRemision.length/1000)*100}}%"></div>
                        </div>
                      </div><!-- /.progress-group -->
                    </div><!-- /.col -->
                    <div class="col-md-7">
                      <p class="text-center">
                        <strong>Operaciones desde: 1 Enero, 2016 - 31 Diciembre, 2016</strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <small class="lead small">Clientes</small>
                        <canvas id="line" class="chart chart-line"  chart-data="data1" chart-labels="labelsMin" chart-legend="false" chart-series="series1" width="703" height="150"></canvas>
                         <small class="lead small">Pedidos | Facturas | Remisiones</small>
                         <canvas id="line" class="chart chart-line"  chart-data="data0" chart-labels="labelsMin" chart-legend="false" chart-series="series0" chart-click="onClick" width="703" height="150"></canvas>
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->

                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> Fact. Pagadas</span>
                        <h5 class="description-header">$35,210.43</h5>
                        <span class="description-text">TOTAL OBTENIDO</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> Diferencia de Abonos</span>
                        <h5 class="description-header">$10,390.90</h5>
                        <span class="description-text">FALTA COBRAR</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-yellow"><i class="fa fa-caret-down"></i> Sin Pagar</span>
                        <h5 class="description-header">$24,813.53</h5>
                        <span class="description-text">FALTA COBRAR</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block">
                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> Sin Pagar <b>Atrasadas</b></span>
                        <h5 class="description-header">$1,200</h5>
                        <span class="description-text">FALTA COBRAR</span>
                      </div><!-- /.description-block -->
                    </div>
                  </div><!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div>

<div class="col-md-4">
<div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                <br>
                  <h3 class="widget-user-username">{{public.DataCompany.razon_social}}</h3>
                  <h5 class="widget-user-desc">{{public.DataCompany.nombre_comercial}}</h5>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">6</h5>
                        <span class="description-text">MODULOS</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">3</h5>
                        <span class="description-text">REPORTES</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">0</h5>
                        <span class="description-text">PLUGINS</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                    <li><a href="">Licencia<span class="pull-right lead small">{{public.DataCompany.pack_version}}</span></a></li>
                    <li><a href="">Serial<span class="pull-right lead small">{{public.DataCompany.serial_key}}</span></a></li>
                    <li><a href="">Renovación<span class="pull-right lead small">{{public.DataCompany.fecha_bloqueo}}</span></a></li>
                    <li><a href="">Usuarios Activos<span class="pull-right lead small">12</span></a></li>
                    <li><a href="">Fallas registradas <span class="pull-right lead small">842</span></a></li>
                  </ul>
                </div>
                </div>
              </div>  

</div>

<div class="col-xs-12">          
<div class="callout callout-success small" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-exclamation-circle"></i> Licencia Activada</h4>
                       Paquete Basico Licencia por {{public.DataCompany.perido_licencia}} años. | Activación: {{public.DataCompany.fecha_activacion}} | Vencimiento {{public.DataCompany.fecha_bloqueo}} <div class="progress progress-xs">
            <a href="">
              <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{(diasfin/365)*100}}%" data-toggle="tooltip" title="Faltan {{diasfin}} dias - Para su renovación"></div>
            </div></a>

          </div>
</div>



           

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
