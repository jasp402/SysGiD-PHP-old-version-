<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es" ng-app="app" ng-controller="ControlPrincipal">
<?php include('class/session.php') ?>
<?php include('config/header.min.html') ?>

  <body ng-class="public.ngClassBody">
  <?php if(isset($_SESSION['usuario'])){?><div ng-init="ValidarIdUsuario(<?php echo $_SESSION['usuario'] ?>)"></div><?php }?>
    <ng-view></ng-view>
  </body>

<?php include('config/footer.html');?>

</html>







