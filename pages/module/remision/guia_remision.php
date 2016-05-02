    <div class="wrapper"  ng-init="changeClass()">
    <?php include_once('../../../config/topbar.html'); ?>
    <?php include_once('../../../config/menubar.html'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Guias de Remisión
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
                  <h3 class="box-title"><i class="fa fa-area-chart"></i> Estadisticas de Remisiones <small> Registro por mes</small></h3>
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

<a href="" ng-click="cambiarVista('Generar Guía de Remisión')">
<div class="col-md-6 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':obj.ngVista!='Generar Guía de Remisión','bg-navy':obj.ngVista=='Generar Guía de Remisión'}">
                <i class="fa fa-map-signs"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Generar Guía de Remisión</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> Guías Registradas <br></span>
                
                </div>
              </div><!-- /.info-box -->
            </div>
</a>

<a href="" ng-click="cambiarVista('Consultar Guias')">
<div class="col-md-6 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':obj.ngVista!='Consultar Guias','bg-navy':obj.ngVista=='Consultar Guias'}">
                <i class="fa fa-file-text-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Consultar Guias de Remision</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i>  Facturas creadas <br></span>
                 
                </div>
              </div><!-- /.info-box -->
            </div>
</a>
          </div><!-- /.row -->





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

                <div class="row" ng-switch on="obj.ngVista">

      <!--PARTE I-->
                  <div ng-switch-when="Generar Guía de Remisión">
<form ng-submit="regRemision(fdata)">
<div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">{{vista}}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <div class="col-md-12">
                      <div class="form-group col-md-3">
                        <b>Fecha de Inicio del Traslado:</b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="date" name='fecha' class="form-control"  ng-model="fdata.fecha_inicio" required>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <b>Nº Guía de Remisión:</b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                          <input type="text" name='guia' class="form-control"  ng-model="fdata.guia" ng-disabled="!fdata.fecha_inicio" required>
                        </div>
                      </div>
                      <div class="form-group col-md-3">
                        <b>N° de Pedido:</b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                          <input ng-show="!successInput" placeholder="Buscar N° Pedido..." type="textbox" class="form-control" ng-model="BuscarFactura.numero_pedido" ng-disabled="!fdata.guia" required>
                          <input ng-show="successInput" type="textbox" class="form-control" ng-model="nroGuia" disabled>
                          <span ng-if="successInput" ng-click="cambiarfact()" class="input-group-addon"><a href=""><i class="fa fa-exchange"></i></a></span>
                         
                        </div>
                      </div>
                    <div class="form-group col-md-3">
                        <b>Cliente: </b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-users"></i></span>
                          <input ng-show="!successInput"  placeholder="Cliente..." type="textbox" class="form-control" disabled>
                          <input ng-show="successInput"   type="textbox" class="form-control" ng-model="Cliente" disabled>
                        </div>
                    </div>                  
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                          <table class="table table-hover small" ng-if="!successInput">
                            <tbody>
                            <tr ng-if="BuscarFactura">
                              <th>#</th>
                              <th>Cliente</th>
                              <th>Fecha</th>
                              <th>Nro. Pedido</th>
                              <th>Cant. Productos</th>
                              <th>Estado del Pedido</th>
                            </tr>
                            <tr ng-if="!BuscarFactura">
                              <td colspan="6">Utiliza el campo de busqueda...</td>
                            </tr>
                            <tr ng-if="!((consularPedido|filter:BuscarFactura).length)">
                              <td colspan="6">No se ha encontrado Resultados... </td>
                            </tr>
                            <tr ng-if="!BuscarFactura">
                              <td colspan="6"><br></td>
                            </tr>
                            <tr  ng-repeat="factura in consularPedido | filter:BuscarFactura | limitTo:3" ng-if="BuscarFactura && factura.total_pedidos>0" ng-click="cargarProdRemision(factura)">
                              <td><a href="">{{$index+1}}</a></td>                              
                              <td><a href="">{{factura.razonsocial}} {{factura.nombre}} {{factura.apellido}}</a></td>
                              <td><a href="">{{factura.fecha_pedido}}</a></td>
                              <td><a href="">2016-{{factura.numero_pedido}}</a></td>
                              <td><a href="">{{factura.cant_productos_pedido}}</a></td>
                              <td><a href="">{{factura.estatus_pedido}}</a></td>
                            </tr>
                            <tr ng-if="BuscarFactura">
                              <td colspan="6"><br></td>
                            </tr>
                             <tr ng-if="!BuscarFactura" ng-repeat="factura in consularPedido | filter:BuscarFactura | limitTo:3">
                              <td><br></td>
                              <td><br></td>
                              <td><br></td>
                              <td><br></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div ng-if="idPedido">
                      <div class="box-header">
                      <i class="fa fa-list-ul"></i>
                      <h3 class="box-title">Motivo del Traslado | <small>{{fdata.radio}}<span ng-if="fdata.radio=='Otros'">: {{fdata.otro}}</span></small></h3>
                      </div>
                      <div class="form-group col-sm-3">
                  <div class="radio">
                    <label>
                      <input type="radio" id="1" name="radio" value="Venta" ng-model="fdata.radio" required>
                      Venta
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" id="2" name="radio" value="Venta Sujeto a Confirmación" ng-model="fdata.radio">
                      Venta Sujeto a Confirmación
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" id="3" name="radio" value="Compra" ng-model="fdata.radio">
                      Compra
                    </label>
                  </div>
                </div>

                <div class="form-group col-sm-3">
                  <div class="radio">
                    <label>
                      <input type="radio" id="4" name="radio" value="Devolución" ng-model="fdata.radio">
                      Devolución
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" id="5" name="radio" value="Consignación" ng-model="fdata.radio">
                      Consignación
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" id="6" name="radio" value="Para transformación" ng-model="fdata.radio">
                      Para transformación
                    </label>
                  </div>
                </div>

                <div class="form-group col-sm-3">
                  <div class="radio">
                    <label>
                      <input type="radio" id="7" name="radio" value="Recojo de Bienes Trasformados" ng-model="fdata.radio">
                      Recojo de Bienes Trasformados
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" id="8" name="radio" value="Emisor Interante" ng-model="fdata.radio">
                      Emisor Interante
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" id="9" name="radio" value="Importación" ng-model="fdata.radio">
                      Importación
                    </label>
                  </div>
                </div>
               
                <div class="form-group col-sm-3">
                  <div class="radio">
                    <label>
                      <input type="radio" id="10" name="radio" value="Exportación" ng-model="fdata.radio">
                      Exportación
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio"  id="11" name="radio" value="Zona Primaria" ng-model="fdata.radio">
                      Zona Primaria
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" id="12"  name="radio" value="Otros" ng-model="fdata.radio">
                      Otros
                    </label>
                    <label ng-show="fdata.radio=='Otros'">
                      <input type="text" placeholder="especifique..." ng-model="fdata.otro">
                    </label>
                  </div>
                </div>
               </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>


<div>
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos del Transporte</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" style="display: block;">
                  <div class="form-group col-md-6" ng-show="successInput">
                        <b>Transportista: </b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                            <select class='form-control' ng-model="fdata.usersT" ng-options="usersT.nombre for usersT in ListrarTablaT" required>
                              <option value=''  Disabled>Seleccione Tansporte...</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group col-md-6" ng-show="successInput">
                        <b>Empresa de Transpote: </b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-industry"></i></span>
                            <input type="text" class="form-control" ng-model="fdata.usersT.razonsocial"  disabled>
                        </div>
                      </div>
                      <div class="form-group col-md-12" ng-show="successInput">
                        <b>Punto de partida: </b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                            <input type="text" class="form-control" ng-model="fdata.punto_partida" required>
                        </div>
                      </div>
                      <div class="form-group col-md-12" ng-show="successInput">
                        <b>Punto de llegada: </b>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                            <input type="text" class="form-control" ng-model="fdata.punto_llegada" required>
                        </div>
                      </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>


            <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Seleccione los Productos</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" style="display: block;">
                   <div class="col-md-12">
                      <div class="box-header">
                      <i class="fa fa-list-ul"></i>
                      <h3 class="box-title">Productos</h3>
                      <p>Lista de productos de la Factura<strong> {{Factura}}</strong>, Seleccione los Productos que desea incluir en la guia remisión.</p><hr>
                      </div> 
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead> 
                            <tr>
                              <th class="text-center">#</th>
                              <th width="20%" class="text-center">Tipo de Producto</th>
                              <th width="15%" class="text-center">Categoria</th>
                              <th class="text-center">Nombre del Producto</th>
                              <th class="text-center">Cantidad</th>
                              <th class="text-center">Nº Guia Remisión</th>
                              <th width="1%" class="text-center">Asignar</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody class="detalle small small">
                            <tr ng-repeat="product in ListarProdFactRem" ng-class="{'bg bg-red':product.nro_remision, 'bg-gray':select}"  class="text-center">
                              <td> {{$index+1}}</td>
                              <td>{{product[1]}}</td>
                              <td>{{product[4]}}</td>                        
                              <td>{{product.nombre_producto}}</td>                           
                              <td>{{product.cant_prod_detalle}} unid.</td>

                              <td ng-if="!product.nro_remision"><b>---</b></td>
                              <td ng-if="product.nro_remision"><b>{{product.nro_remision}}</b></td>
                              <td ng-if="product.nro_remision"><b>Entregado</b></td>
                              <td ng-if="!product.nro_remision">
                              <input type="checkbox" name="product" ng-model="fdata.producto[$index]" ng-click="select =!select" ng-disabled="product.nro_remision"></td>
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
                          </tfoot>
                        </table>
                      </div>
                  </div>

                    <div class="col-md-12">
                    </div>
                    {{productos[0]}}
                    <div class="box-footer text-center col-md-12">
                        <input class="btn btn-success" type="submit" value="Guardar">
                    </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
</form>
                  </div>
      


      <!--PARTE II-->
                  <div ng-switch-when="Consultar Guias" class="col-md-12">


              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">{{vista}} de Remisión</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" ng-model="factura" placeholder="Buscar guía de remisión...">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-hover table-striped small">
                  <thead> 
                    <tr>
                      <th ng-click="sortType = '$index'; sortReverse = !sortReverse" class="text-center"><a href="">#</a></th>
                      <th ng-click="sortType = 'items.fecha_traslado'; sortReverse = !sortReverse" class="text-center"><a href="">Fecha de Traslado</a></th>
                      <th ng-click="sortType = 'items.razonsocial'; sortReverse = !sortReverse" class="text-center"><a href="">Cliente</a></th>
                      <th ng-click="sortType = 'items.nro_remision'; sortReverse = !sortReverse" class="text-center"><a href="">Nº Remisión</a></th>
                      <th ng-click="sortType = 'items.numero_pedido'; sortReverse = !sortReverse" class="text-center"><a href="">Nº Pedido</a></th>
                      <th ng-click="sortType = 'items.nro_factura'; sortReverse = !sortReverse" class="text-center"><a href="">Nº factura</a></th>
                      <th class="text-center">Transportista</th>
                      <th ng-click="sortType = 'items[8]'; sortReverse = !sortReverse" class="text-center"><a href="">Categoria</a></th>
                      <th class="text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="items in ListarRemision | filter:factura | orderBy:sortType:sortReverse">
                      <td class="text-center">{{$index+1}}</td>
                      <td class="text-center">{{items.fecha_traslado}}</td>
                      <td class="text-center">{{items.razonsocial}} {{items.nombre}} {{items.apellido}}</td>
                      <td class="text-center">{{items.nro_remision}}</td>
                      <td class="text-center">{{items.numero_pedido}}</td>
                      <td class="text-center">{{items.nro_factura}}</td>
                      <td class="text-center">{{items[30]}}  {{items[31]}}</td>
                      <td class="text-center">{{items[8]}}</td>
                      <td class="text-center">
                        <a href="pages/print/remision_pdf.php?formato=txt&idPedido={{items.id_remision}}" target="_blank" data-toggle="tooltip" title="Ver Detalle">
                        <i class="fa fa-search-plus fa-2x"></i></a>&nbsp;&nbsp;
                        <a href="pages/print/remision_pdf.php?formato=PDF&idPedido={{items.id_remision}}" target="_blank" data-toggle="tooltip" title="Generar PDF">
                        <i class="fa fa-file-pdf-o fa-2x"></i></a>
                      </td>
                    </tr>
                  </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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

