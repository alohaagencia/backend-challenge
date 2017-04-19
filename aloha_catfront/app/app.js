var app = angular.module('app',['ngRoute'])

app.config(function($routeProvider, $locationProvider)
{
    // $qProvider.errorOnUnhandledRejections(false);
   // remove o # da url
   $locationProvider.html5Mode(false);

   $routeProvider

   // para a rota '/', carregaremos o template home.html e o controller 'HomeCtrl'
   .when('/', {
      templateUrl : 'app/views/home.html',
      controller     : 'HomeCtrl',
   })


   // caso não seja nenhum desses, redirecione para a rota '/'
   .otherwise ({ redirectTo: '/' });
})

app.value('apiURL', 'http://127.0.0.1/aloha_catalogo/public/api/list');
app.value('myThing', 'weee');