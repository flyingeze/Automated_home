mainApp.controller('newFeedController', ['$rootScope','lodash','$scope','$location','$window','$timeout','moment','appService',
    function ($rootScope,lodash, $scope, $location, $window, $timeout,moment, appService) {

        $scope.model = {};
        $scope.model.sendingFeed = false;
        $scope.model.newFeed = {};

        //==================== Update Status ==================//
        $scope.model.updateStatus = function () {
            $scope.model.sendingFeed = true;
            console.log($scope.model.newFeed);
            appService.sendNormalData('/user-update-status',$scope.model.newFeed,
            function (resp) {
                $scope.model.newFeed = {};
                $('#post-modal').modal('hide');
                $scope.model.sendingFeed = false;

                $rootScope.$emit("refreshFeed", {});
            });
        };

    }]);