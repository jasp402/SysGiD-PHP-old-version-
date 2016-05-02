     <div class="wrapper"  ng-init="changeClass();">
    <?php include_once('../../../config/topbar.html'); ?>
    <?php include_once('../../../config/menubar.html'); ?>
      


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Productos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"><a href="#/dashboard"></i> SysGiD</li></a>
            <li><a href="">{{public.ngMenu.titulo}}</a></li>
            <li class="active">{{public.ngVista}}</li>
          </ol>
        </section>







<section class="content" ng-init="listarProductos()">
          <div class="row">


<div class="col-md-12 ng-scope" ng-controller="ngControlChars" ng-init="producxmes()">
              <div class="box">
                <div ng-if="!public.loadingChars" class="overlay">
                  <i class="fa fa-refresh fa-spin"></i>
                </div> 
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-area-chart"></i>Productos Vendidos</h3>
                      
                    <div class="box-tools pull-right">
                      <div class="btn-group">
                      <button class="btn btn-box-tool" ng-click="public.loadingChars=false; producxmes()" l=""><i class="fa fa-refresh"></i></button>
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
                <div class="chart">
                    <!-- Sales Chart Canvas -->
                  <div class="chart-container"><canvas id="line" class="chart chart-line ng-isolate-scope" chart-data="data_produc" chart-labels="labels" chart-series="Clientes" style="width: 1086px; height: 100px;" width="1086" height="100"></canvas></div>
                </div><!-- /.chart-responsive -->
              </div><!-- /.col -->
            </div>
          </div>



<a href="" ng-click="cambiarVista('Listar Productos')">
<div class="col-md-3 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':public.ngVista!='Listar Productos','bg-navy':public.ngVista=='Listar Productos'}">
                <div class="icon">
                  <i class="ion-pricetags"></i>
                </div>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">Listar Productos</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> Consultar & Editar Productos</span>                  
                </div>
              </div><!-- /.info-box -->
            </div>
</a>



<a href="" ng-click="cambiarVista('Registrar Productos')">
<div class="col-md-3 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':public.ngVista!='Registrar Productos','bg-navy':public.ngVista=='Registrar Productos'}">
                <div class="icon">
                  <i class="ion-ios-cart"></i>
                </div></span>
                <div class="info-box-content">
                  <span class="info-box-text">Registrar Producto</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> Registrar un nuevo Productos</span>             
                </div>
              </div><!-- /.info-box -->
            </div>
</a>

<a href="" ng-click="cambiarVista('Registrar Tipos de Productos')">
<div class="col-md-3 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':public.ngVista!='Registrar Tipos de Productos','bg-navy':public.ngVista=='Registrar Tipos de Productos'}">
                <div class="icon">
                  <i class="ion ion-compose"></i>
                </div></span>
                <div class="info-box-content">
                  <span class="info-box-text">Registrar Tipos</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> Registrar Tipos de Productos</span>
                 
                </div>
              </div><!-- /.info-box -->
            </div>
</a>



<a href="" ng-click="cambiarVista('Registrar Categorias de Productos')">
<div class="col-md-3 col-xs-12">
              <div class="info-box bg-light-blue-active">
                <span class="info-box-icon" ng-class="{'bg-light-blue-active':public.ngVista!='Registrar Categorias de Productos','bg-navy':public.ngVista=='Registrar Categorias de Productos'}">
                <div class="icon">
                  <i class="ion ion-compose"></i>
                </div></span>
                <div class="info-box-content">
                  <span class="info-box-text">Registrar Categorias</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="description-percentage"><i class="fa fa-caret-left"></i> Registrar Categorias de Productos</span>
                 
                </div>
              </div><!-- /.info-box -->
            </div>
</a>
          </div><!-- /.row -->















          <div class="row" ng-switch on="public.ngVista">
            <div class="col-md-12 ">
              <div class="nav-tabs-custom box box-default">
                <div class="tab-content" >
                  
                  <div ng-switch-when="Registrar Productos" class="active tab-pane" id="activity"><!-- tab-panel Registrar Usario -->
                  
                  <div class="box-header">
                  <br>
                    <i class="fa fa-edit"></i>
                    <h3 class="box-title">{{public.ngVista}}</h3><hr>
                  </div>
                    
                    <form class="form-horizontal" ng-submit="RegProducto(fdata)">
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Tipo de Producto /  Categoria de producto</label>
                        <div class="col-sm-4">
                          <select class="form-control" ng-model="fdata.Tipo" ng-options="tipo.nombre for tipo in ListrarTipoProd"  required>
                            <option value="" Disabled>- Tipo de Producto -</option>
                          </select>
                        </div>

                        <div class="col-sm-5">
                          <select class="form-control"   ng-model="fdata.categoria" ng-options="categoria.nombre for categoria in ListrarCategoria"  required>
                            <option value="" Disabled>- Cagoria de Cagoria -</option>
                          </select>
                        </div>
                    </div>


                    <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Codigo / Nombre del Producto</label>
                        <div class="col-sm-3">
                         <input type="text" class="form-control" placeholder="{{ListarProductos[ListarProductos.length-1].cod_producto}}" ng-model='fdata.cod_producto' required>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" placeholder="Nombre del Producto" ng-model="fdata.nombre_producto" required>
                        </div>
                    </div>


                    <div class="form-group">
                    <div class="col-sm-12 text text-center">
                         <spam><a href="" ng-click="detalles=!detalles">Incluir Detalles</a></spam>
                        </div>
                    </div>

                      <div class="form-group" ng-if="detalles">
                        <label for="inputName" class="col-sm-2 control-label">Medida / Peso / Precio / Cantidad</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" placeholder="Medida" ng-model="fdata.medida">
                        </div>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" placeholder="Peso" ng-model="fdata.peso">
                        </div>   
                      </div>

                      <div class="form-group" ng-if="detalles">
                        <label for="inputName" class="col-sm-2 control-label">Medida / Peso Color / Precio / Cantidad</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" placeholder="Precio" ng-model="fdata.precio">
                        </div>  
                         <div class="col-sm-3">
                          <input type="text" class="form-control" placeholder="cantidad" ng-model="fdata.cant">
                        </div>  
                      </div>
                    <br>
          
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-9">
                  <div ng-if='success' class="callout callout-success">
                    <h4>Producto Registrado satisfactoriamente</h4>
                       Puede consultar todos los productos en <a href="" ng-click="ActClass('Consultar Inventario de Productos')"><b>Listar Productos</b></a> </p>
                  </div>


                          <input  type="submit" class="btn btn-danger" ng-if='!success' value="Registrar Producto">
                        </div>
                    <br>
                      </div>
                    </form>   
                  </div><!-- /.tab-panel Registrar Usario -->
























<div ng-switch-when="Registrar Tipos de Productos" class="active tab-pane" id="activity"><!-- tab-panel Registrar Usario -->
                  
                  <div class="col-sm-12 box-header">
                  <br>
                    <i class="fa fa-edit"></i>
                    <h3 class="box-title">{{public.ngVista}}</h3><hr>
                  </div>
                    
                    <form class="form-horizontal" ng-submit="RegTipoProd(fdata)">
                      <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Nuevo Tipo de Producto</label> 
                        <div class="col-sm-3">
                          <input type="text" class="form-control" placeholder="Nombre"  ng-model='fdata.Tipo_nombre' required>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="Descripción"  ng-model='fdata.Tipo_descipcion'>
                        </div>
                        <div class="col-sm-3">
                           <input  type="submit" class="btn btn-danger" value="{{public.ngVista}}">
                        </div>
                      </div>
                    </form>   

<!-- Lista de tipos de productos -->
                    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista de Tipos de Productos</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <table class="table table-condensed">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre de la Categoria</th>
                      <th>Descripción de la Categoria</th>
                      <th style="width: 40px">Funciones</th>
                    </tr>
                    <tr ng-repeat="tipo in ListrarTipoProd">
                      <td>{{$index + 1}}.</td>
                      <td>{{tipo.nombre}}</td>
                      <td>{{tipo.descipcion}}</td>
                      <td align="center"><a href=""  ng-click="EliminarTipoProduc(tipo.idtipo_producto)" class="glyphicon glyphicon-trash"></a></td>
                    </tr>
                    
                  </tbody></table>
                </div><!-- /.box-body -->
              </div>
</div><!-- /.tab-panel Registrar Usario -->


















<div ng-switch-when="Registrar Categorias de Productos" class="active tab-pane" id="activity"><!-- tab-panel Registrar Usario -->
                  
                  <div class="col-sm-12 box-header">
                  <br>
                    <i class="fa fa-edit"></i>
                    <h3 class="box-title">{{public.ngVista}}</h3><hr>
                  </div>
                    
                    <form class="form-horizontal" ng-submit="RegInventario(fdata)">
                      <div class="form-group">
                       <label for="inputExperience" class="col-sm-2 control-label">Nueva Categoria</label> 
                        <div class="col-sm-3">
                          <input type="text" class="form-control" placeholder="Nombre de Categoria"  ng-model='fdata.cat_nombre' required>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" placeholder="Descripción de la Categoria"  ng-model='fdata.cat_descripcion'>
                        </div>
                        <div class="col-sm-3">
                           <input  type="submit" class="btn btn-danger" value="{{public.ngVista}}">
                        </div>
                      </div>
                    </form>   

<!-- Lista de tipos de productos -->
                    <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista de Tipos de Productos</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding" >
                  <table class="table table-condensed">
                    <tbody><tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre de la Categoria</th>
                      <th>Descripción de la Categoria</th>
                      <th style="width: 40px">Funciones</th>
                    </tr>
                    <tr ng-repeat="categoria in ListrarCategoria">
                      <td>{{$index + 1}}.</td>
                      <td>{{categoria.nombre}}</td>
                      <td>{{categoria.descripcion}}</td>
                      <td><a href=""  ng-click="EliminarCatProduc(categoria.idcategoria)" class="glyphicon glyphicon-trash"></a></td>
                    </tr>
                    
                  </tbody></table>
                </div><!-- /.box-body -->
              </div>
</div><!-- /.tab-panel Registrar Usario -->








                  <div ng-switch-default class="active tab-pane" id="timeline">
                  <table   class="table table-bordered">
                  <div class="box-header">
                    <i class="fa fa-edit"></i>
                    <h3 class="box-title">Listar Productos</h3>
                  </div>
                  
                    <tbody>
                    <tr>
                  <th>#</th>
                      <th style="width: 10px">Cod.</th>
                      <th ng-click="sortType = 'producto[12]'; sortReverse = !sortReverse"><a href="">Tipo de Producto</a></th>
                      <th ng-click="sortType = 'producto[10]'; sortReverse = !sortReverse"><a href="">Categoria</a></th>
                      <th ng-click="sortType = 'producto[2]'; sortReverse = !sortReverse"><a href="">Nombre de Producto</a></th>
                      <th ng-click="sortType = 'producto[3]'; sortReverse = !sortReverse"><a href="">Tamaño (Mtrs)</a></th>
                 <!--     <th ng-click="sortType = 'producto[4]'; sortReverse = !sortReverse"><a href="">Color</a></th> -->
                      <th ng-click="sortType = 'producto.disponible'; sortReverse = !sortReverse"><a href="">Stock</a></th>
                      <th ng-click="sortType = 'producto[5]'; sortReverse = !sortReverse"><a href="">Precio (/S)</a></th>
                      <th>Funciones</th>

                    </tr>
             <!--         <tr ng-if="edit">
                      <th style="width: 10px">Cod.</th>
                      <th ng-click="sortType = 'producto[12]'; sortReverse = !sortReverse"><a href="">Tipo de Producto</a></th>
                      <th ng-click="sortType = 'producto[10]'; sortReverse = !sortReverse"><a href="">Categoria</a></th>
                      <th ng-click="sortType = 'producto[2]'; sortReverse = !sortReverse"><a href="">Nombre de Producto</a></th>
                      <th ng-click="sortType = 'producto[3]'; sortReverse = !sortReverse"><a href="">Tamaño (Mtrs)</a></th>
                      <th ng-click="sortType = 'producto[4]'; sortReverse = !sortReverse"><a href="">Color</a></th>
                      
                      <th ng-click="sortType = 'producto[4]'; sortReverse = !sortReverse">><a href="">Disponible</a></th>
                      <th ><a href="">Precio (/S)</a></th>
                      <th>Funciones</th>

                    </tr>
                  <tr> <th colspan="9" class="bg-green color-palette text text-center">Usuarios Activos</th> </tr>-->
                    <tr ng-repeat="producto in ListarProductos | orderBy:sortType:sortReverse" class='small small'>
                  <td>{{$index+1}}</td> 
                  
                      <td>{{producto.cod_producto}}</td>

                      <td ><b>{{producto[14]}}</b></td>
                      
                      <td>{{producto[11]}}</td>

                      <td>{{producto.nombre_producto}}</td>

                      <td>{{producto.medida}} Mts.</td>

                  <!--    <td ng-hide="edit && indexProduct == $index">{{producto.color}}</td> 
<td ng-if="edit && indexProduct == $index"><input type="text" placeholder="{{producto.color}}" ng-model="new.color"></td>-->
                      <td ng-hide="edit && indexProduct == $index">{{producto.disponible}} Und.</td>
<td ng-if="edit && indexProduct == $index"><input type="text" placeholder="{{producto.disponible}}" ng-model="new.disponible"></td>
                      <td ng-hide="edit && indexProduct == $index">{{producto.precio | currency:'/s '}}</td>
<td ng-if="edit && indexProduct == $index"><input type="text" placeholder="{{producto.precio}} /s" ng-model="new.precio"></td>

                      <td ng-if="!edit" align="center">
                      <a href="" data-toggle="tooltip" data-original-title="Modificar Productos" ng-click="EditarProducto(producto.id_producto, $index)" class="glyphicon glyphicon-edit"></a>&nbsp;&nbsp; 
                      <a href="" data-toggle="tooltip" data-original-title="Eliminar de forma permanentemente este Productos"   ng-click="EliminarProducto(producto.id_producto)" class="glyphicon glyphicon-trash"></a>
                      <a ng-if="edit"  href=""  ng-click="EditarProducto(producto.id_producto, $index)" class="glyphicon glyphicon-edit"></a>
                      </td>

                      <td ng-if="edit" ng-show="indexProduct == $index" align="center">
                      <a href="" class="btn btn-sm btn-info btn-flat pull-left" ng-click="ActualizarProducto(producto,new)">Guardar</a>
                     
                    </tr>

                  </tbody>
                  </table>


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