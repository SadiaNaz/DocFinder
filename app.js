

angular.module("DoctorFind",['ui.router'])
		.config(function ($stateProvider, $urlRouterProvider) {
			$urlRouterProvider.otherwise("/index.html");
			$stateProvider.state('viewDoctors', {
					url: "",
					templateUrl: "FormDisplay.html",
					controller: "DocFindCtrl"
				})
	})
		
	/* 	.factory('Data', function(){
			return {message:"At your service"}
	}) */
			
		.controller('DocFindCtrl',function($scope, $http) {
			$scope.doctors = "";
			$scope.user = {};
			
			$scope.init = function() {
					window.localStorage.removeItem('Doctors');
					window.localStorage.removeItem('Name');
			  };
			  // runs once per controller instantiation
			  $scope.init();
			  
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
			
			$scope.getDoctors = function(user,option){
				if (option == 1){
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
				}
				
				else if (option == 2){
					
					$http({
					method : 'POST',
					url : 'dataSpeciality.php',
					data : param(user), // pass in data as strings
					headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
			  }).success(function(data) {
					$scope.doctors = data;	
					$scope.user = {}; // form fields are emptied with this line
					
					window.localStorage['Doctors'] = JSON.stringify($scope.doctors);
					window.location.href = 'http://localhost/MyDocFinder/search.html';
				 });
					
				}
				
				
								else if (option == 3){
					
					$http({
					method : 'POST',
					url : 'dataTime.php',
					data : param(user), // pass in data as strings
					headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
			  }).success(function(data) {
					$scope.doctors = data;	
					$scope.user = {}; // form fields are emptied with this line
					
					window.localStorage['Doctors'] = JSON.stringify($scope.doctors);
					window.location.href = 'http://localhost/MyDocFinder/search.html';
				 });
					
				}
				};
				
				
			$scope.getDoctorsBySpec = function(user){
				$http({
					method : 'POST',
					url : 'dataSpeciality.php',
					data : param(user), // pass in data as strings
					headers : { 'Content-Type': 'application/x-www-form-urlencoded' } // set the headers so angular passing info as form data (not request payload)
			  }).success(function(data) {
					$scope.doctors = data;	
					$scope.user = {}; // form fields are emptied with this line
					
					//window.localStorage['Doctors'] = JSON.stringify($scope.doctors);
					window.location.href = 'http://localhost/MyDocFinder/search.html';
				 });
				  
				};
				
				

		  });
		  
		  


angular.module("DocDisp",['ui.router'])
		.config(function ($stateProvider, $urlRouterProvider) {
			$urlRouterProvider.otherwise("/index.html");
			$stateProvider.state('viewDoctors', {
					url: "",
					templateUrl: "DocDisplay.html",
					controller: "DocDispCtrl"
				})
	})
		
	/* 	.factory('Data', function(){
			return {message:"At your service"}
	}) */
			
		.controller('DocDispCtrl',function($scope) {
			$scope.Doctors = {};
			$scope.name = "fergr";
			$scope.init = function() {
				$scope.Doctors = JSON.parse(window.localStorage['Doctors']);
			  };
			  // runs once per controller instantiation
			  $scope.init();
			  
			  $scope.doctor = {};
			
			$scope.getDoctor = function(name){
				
					window.localStorage['Name'] = JSON.stringify(name);
					window.location.href = 'http://localhost/MyDocFinder/pro.html';
				
				  
				};
		  
		});
		
		
angular.module("DocProf",['ui.router'])
		.config(function ($stateProvider, $urlRouterProvider) {
			$urlRouterProvider.otherwise("/index.html");
			$stateProvider.state('viewDoctors', {
					url: "",
					templateUrl: "DocProfile.html",
					controller: "DocProfileCtrl"
				})
	})
		
	/* 	.factory('Data', function(){
			return {message:"At your service"}
	}) */
			
		.controller('DocProfileCtrl',function($scope) {
			$scope.Doctors = {};
			$scope.Doctor = {};
			$scope.init = function() {
				$scope.Doctors = JSON.parse(window.localStorage['Doctors']);
				$scope.Doctor = JSON.parse(window.localStorage['Name']);
			  };
			  // runs once per controller instantiation
			  $scope.init();
			  
		  
		});
		