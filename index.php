<!--//Session Start: Para mantener la sesion del usuario abierta.-->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es" ng-app="app" ng-controller="ControlPrincipal">
<!-- incluimos la clase sesion para autenticar el usuario. -->
<?php include('class/session.php') ?>

<!-- Incluimos ne el header.min.html todos los enlaces a librerias y plugins-->
<?php include('config/header.min.html') ?>


  <body ng-class="public.ngClassBody">
  <?php 
  //Se confirma si el usuario ya ha ingresado o aun no
  if(isset($_SESSION['usuario'])){?>
<!--En caso de encontrarse el usuario se valida el usuario que ingreso.-->
  <div ng-init="ValidarIdUsuario(<?php echo $_SESSION['usuario'] ?>)"></div><?php }?>
    <ng-view></ng-view>
  </body>

<?php include('config/footer.html');?>

</html>







