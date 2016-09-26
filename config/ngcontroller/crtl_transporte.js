//-----------------------------------------------------------------------------CONTROL TRANSPORTE
app.controller('ngControlTransporte', function(SQL,ClearForm, public, SQLGlobal, $scope, $timeout, AlertGlobal){ // $scope.chart = CharsGlobal;

    //Basic Config
    AlertGlobal.bienvenida('Transporte','¡Porfavor No desespere!');
    public.ngClassBody = 'skin-blue sidebar-mini sidebar-open sidebar-collapse';
    public.ngTitle = 'SysGiD | Productos';

    //Preload SideBar
    $scope.SQL      = SQLGlobal;

    //Constantes
    $scope.fdata    = {};
    $scope.noItem   = [];



    //View
    $scope.cambiarVista =function(value){
        public.ngVista = value;
    };

    $scope.autoComplet = function (data) {
        $scope.fdata.id_empresa_transporte = data.id_empresa_transporte;
        $scope.noItem.SearchForm = data.razon_social;
        $scope.successInput = true;
        $scope.blocked = true;
    };

    $scope.removeSearch = function () {
        $scope.successInput = false;
        $scope.fdata.id_empresa_transporte = '';
        $scope.noItem.SearchForm = '';
    };

//---------------------------------Transporte---------------------------------------------------------

    $scope.RegEmpresaTransporte = function(fdata){
        SQL.INSERT('transporte_empresas',fdata);
        AlertGlobal.success('¡Registro exitoso!',fdata['razon_social']);
        ClearForm.easyFrom(fdata);
        $scope.listarET();
    };

    $scope.RegChofer = function (fdata) {
        SQL.INSERT('transporte_chofer',fdata);
        AlertGlobal.success('¡Registro exitoso!',fdata.nombre+' '+fdata.apellido);
        $scope.removeSearch();
        ClearForm.easyFrom(fdata);
    };

    $scope.RegVehiculo = function(fdata){
        SQL.INSERT('transporte_vehiculos',fdata);
        AlertGlobal.success('¡Registro exitoso!',fdata.marca+' '+fdata.modelo);
        $scope.removeSearch();
        ClearForm.easyFrom(fdata);
    };

    $scope.consult = function () {
        $scope.where = [{'estatus':'a'}];
        SQL.SELECT('*', 'transporte_empresas', $scope.where).then(function (promise) {
            $scope.listarET = promise;
            return $scope.listarET;
        });
        SQL.SELECT('*', 'transporte_chofer', $scope.where).then(function (promise) {
            $scope.listarT = promise;
            return $scope.listarT;
        });
        SQL.SELECT('*', 'transporte_vehiculos', $scope.where).then(function (promise) {
            $scope.listarV = promise;
            return $scope.listarV;
        });
    };

    $scope.consult();

});

