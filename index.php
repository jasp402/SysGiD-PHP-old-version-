
<!DOCTYPE html>
<html lang="es" ng-app="app" ng-controller="ControlPrincipal">

<head>
    <title ng-if="!public.ngTitle">SysGiD</title>
    <title>{{public.ngTitle}}</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link ng-if="ngUser" rel="stylesheet" href="plugins/bower-material-master/angular-material.css">
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/bootstrap/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css"> -->
    <!--  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="plugins/bootstrap-switch-master/bootstrap-switch.css" >
    <link rel="stylesheet" href="dist/css/angular.css" >
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="plugins/ionicons/ionicons.css">
    <link rel="stylesheet" href="plugins/angular-chart.js/angular-chart.css">
    <link rel="stylesheet" href="plugins/sweetalert-master/dist/sweetalert.css">
    <link rel="stylesheet" href="plugins/select2/select2.min.css">

    <link rel="shortcut icon" href="dist/img/favicon-16x16.ico" type="image/x-icon"/>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="plugins/angular-1.4.7/angular.js"></script>
    <script src="plugins/angular-1.4.7/angular-animate.min.js"></script>
    <script src="plugins/angular-1.4.7/angular-count-to.min.js"></script>
    <script src="plugins/angular-1.4.7/angular-route.min.js"></script>
    <script src="plugins/angular-1.4.7/angular-aria.min.js"></script>
    <script src="plugins/angular-1.4.7/angular-messages.min.js"></script>
    <script src="plugins/angular-1.4.7/ui-bootstrap-tpls-0.13.4.min.js"></script>
    <script src="plugins/angular-1.4.7/angular-bootstrap-file-field.min.js"></script>
    <script src="plugins/angular-1.4.7/i18n/angular-locale_es-es.js"></script>
    <script src="plugins/angular-1.4.7/angular-filter.js"></script>
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="plugins/bootstrap-switch-master/bootstrap-switch.min.js"></script>
    <script src="plugins/chartjs/Chart.js"></script>
    <script src="plugins/angular-chart.js/angular-chart.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="plugins/sweetalert-master/dist/sweetalert.min.js"></script> <!-- Ojo hay que eliminar lo que no se use-->
    <script src="plugins/angular-sweetalert-master/dist/ngSweetAlert.js"></script>
    <script src="plugins/material-master/docs/app/svg-assets-cache.js"></script>
    <script src="plugins/bower-material-master/angular-material.js"></script>
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/restangular/dist/restangular.js"></script>
    <script src="plugins/angular-1.4.7/angular-resource.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/angular-filter/0.4.7/angular-filter.js"></script> -->
    <!--    MATERIAL        -->
</head>


  <body ng-class="public.ngClassBody">
    <ng-view></ng-view>
  </body>

<script src="config/config-an-app.js"></script>
<script src="config/config-an-service.js"></script>
<script src="config/ngcontroller/crtl_clientes.js"></script>
<script src="config/ngcontroller/crtl_facturacion.js"></script>
<script src="config/ngcontroller/crtl_pedidos.js"></script>
<script src="config/ngcontroller/crtl_productos.js"></script>
<script src="config/ngcontroller/crtl_transporte.js"></script>
<script src="config/ngcontroller/crtl_remision.js"></script>
<script src="config/ngcontroller/crtl_seguridad.js"></script>
<script src="config/ngcontroller/crtl_reportes.js"></script>
<script src="config/ngcontroller/ctrl_coleccion_bicentenaria.js"></script>
<!--<script src="dist/js/pages/dashboard.js"></script>-->
<script src="dist/js/app.js"></script>
<script src="dist/js/demo.js"></script>
</html>







