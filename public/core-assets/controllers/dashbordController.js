mainApp.controller('profileController', ['$rootScope','lodash','$scope','$location','$window','$interval','moment','appService',
    function ($rootScope,lodash, $scope, $location, $window, $interval,moment, appService) {

        $scope.model = {};
        $scope.currentUser = {};
        $error = null;
        $success = null;

        $scope.model.getData = function () {
            appService.fetchData('/get-data',
                function (resp) {
                    $scope.currentUser = resp.data.user;
                });
        }; 
        $scope.model.getData();

        $scope.updateProfile = function(){
            $scope.payload = {
                name: $scope.currentUser.name,
                email: $scope.currentUser.email,
                phone: $scope.currentUser.phone,
            };
            
            appService.sendNormalData('/update-profile',$scope.payload,
                function (resp) {
                    if(resp.data.success == true){
                        $scope.success = "Profile update successfully!";
                    }else{
                        $scope.error = "Sorry an error occurred!";
                    }
                });
        }
        $interval( function(){ 
            $scope.success = null; 
            $scope.error = null; 
        }, 5000);

    }]);
mainApp.controller('dashbordController', ['$rootScope','lodash','$scope','$location','$window','$interval','moment','appService',
    function ($rootScope,lodash, $scope, $location, $window, $interval,moment, appService) {

        $scope.model = {};
        $scope.currentUser = {};

        $scope.model.getData = function () {
            appService.fetchData('/get-data',
                function (resp) {
                    $scope.currentUser = resp.data.user;
                });
        }; 
        $scope.model.getData();

        $scope.updateProfile = function(){
            $scope.payload = {
                name: $scope.currentUser.name,
                email: $scope.currentUser.email,
                phone: $scope.currentUser.phone,
            };
            
            appService.sendNormalData('/update-profile',$scope.payload,
                function (resp) {
                    console.log(resp.data);
                });
        }

        
        $interval( function(){ $scope.model.getData(); }, 5000);

    }]);

mainApp.controller('sectionsController', ['$rootScope','lodash','$scope','$location','$window','$interval','moment','appService',
    function ($rootScope,lodash, $scope, $location, $window, $interval,moment, appService) {

        $scope.model = {};
        $scope.sectionGroup = {};
        $scope.currentSectionGroup = {};
        $scope.currentUser = {};
        $scope.currentSectionGroup = angular.element('#sectionGroup').val();

        $scope.model.getData = function () {
            appService.fetchData('/get-data',
                function (resp) {
                    $scope.currentUser = resp.data.user;
                });
            appService.fetchData('/get-sections/'+$scope.currentSectionGroup,
                function (resp) {
                    $scope.sectionGroup = resp.data.group;
                    console.log($scope.sectionGroup)
                });
        }; 
        $scope.model.getData();

        $interval( function(){ $scope.model.getData(); }, 5000);


    }]);

mainApp.controller('sectionController', ['$rootScope','lodash','$scope','$location','$window','$interval','moment','appService',
    function ($rootScope,lodash, $scope, $location, $window, $interval,moment, appService) {

        $scope.model = {};
        $scope.sectionGroup = {};
        $scope.currentSectionGroup = {};
        $scope.currentUser = {};
        $scope.currentSectionGroup = angular.element('#sectionGroup').val();
        $scope.currentSection = angular.element('#section').val();

        $scope.model.getData = function () {
            appService.fetchData('/get-data',
                function (resp) {
                    $scope.currentUser = resp.data.user;
                });
            appService.fetchData('/get-section/'+$scope.currentSectionGroup+'/'+$scope.currentSection,
                function (resp) {
                    $scope.section = resp.data.section;
                    console.log($scope.sectionGroup)
                });
        }; 
        $scope.model.getData();

        $interval( function(){ $scope.model.getData(); }, 5000);


    }]);

mainApp.controller('itemsController', ['$rootScope','lodash','$scope','$location','$window','$interval','moment','appService',
    function ($rootScope,lodash, $scope, $location, $window, $interval,moment, appService) {

        $scope.model = {};
        $scope.sectionGroup = {};
        $scope.currentSectionGroup = {};
        $scope.currentUser = {};
        $scope.currentSectionGroup = angular.element('#sectionGroup').val();
        $scope.currentSection = angular.element('#section').val();
        $scope.currentItemGroup = angular.element('#itemGroup').val();

        $scope.model.getData = function () {
            appService.fetchData('/get-data',
                function (resp) {
                    $scope.currentUser = resp.data.user;
                });
            appService.fetchData('/get-items/'+$scope.currentSectionGroup+'/'+$scope.currentSection+'/'+$scope.currentItemGroup,
                function (resp) {
                    $scope.section = resp.data.section;
                    console.log($scope.sectionGroup)
                });
        }; 
        $scope.model.getData();

        $scope.toggle = function (item){
            appService.fetchData('/change-item-state/'+item.id,
                function (resp) {
                    item.status = resp.data.item.status;

                    console.log(item);
                });
        }
        
        $interval( function(){ $scope.model.getData(); }, 5000);

    }]);