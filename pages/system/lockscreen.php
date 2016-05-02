<?php session_start(); ?>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href=""><b>Sys</b>GiD</a>
      </div>
      <!-- User name -->
      <div class="lockscreen-name  text-center">{{usuario.nombres}}</div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
        <!--  <img src="../../dist/img/user1-128x128.jpg" alt="User Image"> -->
          <img ng-if="usuario.sexo == 'mujer' && !usuario.img_url" src="dist/img/avatar2.png" alt="User Image">
          <img ng-if="usuario.sexo == 'hombre' && !usuario.img_url" src="dist/img/avatar5.png" alt="User Image">
          <img ng-if="usuario.img_url" src="{{usuario.img_url}}" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" ng-submit="openscreen(fdata)">
          <div class="input-group">
            <input type="password" class="form-control" placeholder="password" ng-model="fdata.ngPassword">
            <div class="input-group-btn">
              <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form><!-- /.lockscreen credentials -->

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center">
        {{msgTitle2}}
      </div>
      <div class="text-center">
        <a href="#/">Iniciar sesión con un usuario diferente</a>
      </div>
            <div class="lockscreen-footer text-center">
              <hr>
              Copyright &copy; 2015-2016 <b><a href="" class="text-black">SysGiD <small> <small>V {{public.DataSystem.version}}</small></small> </a></b><br>
              Todos los Derechos Reservados            
            </div>
    </div>
