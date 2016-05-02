    <div class="wrapper"  ng-init="changeClass()">
    <?php include_once('../../../config/topbar.html'); ?>
    <?php include_once('../../../config/menubar.html'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Facturación & Gestión de pago
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> SysGiD</li>
            <li><a href="#">{{obj.ngMenu.titulo}}</a></li>
            <li class="active">{{subMenuSelect}}</li>
          </ol>
        </section>

<section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
               <div ng-if="!loading" class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-area-chart"></i> Estadisticas de Facturación <small> Registro por mes</small></h3>
                    <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box-tools -->
                    </div>
                  <p class="text-center">
                   <!-- <strong>Ventas: 1 Enero, 2016 - 30 Julio, 2016</strong> -->
                  </p>
          <div class="box-body">
                <div class="chart">
                    <!-- Sales Chart Canvas -->
                  <canvas 
                  id="line" 
                  class="chart chart-line"  
                  chart-data="data3" 
                  chart-labels="labels" 
                  chart-legend="false"
                  chart-series="series" style="width: 790px important!; height: 100px;"></canvas>
                </div><!-- /.chart-responsive -->
              </div><!-- /.col -->
            </div>
          </div>

<a href="" ng-click="cambiarVista('Gestionar Pago')">
<div class="col-md-3 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':obj.ngVista!='Gestionar Pago','bg-navy':obj.ngVista=='Gestionar Pago'}">
                <i class="fa fa-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Gestionar Pagos</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> Registrar Abonos de clientes <br></span>
                
                </div>
              </div><!-- /.info-box -->
            </div>
</a>

<a href="" ng-click="cambiarVista('Crear Factura')">
<div class="col-md-3 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':obj.ngVista!='Crear Factura','bg-navy':obj.ngVista=='Crear Factura'}">
                <i class="fa fa-file-text-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Crear Factura</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i>  Facturas creadas <br></span>
                 
                </div>
              </div><!-- /.info-box -->
            </div>
</a>

<a href="" ng-click="cambiarVista('Gestionar Facturas')">
<div class="col-md-3 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':obj.ngVista!='Gestionar Facturas','bg-navy':obj.ngVista=='Gestionar Facturas'}">
                <i class="ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Gestionar Facturas</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i>  {{ListarFact.length-FactPagas}} Facturas pendientes <br></span>
               
                </div>
              </div><!-- /.info-box -->
            </div>
</a>

<a href="" ng-click="cambiarVista('Listar Facturas')">
<div class="col-md-3 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':obj.ngVista!='Listar Facturas','bg-navy':obj.ngVista=='Listar Facturas'}">
                <i class="ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Listar Facturas</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> {{ListarFact.length}} Facturas <br></span>
                
                </div>
              </div><!-- /.info-box -->
            </div>
</a>
          </div><!-- /.row -->







                <div class="row" ng-switch on="obj.ngVista">
             
             <div class="active tab-pane col-md-12">
                 <div ng-if='obj.temp' class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Operación Realizada con Exito</h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remover"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <p> {{obj.tempMsj}} </p>
                    </div>
                  </div>
              </div><!-- /.obj.temp -->






<div ng-switch-when="Listar Facturas" class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">{{obj.ngVista}} Pendientes</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" ng-model="factura" placeholder="Buscar Factura...">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-hover table-striped">
                  <thead> 
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Nº factura</th>
                      <th class="text-center">Cliente</th>
                      <th class="text-center">importe</th>
                      <th class="text-center">Estado</th>
                      <th class="text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="factura in ListarFact | filter:factura | orderBy:'factura.id_cliente'">
                      <td class="text-center">{{$index+1}}</td>
                      <td class="text-center">{{factura.fecha_reg_factura}}</td>
                      <td class="text-center">{{factura.nro_factura}}</td>
                      <td class="text-center">{{factura.razonsocial}} {{factura.nombre}} {{factura.apellido}}</td>
                      <td class="text-center">{{factura.importe_prod_factura | currency:'/s '}}</td>
                      <td class="text-center"><span ng-class="{'badge bg-green':factura.estatus_fact=='Pagado','badge bg-yellow':factura.estatus_fact=='Pendiente'}">{{factura.estatus_fact}}</span></td>
                      <td class="text-center">
                        <a href="pages/print/factura_txt.php?formato=txt&idPedido={{factura.id_factura}}" target="_blank" data-toggle="tooltip" title="Ver Detalle">
                        <i class="fa fa-search-plus fa-2x"></i></a>&nbsp;&nbsp;
                        <a href="pages/print/factura_pdf.php?formato=PDF&idPedido={{factura.id_factura}}" target="_blank" data-toggle="tooltip" title="Generar PDF">
                        <i class="fa fa-file-pdf-o fa-2x"></i></a>
                      </td>
                    </tr>
                  </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>













<div ng-switch-when="Gestionar Facturas" class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">{{obj.ngVista}} Pendientes</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table">
                  <thead> 
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Nº factura</th>
                      <th class="text-center">Cliente</th>
                      <th class="text-center">importe</th>
                      <th class="text-center">Estado</th>
                      <th class="text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="factura in ListarFact | orderBy:'factura.id_cliente'" ng-if="factura.estatus_fact !='Pagado'">
                      <td class="text-center">{{$index+1}}</td>
                      <td class="text-center">{{factura.fecha_reg_factura}}</td>
                      <td class="text-center">{{factura.nro_factura}}</td>
                      <td class="text-center">{{factura.razonsocial}} {{factura.nombre}} {{factura.apellido}}</td>
                      <td class="text-center">{{factura.importe_prod_factura | currency:'/s '}}</td>
                      <td class="text-center"><span class="badge bg-yellow">{{factura.estatus_fact}}</span></td>
                      <td class="text-center">
                        <button class="btn btn-block btn-success btn-flat  btn-xs" ng-click="pagarFact(factura)">Pagar</button>
                      </td>
                    </tr>
                  </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>






<div ng-switch-when="Crear Factura" class="active tab-pane col-md-12">
          
          <a href="" ng-show="hide" ng-click="hide = !hide">
          <div class="callout callout-info">
            <h4>Tip!</h4>
            <p><i>Para generar factura se debe registrar previamente un <b>Pedio</b>. Posteriormente podra crear las factura en base a los productos previamente seleccionados en ese pedido.</i></p>
          </div>
          </a>
              <div  class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-edit"></i> {{obj.ngVista}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
<div class="active tab-pane" id="activity">
<!-- Remision -->                  
<form ng-submit="registrarGuia(fdata)">
 
           <div class="box box-solid">
              <div class="box-body">
                <div class="box-body">
                <!--Linea 1 -->
                    <div class="col-md-12">
                      <div class="form-group col-md-3">
                        <b>Fecha de registro:</b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="text" class="form-control" value="<?php echo date('j/m/Y') ?>" required disabled>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <b>N° de Guia del pedido:</b>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-file-text-o"></i></span>
                            <input ng-show="!successInput" data-toggle="tooltip" data-original-title="Utilice este campo para buscar y seleccione un cliente"  placeholder="Buscar Nro de guia..." type="textbox" class="form-control" ng-model="BuscarClientes">
                            <input ng-show="successInput"   placeholder="{{nroGuia}}" type="textbox" class="form-control" ng-model="nroGuia" disabled required>
                            <span ng-if="successInput" data-toggle="tooltip" data-original-title="Cambiar Cliente" ng-click="cambiarCliente()" class="input-group-addon"><a href=""><i class="fa fa-exchange"></i></a></span>
                          </div>
                      </div>
                    <div class="form-group col-md-3">
                        <b>N° de la Factura: </b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa  fa-file-text-o"></i></span>
                          <input type="text" class="form-control"  placeholder="nro de Factura..." ng-model="fdata.nro_factura" required>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <b>Estado de la Factura:</b>
                          <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                          <select class='form-control' ng-model="fdata.estado" ng-options="estatus.estado for estatus in ListarEstatusFact" required>
                          <option value=''  Disabled>Seleccione el estado...</option>
                          </select>
                          </div>
                      </div>     

                    </div>
                  <!-- Linea 2   
                    <div class="col-md-12">
                      <div class="form-group col-md-4">
                        <b>Fecha de vencimiento:</b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="date" class="form-control" ng-model="fdata.fecha_venc_factura" required>
                        </div>
                      </div>                                
                    </div>-->

                    <div class="col-md-12">
                    <div ng-if="fdata.estado.estado == 'Pagado'" class="box-footer box-comments">
                    <div class="box-comment"> 
                    <div class="comment-text">
                      <span class="username">
                       <i class="fa fa-info-circle"></i> Notificación
                        <span class="text-muted pull-right"></span>
                      </span><!-- /.username -->
                      El monto de esta factura se acreditara a la cuenta del cliente,
                      Aun cuando el saldo actual sea inferior al monto de la factura.
                    </div><!-- /.comment-text -->
                  </div>
                  </div>
                  </div>
                  <div class="col-md-12">
                      <div class="form-group col-md-12">
                      <table class="table table-hover small" ng-if="!successInput">
                        <tbody>
                          <tr ng-if="fdata.estado.estado == 'Pagado'" ><td>&nbsp;&nbsp;</td>
                          </tr>
                          <tr>
                            <th>N° de Guia</th>
                            <th>Fecha</th>
                            <th>Razón Social /Nombre</th>
                            <th>Pedidos</th>
                            <th>Total productos Pedido</th>
                          </tr>
                          <tr ng-if="!BuscarClientes">
                            <td colspan="5">Utiliza el campo de busqueda...</td>
                          </tr>
                          <tr ng-if="!((listarClientes|filter:BuscarClientes).length)">
                            <td colspan="2">No se ha encontrado Resultados... </td>
                          </tr>
                          <tr ng-if="BuscarClientes" ng-click="cargarFactura(cliente); PedidosxCliente(cliente.id_cliente)" ng-repeat="cliente in consularPedido | filter:BuscarClientes | limitTo:3">
                            <td><a href="">{{cliente.numero_pedido}}</a></td>
                            <!--Grupo [Dir. RUC / Direccion]-->
                            <td><a href="">{{cliente.fecha_pedido}}</a></td>
                            <!--Grupo [Razon Social / nombre Apellido]-->
                            <td ng-if="cliente.tipo_cliente == 'Juridico'"><a href="">{{cliente.razonsocial}}</a></td>
                            <td ng-if="cliente.tipo_cliente == 'Natural'"><a href="">{{cliente.nombre}}</a></td>
                            <!--Calcular Cant. Pedidos --> 
                            <td><a href="">{{cliente.total_pedidos}}</a></td> 
                            <!--Grupo [Saldo]-->
                            <td><a href="">{{cliente.cant_productos_pedido}}<a href=""></td>

                          </tr>
                        </tbody>
                      </table> 
                      </div>
                  </div>

                <div ng-if="datosClientes">
                   <h3 ng-if="datosClientes.tipo_cliente == 'Juridico'" class="page-header"><i class="fa fa-user"></i> {{datosClientes.razonsocial}}<small class="pull-right"><?php echo date('j/M/Y') ?></small></h3>
                   <h3 ng-if="datosClientes.tipo_cliente == 'Natural'" class="page-header"><i class="fa fa-user"></i> {{datosClientes.nombre}} {{datosClientes.apellido}}
                   <small class="pull-right"><?php echo date('j/M/Y') ?></small></h3>

                   <span class="pull-right">
                   <h3>
                   <b>Saldo Actual: </b>
                   <cite class="Source Title" ng-class="{'text-red':datosClientes.saldo_actual<0,'text-green':datosClientes.saldo_actual>0}"> <b>{{datosClientes.saldo_actual | number:2}}</b> /s</cite></h3>  
                </div> </span>
                    <address>
                    <b ng-if="datosClientes.RUC">RUC:</b>
                    <b ng-if="datosClientes.DNI">DNI:</b>  
                    <span ng-if="datosClientes.tipo_cliente == 'Juridico'"><cite class="Source Title small"> {{datosClientes.RUC}}</cite ></span>
                    <span ng-if="datosClientes.tipo_cliente == 'Natural'"><cite class="Source Title small"> {{datosClientes.DNI}}</cite ></span><br>
                     <b>Telefono:</b> 
                    <span ng-if="datosClientes.direccion_RUC"><cite class="Source Title small"> {{datosClientes.telefono}}</cite ></span><br>
                    <b>Dirección:</b> 
                    <span ng-if="datosClientes.direccion_RUC"><cite class="Source Title small"> {{datosClientes.direccion_RUC}}</cite ></span>
                    <span ng-if="datosClientes.direccion"><cite class="Source Title small"> {{datosClientes.direccion}}</cite></span><br>
                    <b>Total Pedidos:</b><cite class="Source Title small">  {{datosClientes.total_pedidos}}</cite>
                    </address>
                </div>

                  <div class="col-md-12">
                      <div class="box-header">
                      <i class="fa fa-list-ul"></i>
                      <h3 class="box-title">Productos</h3>
                      <p>Lista de productos a Factura, Seleccione los Productos que desea incluir en la factura.</p><hr>
                      </div> 
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead> 
                            <tr>
                              <th class="text-center">#</th>
                              <th class="text-center">Descripción del Productos</th>
                              
                              <th class="text-center">Precio</th>
                              <th class="text-center">Cant. Productos</th>
                              <th class="text-center">Total Importe</th>
                              <!-- <th class="text-center">Ajuste</th> -->
                              <th class="text-center">Nro. Remisión</th>
                              <th class="text-center">Nro. Factura</th>


                            </tr>
                          </thead>
                          <tbody class="detalle small small">
                            <tr ng-repeat="product in ListarProdcFact" ng-class="{'bg bg-red':product.nro_factura, 'bg bg-yellow':product.nro_remision, 'bg-gray':select}"  class="text-center">
                              <td> {{$index+1}}</td>
                              <td class="text-center">{{product[1]}}  CAT. {{product[4]}} - {{product.nombre_producto}} {{product.medida}} Mtr</td>
                              <td class="text-center">
                              <input type="text" class="form-control input-sm" placeholder="0,00./S"  ng-model="fdata.precioProducto[$index]" ng-if="!product.nro_factura" data-toggle="tooltip" ng-disabled="fdata.producto[$index]">
                              </td>

                           
                              <td class="text-center">{{product.cant_prod_detalle}}</td>                       
                         
                              
                              <td class="text-center">               
                              {{fdata.precioProducto[$index]*product.cant_prod_detalle | currency:'/s'}}
                              </td>
                              <td ng-if="!product.nro_remision">---</td>
                              <td ng-if="product.nro_remision"><b  data-toggle="tooltip" data-original-title="Consultar la Remisión Nro. {{product.nro_remision}} ">Despachado</b></td>

                              <td ng-if="!product.nro_factura">
                              <input type="checkbox" name="product" ng-model="fdata.producto[$index]" ng-click="restarFact(fdata.producto[$index],product.importe_prod_detalle);select =!select; sumarFactura(fdata.producto[$index],fdata.precioProducto[$index],product.cant_prod_detalle)" ng-disabled="product.nro_factura || !fdata.precioProducto[$index]"></td>
                              <td ng-if="product.nro_factura"><b  data-toggle="tooltip" data-original-title="Consultar Fact. Nro. {{product.nro_factura}} ">Facturado</b></td>
                              
                              <td></td>
                            </tr>             
                          </tbody>
                        </table>
                        <div class="col-sm-8"></div>
                        <div class="col-sm-4">
                        <table class="table"> 
                  <tbody>
                <!--  <tr>
                    <th>Facturado:</th>
                    <td>{{sumarfact | currency:'/s'}}</td>
                  </tr> -->
                  <tr>
                    <th>Sub Total:</th>
                    <td>{{(sumarDescuento)-((sumarDescuento)*18/100) | currency:'/s '}}  </td>
                  </tr>
                  <tr>
                    <th>IVG (18%):</th>
                    <td>{{(sumarDescuento)*18/100 | currency:'/s '}}</td>
                  </tr>
                   <tr>
                    <th>Total a Pagar:</th>
                    <td>{{sumarDescuento  | currency:'/s'}}</td>
                  </tr>
                </tbody></table></div>
                      </div>
                  </div>

                    <div class="col-md-12">
                    </div>
                    <div class="box-footer text-center col-md-12">
                        <input class="btn btn-success" type="submit" value="Guardar">
                    </div>

                </div>
              </div>
            </div> 
</form>
        </div><!-- /.tab-panel Registrar Usario -->
                </div><!-- /.box-body -->
              </div>



                     <div  class="active tab-pane col-md-12" ng-switch-when="Gestionar Pago">

              <!--Cuadro de Busqueda-->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <i class="fa fa-search"></i>
                  <h3 class="box-title">Buscar Cliente</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" style="display: block;">
                  <form class="form"> 
                    <div class="input-group">
                    <input ng-show="!successInput"   placeholder="Buscar Cliente..." type="textbox" class="form-control" ng-model="BuscarClientes">
                    <input ng-show="successInput"   placeholder="{{Cliente}}" type="textbox" class="form-control" ng-model="Cliente" disabled required>
                      <span ng-if="successInput" data-toggle="tooltip" data-original-title="Cambiar Cliente" ng-click="cambiarCliente()" class="input-group-addon"><a href=""><i class="fa fa-exchange"></i></a></span>
                      <span ng-if="!successInput" class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>   
                      <table class="table table-hover small" ng-if="!successInput">
                        <tbody>
                          <tr>
                            <th>DNI / RUC</th>
                            <th>Razón Social /Nombre</th>
                            <th>Dirección</th>
                            <th>Pedidos</th>
                            <th>Saldo</th>
                          </tr>
                          <tr ng-if="!BuscarClientes">
                            <td colspan="2">Utiliza el campo de busqueda...</td>
                          </tr>
                          <tr ng-if="!((listarClientes|filter:BuscarClientes).length)">
                            <td colspan="2">No se ha encontrado Resultados... </td>
                          </tr>
                          <tr ng-if="BuscarClientes" ng-click="cargarClienteFact(cliente)" ng-repeat="cliente in listarClientes | filter:BuscarClientes | limitTo:3">
                            <!--Grupo [RUC / DNI]-->
                            <td ng-if="cliente.tipo_cliente == 'Juridico'"><a href="">{{cliente.RUC}}</a></td>
                            <td ng-if="cliente.tipo_cliente == 'Natural'"><a href="">{{cliente.DNI}}</a></td>
                            <!--Grupo [Razon Social / nombre Apellido]-->
                            <td ng-if="cliente.tipo_cliente == 'Juridico'"><a href="">{{cliente.razonsocial}}</a></td>
                            <td ng-if="cliente.tipo_cliente == 'Natural'"><a href="">{{cliente.nombre}}</a></td>
                            <!--Grupo [Dir. RUC / Direccion]-->
                            <td ng-if="cliente.tipo_cliente == 'Natural'"><a href="">{{cliente.direccion_RUC}}</a></td>
                            <td ng-if="cliente.tipo_cliente == 'Natural'"><a href="">{{cliente.direccion}}</a></td>
                            <!--Calcular Cant. Pedidos --> 
                            <td><a href="">{{cliente.total_pedidos}}</a></td> 
                            <!--Grupo [Saldo]-->
                            <td ng-if="cliente.saldo_actual">{{cliente.saldo_actual | currency:'/s '}}</td>
                            <td ng-if="!cliente.saldo_actual">No Disponible</td>
                          </tr>
                        </tbody>
                      </table>   


                </div><!-- /.box-body -->
              </div>

              <div ng-if="SearchPedidos" class="box box-default"> <!--Consulta Por Busqueda de Cliente-->
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
                  <div class="box-body">
                    <div class="box-header with-border">
                      <h3 class="box-title"><i class="fa fa-credit-card"></i> Gestionar Pago</h3>
                    </div><!-- /.box-header -->

                    <div class="box-group">
                      <form ng-submit="regPago(fdata)">
                        <!--formulario para registrar el pago -->
                        <div class="col-md-6">
                          <div class="form-group col-md-12">
                            <b>Fecha de la transacción: </b>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              <input type="date" class="form-control" ng-model="fdata.fechaPago" required>
                            </div>
                          </div>
                          <div class="form-group col-md-12">
                            <b>Tipo de Pago: </b>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                              <select class='form-control' ng-model="fdata.metodo" required>
                              <option value=''  Disabled>Seleccione el estado...</option>
                              <option ng-value='Efectivo'>Efectivo</option>
                              <option value='Deposito'>Deposito</option>
                              <option value='Cheque'>Cheque</option>
                              </select>
                            </div>
                          </div>
                          <div ng-show="fdata.metodo" ng-if="fdata.metodo!='Efectivo'" class="form-group col-md-6">
                            <b>Banco:</b>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                              <input type="text" class="form-control" placeholder="Banco..." ng-model="fdata.banco" ng-required="fdata.metodo=='Deposito' || fdata.metodo=='Cheque'">
                            </div>
                          </div>
                          <div ng-show="fdata.metodo" ng-if="fdata.metodo!='Efectivo'" class="form-group col-md-6">
                            <b>Numero de Comprobante:</b>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                              <input type="text" class="form-control" placeholder="Nro Comprobante..." ng-model="fdata.ref" ng-required="fdata.metodo=='Deposito' || fdata.metodo=='Cheque'">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group col-md-12">
                            <b>Monto: </b>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                <input class="form-control input-lg" type="number" placeholder="/S. " style="font-size:42px; height:100px" ng-model="fdata.monto" required>                        
                            </div>
                          </div>
                        </div>
                        <div ng-show="fdata.metodo" class="col-md-6">
                          <div class="form-group col-md-12">
                            <b>Concepto de pago: (Opcional) </b>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa  fa-edit"></i></span>
                                <input type="text" class="form-control" placeholder="Observaciones..." ng-model="fdata.concepto">                        
                            </div>
                          </div>
                        </div>

                        <div class="box-footer text-center col-md-12">
                            <input class="btn btn-warning btn-flat" type="button" onclick="location='#/facturacion'"  value="Borrar Todo">
                            <input class="btn btn-success btn-flat" type="submit" name="submit"  value="Guardar Registro">
                        </div>
                        </form> 
                    </div><!-- /.box-body -->
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

