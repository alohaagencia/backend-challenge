app.service('contatoSrv', function($http) {
    this.getAll = function () {
		// debugger;
	    return $http.get("http://127.0.0.1/aloha_catalogo/public/api/list");
    }
});