

angular.module("app",['ui.router'])
		.config(function ($stateProvider, $urlRouterProvider) {
			$urlRouterProvider.otherwise("/index.html");
			$stateProvider.state('viewDoctors', {
					url: "",
					templateUrl: "first.html",
					controller: "firstCtrl as first"
				})
	})
		
		.factory('Data', function(){
			return {message:"At your service"}
	})
			
		.controller("firstCtrl", function firstCtrl($scope,Data){
			$scope.data = Data;
			$scope.reversedMessage = function(message){
				return message.split("").reverse().join("");
			}
	})