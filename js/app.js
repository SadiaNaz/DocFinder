

angular.module("DoctorFind",['ui.router'])
		.config(function ($stateProvider, $urlRouterProvider) {
			$urlRouterProvider.otherwise("/index.html");
			$stateProvider.state('viewDoctors', {
					url: "",
					templateUrl: "templates/FormDisplay.html",
					controller: "DocFindCtrl"
				})
	})
		
	/* 	.factory('Data', function(){
			return {message:"At your service"}
	}) */
			
		.controller('DocFindCtrl',function($scope, $http) {
			$scope.doctors = "";
			$scope.user = {};
			var param = function(data) {
				var returnString = '';
				for (d in data){
					if (data.hasOwnProperty(d))
					   returnString += d + '=' + data[d] + '&';
				}
				
				// Remove last ampersand and return
				alert(returnString.slice( 0, returnString.length - 1 ));
				return returnString.slice( 0, returnString.length - 1 );
			};
			
			$scope.getDoctors = function(user){
				$http({
					method : 'POST',
					url : 'data.php',
					data : param(user), // pass in data as strings
					headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
			  }).success(function(data) {
					$scope.doctors = data;	
					$scope.user = {}; // form fields are emptied with this line
					
					window.localStorage['Doctors'] = JSON.stringify($scope.doctors);
					window.location.href = 'http://localhost/MyDocFinder/search.html';
				 });
				  
				};

		  });
		  
		  


angular.module("DocDisp",['ui.router'])
		.config(function ($stateProvider, $urlRouterProvider) {
			$urlRouterProvider.otherwise("/index.html");
			$stateProvider.state('viewDoctors', {
					url: "",
					templateUrl: "templates/DocDisplay.html",
					controller: "DocDispCtrl"
				})
	})
		
	/* 	.factory('Data', function(){
			return {message:"At your service"}
	}) */
			
		.controller('DocDispCtrl',function($scope) {
			$scope.Doctors = {};
			$scope.init = function() {
				$scope.Doctors = JSON.parse(window.localStorage['Doctors']);
			  };
			  // runs once per controller instantiation
			  $scope.init();
		  
		});
		