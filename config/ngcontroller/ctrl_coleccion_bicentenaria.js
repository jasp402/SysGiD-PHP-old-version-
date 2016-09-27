app.controller('ngCtrl_Coleccion_Bicentenaria', function(
    $scope,
    public,
    SQL,
    SQLGlobal,
    ClearForm,
    AlertGlobal){

    //Basic Config
    AlertGlobal.bienvenida('Transporte','¡Porfavor No desespere!');
    public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
    public.ngTitle = 'SysGiD | Recepción';

    //Preload SideBar
    $scope.SQL      = SQLGlobal;

    //Constants
    $scope.fdata    = {};
    $scope.noItem   = [];

    //View
    $scope.cambiarVista =function(value){
        public.ngVista = value;
    };

    $scope.autoComplet = function (data) {
        $scope.fdata.id_proveedor = data.id_proveedor;
        $scope.noItem.SearchForm = data.nombre;
        $scope.successInput = true;
        $scope.blocked = true;
    };

    $scope.removeSearch = function () {
        $scope.successInput = false;
        $scope.fdata.id_proveedor = '';
        $scope.noItem.SearchForm = '';
    };

    $scope.forms = [{name: "form1"}];
    $scope.createForm = function(){
        $scope.forms.push({name: "form" + ($scope.forms.length + 1)});
    };
    $scope.saveForm = function(formScope){
        alert("Save called for " + formScope.name + ", myInputValue = " + formScope.myInputValue);
    };


    $scope.consult = function () {
        $scope.where = [{'estatus':'a'}];
        SQL.SELECT('*', 'proveedor', $scope.where).then(function (promise) {
            $scope.getProveedores = promise;
            return $scope.getProveedores;
        });
    };

    $scope.consult();

});


