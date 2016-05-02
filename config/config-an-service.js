app.service('public', function () 
  {
    return {
      ngTitle : '',
      ngClassBody: '',
      ngUser: '', 
      ngMenu: {modulos:'', titulo: '', clase: ''}, 
      idUSer:'', 
      DataSystem:'', 
      DataCompany:'', 
      temp:'', 
      tempMsj:'', 
      SubModulo:'', 
      ngVista:'',
      ngChars:'',
      loadingChars:'',
      ngTempUrl:'',
      ngLockscreen:''}; 
       /* [ngChars] Mas a delante | cuando simplifique las graficas*/
  })







.service('SQLGlobal', function ($http) 
  {
  this.getDataUser = function(local,session){
    var value
    if(local){value = local}else if(session){value = session}else{return window.location = '#/'}
    this.sql_modulos="SELECT * FROM config_modulos AS m, permisos AS p WHERE p.id_usuario = '"+value+"' AND p.id_modulo = m.id_modulo and p.estatus='true'  ORDER BY m.orden ASC";
    this.sql_usuario="SELECT * FROM usuarios WHERE id_usuario = '"+value+"' AND estatus != 'e'";
      return{
        modulos: $http.post("class/angularSql.php", {SelectSQL:this.sql_modulos}),
        usuario: $http.post("class/angularSql.php", {SelectSQL:this.sql_usuario})        
      }   
  }       


  })






.service('AlertGlobal', function (sweet){
 
    this.bienvenida = function(t,m){   
       sweet.show({
        title:  "<small>Cargando Modulo:</small> <br> "+t+"<div class='progress'><div class='progress-bar progress-bar-primary progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 100%'></div></div>",
        text:   m,
        html: true,
       // imageUrl: 'dist/img/l.gif',
        timer: 2000,
        showConfirmButton: false
        })
    };

    this.success = function(t,m){
       sweet.show(t, m, 'success');
    };

  })
