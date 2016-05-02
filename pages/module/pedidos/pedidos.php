    <div class="wrapper">
    <?php include_once('../../../config/topbar.html'); ?>
    <?php include_once('../../../config/menubar.html'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Gestionar Pedidos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> SysGiD</li>
            <li><a href="#">{{public.ngMenu.titulo}}</a></li>
            <li class="active">{{public.ngVista}}</li>
          </ol>
        </section>

<section class="content">
          <div class="row">

 <div class="col-md-12" ng-controller="ngControlChars" ng-init="pxmes()">
              <div class="box">
                <div ng-if="!public.loadingChars" class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div>
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-area-chart"></i> Pedidos <small> Registro por mes</small></h3>
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
                  chart-data="data2" 
                  chart-labels="labels" 
                  chart-series="data3" style="width: 790px important!; height: 100px;"></canvas>
                </div><!-- /.chart-responsive -->
              </div><!-- /.col -->
            </div>
          </div>

<a href="" ng-click="cambiarVista('Registrar Pedido')">
<div class="col-md-6 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon bg-navy" ng-class="{'bg-light-blue-active':public.ngVista!='Registrar Pedido','bg-navy':public.ngVista=='Registrar Pedido'}">
                <i class="fa  fa-file-text"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Registrar Pedido</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> {{ListarPedidos.length}} Pedidos | Para el <?php echo date('j-m-Y') ?> <br></span>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> /s {{Acumulado | number:2}} Importe acumulado</span>                  
                </div>
              </div><!-- /.info-box -->
            </div>
</a>

<a href="" ng-click="cambiarVista('Consultar Pedidos')">
<div class="col-md-6 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon bg-navy" ng-class="{'bg-light-blue-active':public.ngVista!='Consultar Pedidos','bg-navy':public.ngVista=='Consultar Pedidos'}">
                <i class="fa fa-folder-open-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Consultar Pedidos</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> Buscar por Nro de Pedido <br></span>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> Buscar por Clientes</span>                  
                </div>
              </div><!-- /.info-box -->
            </div>

</a>
        </div><!-- /.row -->

<div ng-switch on="public.ngVista">
          <div ng-switch-when="Registrar Pedido">
            <form ng-submit="registrarPedido(fdata)" ng-init="listarProductos()">
              <div class="box box-default">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-edit"></i> {{vista}}</h3>
                  <p>Guias de <strong>Pedidos</strong> podra seleccionar los productos que desee asignarle a un cliente y posteriormente facturar segun el numero de guias, por favor utilice con responsabilidad las opciones.</p>
                </div>
                <div class="box-body">
                        <!-- /.obj.temp -->
                  <div ng-if='obj.temp' class="box box-success box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Pedido <b>#{{ListarPedidos[0].numero_pedido}}</b> Registrado satisfactoriamente</h3>
                      <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remover"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      Puede consultar las empresa registradas en <a href="" ng-click="ActClass('Listar Usuario')"><b>Consultar Pedidos</b></a> </p>
                    </div>
                  </div><!-- /.obj.temp -->

                  <div class="col-md-8">
                    <div class="form-group col-md-12">
                          <b>Cliente: </b>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                            <input ng-show="!successInput" data-toggle="tooltip" data-original-title="Utilice este campo para buscar y seleccione un cliente"  placeholder="Buscar Cliente..." type="textbox" class="form-control" ng-model="BuscarClientes">
                            <input ng-show="successInput"   placeholder="{{Cliente}}" type="textbox" class="form-control" ng-model="Cliente" disabled required>
                            <span ng-if="successInput" ng-click="cambiarCliente()" class="input-group-addon"><a href=""><i class="fa fa-exchange"></i></a></span>
                          </div>
                      <table class="table table-hover small" ng-if="!successInput">
                        <tbody>
                          <tr>
                            <th>DNI / RUC</th>
                            <th>Razón Social /Nombre</th>
                          </tr>
                          <tr ng-if="!BuscarClientes">
                            <td colspan="2">Utiliza el campo de busqueda...</td>
                          </tr>
                          <tr ng-if="!((listarClientes|filter:BuscarClientes).length)">
                            <td colspan="2">No se ha encontrado Resultados... </td>
                          </tr>
                          <tr ng-if="BuscarClientes" ng-repeat="cliente in listarClientes | filter:BuscarClientes | limitTo:3" ng-click="cargarCliente(cliente);PedidosxCliente(cliente.id_cliente)">
                            <td ng-if="cliente.RUC && !cliente.DNI"><a href="">{{cliente.RUC}}</a></td>
                            <td ng-if="cliente.DNI && !cliente.RUC"><a href="">{{cliente.DNI}}</a></td>
                            <td ng-if="cliente.razonsocial && !cliente.nombre">{{cliente.razonsocial}}</td>
                            <td ng-if="cliente.nombre && !cliente.razonsocial">{{cliente.nombre}}</td>
                          </tr>
                        </tbody>
                      </table>                                     
                    </div>
                  </div>
<div class="col-md-2">
   <div class="form-group"><b>Tipo de Venta:</b>
    <div class="input-group">
     <select class="form-control" ng-model='fdata.ventaPedido' required>
          <option value="" Disabled>- Tipo de Producto -</option>
         <option value="Credito">Credito</option>
         <option value="Contado">Contado</option>
     </select>
     </div>
   </div>
</div>
                  <div class="col-md-2">
                      <div class="pull-right">
                        <b>Numero de Guia:</b>
                     <!--   <div> -->
                          <!--<span class="input-group-addon"><i class="fa fa-file"></i></span>-->
                         <h3>2016-{{ListarPedidos[0].numero_pedido+1}} </h3>
                        <!-- <input type="textbox" class="form-control" placeholder="{{ListarPedidos[0].numero_pedido}}" ng-model="fdata.numero_pedido" ng-change="codigoRepetido(fdata.numero_pedido,ListarPedidos)" required>
                        </div>-->
                      </div>
                  </div>

                  <div ng-if="Cliente" class="col-xs-12 small">
                   <h2 ng-if="datosClientes.tipo_cliente == 'Juridico'" class="page-header"><i class="fa fa-user"></i> {{datosClientes.razonsocial}}<small class="pull-right"><?php echo date('j/M/Y') ?></small></h2>
                   <h2 ng-if="datosClientes.tipo_cliente == 'Natural'" class="page-header"><i class="fa fa-user"></i> {{datosClientes.nombre}} {{datosClientes.apellido}}<small class="pull-right"><?php echo date('j/M/Y') ?></small></h2>
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
                    <b>Total Pedidos:</b><cite class="Source Title small">  {{CantPedidos.length}}</cite>
                    </address>
                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <div ng-if="Cliente" class="box box-default">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-cubes"></i> Seleccionar Productos </h3>
                  <p>Utilice el boton <i class="fa fa-plus-square"></i> Para agregar cuantos productos requiera, Recuerde utilizar esta opción con responsabilidad.</p>
                </div>
                <div class="box-body">
                      <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table">
                          <thead> 
                            <tr>
                              <th class="text-center">#</th>
                              <th width="20%" class="text-center">Tipo de Producto</th>
                              <th width="15%" class="text-center">Categoria</th>
                              <th class="text-center">Nombre del Producto</th>
                              <th class="text-center">Color</th>
                              <th class="text-center">Cant. Disponible</th>
                              <th class="text-center">Precio</th>
                              <th width="1%" class="text-center">Cantidad</th>
                              <th class="text-center">Total precio</th>
                              <th></th>
                              <th><button type="button" class="btn btn-primary" ng-click="add()">+</button></th>

                            </tr>
                          </thead>
                          <tbody class="detalle small small">

                            <tr ng-repeat="input in inputs track by input['id']">
                              <td class="no">{{$index+1}}</td>
<td>
<!--Listar la categoria de productos -->
<select class="form-control" name="tipo[]" ng-model="fdata.Tipo[$index]" ng-options="tipo.nombre for tipo in ListrarTipoProd">
  <option value="" Disabled>- Tipo de Producto -</option>
</select>
</td>

<td>
<!--Listar la categoria de productos -->
<select  class="form-control" name="categoria[]" ng-model="fdata.categoria[$index]" ng-options="categoria.nombre for categoria in ListrarCategoria" ng-change="BuscarPRO(fdata.Tipo[$index], fdata.categoria[$index], $index)">
  <option value="" Disabled>- Categoria -</option>
</select>
</td>

<td width="30%">
<!--Listar la categoria de productos -->
<select class="form-control" name="producto[]" ng-model="fdata.productos[$index]" ng-options="productos.nombre_producto +' '+productos.medida+'Mts'  for productos in ListarProductosID[{{$index}}]" ng-change="sumar(fdata)" required>
  <option value="" Disabled>- Productos -</option>
</select>

</td>
<td width="30%"  align="center"><input name="color[]"  type="text" class="form-control" ng-model="fdata.color[$index]"></td>
                              <td align="center"><h5>{{fdata.productos[$index].disponible - input.cant[$index]}}</h5></td>
                              <td width="10%" valign="center"> 
<input type="hidden" ng-model="inputs[$index].price" ng-value="fdata.productos[$index].precio">
                              <h5>{{fdata.productos[$index].precio | currency:'/s '}}</h5></td>
                              <td width="2%"><input type="number" class="form-control" name="quantity[]" ng-model="input.cant[$index]" min="1" max="{{fdata.productos[$index].disponible}}" ng-change="sumar(fdata);inventario(fdata.productos[$index].disponible,input.cant[$index])" ng-disabled="!fdata.productos[$index].disponible" required></td>

                              <td width="10%"><spam style="color:green" ng-if="input.cant[$index]"><h5>{{(input.cant[$index]*fdata.productos[$index].precio) | currency:'/s '}}</h5></spam></td>
                              <td><a ng-if="$index != 0 " class="quitarPro" data-toggle="tooltip" 
                                  data-placement="right" title="" data-original-title="Eliminar" ng-click="removeItem(fdata)">
                                  <i class="fa fa-trash-o fa-2x"></i></a></td>
                                  
                            </tr>
                          
                          </tbody>
                          <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-right"><strong>TOTAL:</strong></th>
                            <th ng-if="suma">{{suma  | currency:'/s '}}</th>
                            <th ng-if="!suma">/s 0.00</th>
                            <th></th>
                            <th><button type="button" class="btn btn-primary" ng-click="add()">+</button></th>
                          </tfoot>
                        </table>
                      </div>
                      </div>
                      <div class="col-md-12">
                      <b>Observaciones (Este campo no será impreso)</b>
                      <textarea name="comentario" class="form-control" rows="3" ng-model="fdata.comentario" cols="4" rows="2" style="height:50px"></textarea>
                    </div>

                    <div class="box-footer text-center col-md-12">
                        <input class="btn btn-warning btn-flat" type="button" onclick="location='#/pedidos'"  value="Borrar Todo">
                        <input class="btn btn-success btn-flat" type="submit" name="submit"  value="Guardar Registro">
                    </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </form>
            </div>










          <div ng-switch-when="Consultar Pedidos" class="active tab-pane">
              
              <!--Cuadro de Busqueda-->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <i class="fa fa-search"></i>
                  <h3 class="box-title">Buscar Guias de Pedido</h3>
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
                            <td colspan="5">Utiliza el campo de busqueda...</td>
                          </tr>
                          <tr ng-if="!((listarClientes|filter:BuscarClientes).length)">
                            <td colspan="2">No se ha encontrado Resultados... </td>
                          </tr>
                          <tr ng-if="BuscarClientes" ng-click="cargarClientePedido(cliente);PedidosxCliente(cliente.id_cliente)" ng-repeat="cliente in listarClientes | filter:BuscarClientes | limitTo:3">
                            <!--Grupo [RUC / DNI]-->
                            <td ng-if="cliente.RUC"><a href="">{{cliente.RUC}}</a></td>
                            <td ng-if="cliente.DNI"><a href="">{{cliente.DNI}}</a></td>
                            <!--Grupo [Razon Social / nombre Apellido]-->
                            <td ng-if="cliente.tipo_cliente == 'Juridico'"><a href="">{{cliente.razonsocial}}</a></td>
                            <td ng-if="cliente.tipo_cliente == 'Natural'"><a href="">{{cliente.nombre}}</a></td>
                            <!--Grupo [Dir. RUC / Direccion]-->
                            <td><a href="">{{cliente.direccion_RUC}}</a></td>
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
                  <h3 class="box-title">Detalles de Pedidos</h3>
                </div><!-- /.box-header -->

                  <div class="box-group" ng-repeat="pedidos in CantPedidos" ng-init="detallePedido()">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div id="{{$index}}" class="box box-primary collapsed-box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Pedido #2016-{{pedidos.numero_pedido}} |<small>{{pedidos.fecha_pedido | date:'longDate'}}</small>
                        <span ng-class="{'label label-success':pedidos.estatus_pedido=='ENVIADO','label label-warning':pedidos.estatus_pedido=='PENDIENTE'}">{{pedidos.estatus_pedido}}</span> </h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                      <div class="btn-group">
                        <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a target="_blank" href="pages/print/pedidos_detalles.php?formato=txt&idPedido={{pedidos.id_pedido}}"><i class="fa fa-print"></i> Imprimir</a></li>
                          <li><a target="_blank" href="pages/print/pedidos_detalles.php?formato=PDF&idPedido={{pedidos.id_pedido}}"><i class="fa fa-file-pdf-o"></i> Generar PDF</a></li>
                        </ul>
                      </div>
                     </div>
                      </div><!-- /.box-header -->
                      <div class="box-body" style="display: none;">
                  <table class="table">
                  <thead> 
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Descripción del Productos</th>
                      <th class="text-center">Cant. Productos</th>
                      <th class="text-center">Precio</th>
                      <th class="text-center">Sub Total</th>
                      <th class="text-center">Nro. Factura</th>
                      <th class="text-center">Nro. Remisión</th>
                      <th class="text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="detalle in DetallePedidos[$index]">
                      <td class="text-center">{{$index+1}}</td>
                      <td class="text-center">{{detalle[1]}}  CAT. {{detalle[4]}} - {{detalle.nombre_producto}} | <span class="small">{{detalle.color_pedido}}</span>  {{detalle.medida}} Mtr</td>
                      <td class="text-center">{{detalle.cant_prod_detalle}}</td>
                      <td class="text-center">{{detalle.precio_prod_detalle | currency:'/s '}} </td>
                      <td class="text-center">{{detalle.importe_prod_detalle | currency:'/s '}}</td>
                      <td ng-if="!detalle.nro_factura" class="text-center">---</td>
                      <td ng-if="detalle.nro_factura" class="text-center">{{detalle.nro_factura}}</td>
                      <td ng-if="!detalle.nro_remision" class="text-center">---</td>
                      <td ng-if="detalle.nro_remision" class="text-center">{{detalle.nro_remision}}</td>

                      <td class="text-center">
                        <a href="#/facturacion" data-toggle="tooltip" title="Registrar Pago"><i class="fa fa-edit"></i>
                        &nbsp;&nbsp;</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                      </div><!-- /.box-body -->
                    </div>
                </div><!-- /.box-body -->
              </div>
              </div>
     









              <div  ng-if="!SearchPedidos" class="box box-default">
                <div class="box-header with-border">
                  <i class="fa fa-edit"></i>
                  <h3 class="box-title">Listado General de Pedidos</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" style="display: block;">
                  <div class="table-responsive">
                <table class="table">
                  <thead> 
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Fecha</th>
                      <th class="text-center">Nro. de Pedido</th>
                      <th class="text-center">RUC/DNI</th>
                      <th class="text-center">Cliente</th>
                      <th class="text-center">Cant. Productos</th>
                      <th class="text-center">Importe</th>
                      <th class="text-center">Observación</th>
                      <th class="text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="pedidos in consularPedido">
                      <td class="text-center">{{$index+1}}</td>
                      <td class="text-center">{{pedidos.fecha_pedido | date:'d/MM/yyyy'}}</td>
                      <td class="text-center"><a href="pages/system/pedidos_detalles.php?formato=txt&idPedido={{pedidos.id_pedido}}" target="_blank">
                      2016-{{pedidos.numero_pedido}}</a> </td>
                      <!-- Valores Multiples (DNI/RUC)--> 
                      <td ng-if="pedidos.DNI" class="text-center">{{pedidos.DNI}}</td>
                      <td ng-if="pedidos.RUC" class="text-center">{{pedidos.RUC}}</td>
                      <!-- Valores Multiples (Nombre/Razon Social)--> 
                      <td ng-if="pedidos.tipo_cliente=='Natural'" class="text-center">{{pedidos.nombre}} {{pedidos.apellido}}</td>
                      <td ng-if="pedidos.RUC" class="text-center">{{pedidos.razonsocial}}</td>
                      <td class="text-center">{{pedidos.cant_productos_pedido}} </td>
                      <td class="text-right">{{pedidos.total_importe | currency:'/s '}} </td>
                      <td ng-if="pedidos.comentario" class="text-center"><a href="" data-toggle="tooltip" data-original-title="Observación: {{pedidos.comentario}}" >(...)</a></td>
                      <td ng-if="!pedidos.comentario" class="text-center">---</td>
                      <td class="text-center">
                        <a href="pages/system/pedidos_detalles.php?formato=txt&idPedido={{pedidos.id_pedido}}" target="_blank" data-toggle="tooltip" title="Ver Detalle">
                        <i class="fa fa-search-plus fa-2x"></i></a>&nbsp;&nbsp;
                        <a href="pages/system/pedidos_detalles.php?formato=PDF&idPedido={{pedidos.id_pedido}}" target="_blank" data-toggle="tooltip" title="Generar PDF">
                        <i class="fa fa-file-pdf-o fa-2x"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div> 
                </div><!-- /.box-body -->


   </div>
</div> <!--end/ng-switch-on-->




                  </div><!-- /.tab-panel Listar Usuario -->
                
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include_once('../../../config/footer_inside.html');  ?>
      <!-- Control Sidebar -->
<!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

