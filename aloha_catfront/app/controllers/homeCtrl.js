app.controller('HomeCtrl', function($scope, contatoSrv, $http, apiURL){
   $scope.contatos = [];
   $scope.contato = {};
   // contatoSrv.getAll().then(function(d) { //2. so you can use .then()
   //    $scope.contatos = d.data;
   // });
   // $scope.firstname = "John";
   console.log("teste");

   $http.get(apiURL).then(function(response) {
      $scope.contatos = response.data;
   }, function(err) {
      console.log(err);
   });

   $scope.sendPost = function() {
      $http.post(apiURL, $scope.contato).success(function(data, status) {});
   }
          
   $scope.deleteId = function(id) {
      $http.delete(apiURL+"/"+id, { 'id': id }).success(function(data, status) {});
   }
   
});