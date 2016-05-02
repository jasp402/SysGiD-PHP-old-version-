<?php session_start(); ?>

<div class="login-box" ng-controller="ngControlLogin">
  <div class="login-logo">
    <a href="#/"><b>Sys</b>GiD</a>
  </div>
  <div class="login-box-body"> 
    <p class="login-box-msg">{{public.msgTitle}}</p>
    <form ng-submit="ngValidate(fdata)" ng-show="formGroup">
      <div class="form-group has-feedback" >
        <span class="fa fa-envelope-o form-control-feedback"></span>
        <input type="email" class="form-control" placeholder="Usuario" ng-model="fdata.ngName" ng-focus="AlertMensaje=''"  required>        
      </div>
      <div class="form-group has-feedback">
        <span ng-if='fdata.ngPassword' class="fa  fa-unlock-alt form-control-feedback"></span>
        <span ng-if='!fdata.ngPassword' class="fa  fa-lock form-control-feedback"></span>
        <input type="password" class="form-control" placeholder="Password" ng-model="fdata.ngPassword" ng-disabled="!fdata.ngName" required>     
      </div>
      <div class="row">
        <div class="col-xs-12"> 
          <button type="submit" class="btn btn-primary btn-block btn-flat" ng-disabled="!fdata.ngPassword">Entrar</button>
        </div>
      </div>
    </form>
    <br>
    <div ng-switch on="AlertMensaje">
    <!-- En caso de Error -->
    <div class="alert alert-danger alert-dismissible fade in" role="alert" ng-switch-when="incorrecto">
      <em> <b>Atención!</b> Tu Usuario o Contraseña son incorrectos. </em>
    </div>

    <!-- Usuarios Nuevos --> 
    <div class="alert alert-info alert-dismissible fade in" role="alert" ng-switch-when="nuevo">
      <em> <b>Atención!</b> Su cuenta aun no encuentra activa. <br> <small>Porfavor contacte al administrador del sistema.</small></em>
    </div>

    <!-- Usuarios Suspendidos -->
    <div class="alert alert-warning alert-dismissible fade in" role="alert" ng-switch-when="suspendido">
      <em> <b>Atención!</b> Su cuenta se encuentra suspendida. <br> <small>Porfavor contacte al administrador del sistema.</small></em>
    </div>

    <!-- Acceso Correcto -->
    <div class="alert alert-success alert-dismissible fade in" role="alert" ng-switch-when="correcto">
      <em> <b>Bienvenido!</b> {{public.ngUser.nombres}}</em>
    </div>
    </div>
    
      <div class="lockscreen-footer text-center">
    <hr>
        Copyright &copy; 2015-2016 <b><a href="http://www.sysgid.com" target="_blank" class="text-black">SysGiD <small> V<small>{{public.DataSystem.version}}</small></small></a></b><br>
        Todos los Derechos Reservados
        
        <!-- <div class="box box-default"> <span class="glyphicon glyphicon-info-sign"></span><a href=""> Reportar inconveniente</a></div>  -->
    </div>

  </div>
</div>
