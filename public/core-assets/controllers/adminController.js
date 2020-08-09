mainApp.controller('adminController', ['$rootScope','lodash','$scope','$location','$window','$interval','moment','appService',
    function ($rootScope,lodash, $scope, $location, $window, $interval,moment, appService) {

        $scope.model = {};
        $scope.data = {};
        $scope.currentUser = {};
        $scope.newUser = {};
        $scope.error = null;
        $scope.success = null;
        $scope.error1 = null;
        $scope.success1 = null;
        $scope.selectedUser = null;
        $scope.newSection = {};
        $scope.newSectionGroup = {};
        $scope.newItem = {};
        $scope.selectedItem = {}

        $scope.model.getData = function () {
            appService.fetchData('/get-data',
                function (resp) {
                    $scope.currentUser = resp.data.user;
                });
            appService.fetchData('/get-all-data',
                function (resp) {
                    $scope.sectionGroups = resp.data.sectionGroups;
                    $scope.sections = resp.data.sections;
                    $scope.itemGroups = resp.data.itemGroups;
                    $scope.items = resp.data.items;
                    $scope.users = resp.data.users;
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

        // Admin and Users
        $scope.addUser = function(){
            $scope.payload = {
                name: $scope.newUser.name,
                email: $scope.newUser.email,
                phone: $scope.newUser.phone,
                password: $scope.newUser.password,
                role: $scope.newUser.role,
            };
            console.log($scope.payload);
            appService.sendNormalData('/add-user',$scope.payload,
                function (resp) {
                    $('#addUser').modal('hide');
                    $scope.success = resp.data;
                    $scope.newUser ={};
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.showUser = function(user){
            $scope.selectedUser = user;
            $('#showUser').modal('show');
        }

        $scope.updateUser = function(){
            $scope.payload = {
                id: $scope.selectedUser.id,
                name: $scope.selectedUser.name,
                email: $scope.selectedUser.email,
                phone: $scope.selectedUser.phone,
                role: $scope.selectedUser.role,
            };
            console.log($scope.payload);
            appService.sendNormalData('/update-user',$scope.payload,
                function (resp) {
                    $('#showUser').modal('hide');
                    $scope.success = resp.data;
                    $scope.selectedUser ={};
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.deleteUser = function(user){
            $scope.payload = {
                id: user.id,
            };
            console.log($scope.payload);
            appService.sendNormalData('/delete-user',$scope.payload,
                function (resp) {
                    $scope.success = resp.data;
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.addUserPermission = function(user){
            $scope.selectedUser = user;
            $('#addUserPermission').modal('show');
        }

        $scope.grantAccess = function(userId, itemId){
            $scope.payload = {
                user: userId,
                item: itemId,
            };
            console.log($scope.payload);
            appService.sendNormalData('/grant-user-access',$scope.payload,
                function (resp) {
                    $scope.success1 = resp.data;
                }, function(resp){
                    $scope.error1 = resp.data;
                });
        }
        // End admin and user

        $scope.addSection = function(){
            $scope.payload = {
                name: $scope.newSection.name,
                sectionGroup: $scope.newSection.sectionGroup,
                icon_color: $scope.newSection.icon_color,
                icon: $scope.newSection.icon,
            };
            console.log($scope.payload);
            appService.sendNormalData('/add-section',$scope.payload,
                function (resp) {
                    $('#addSection').modal('hide');
                    $scope.success = resp.data;
                    $scope.newSection = {};
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.showSection = function(section){
            $scope.selectedSection = section;
            $('#showSection').modal('show');
        }

        $scope.updateSection = function(){
            $scope.payload = {
                id: $scope.selectedSection.id,
                name: $scope.selectedSection.name,
                section_group_id: $scope.selectedSection.section_group_id,
                icon_color: $scope.selectedSection.icon_color,
                icon: $scope.selectedSection.icon,
            };
            console.log($scope.payload);
            appService.sendNormalData('/update-section',$scope.payload,
                function (resp) {
                    $('#showSection').modal('hide');
                    $scope.success = resp.data;
                    $scope.selectedSection = {};
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.deleteSection = function(section){
            $scope.payload = {
                id: section.id,
            };
            console.log($scope.payload);
            appService.sendNormalData('/delete-section',$scope.payload,
                function (resp) {
                    $scope.success = resp.data;
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        // Start Section Group
        $scope.addSectionGroup = function(){
            $scope.payload = {
                name: $scope.newSectionGroup.name,
                icon_color: $scope.newSectionGroup.icon_color,
                icon: $scope.newSectionGroup.icon,
            };
            console.log($scope.payload);
            appService.sendNormalData('/add-section-group',$scope.payload,
                function (resp) {
                    $('#addSectionGroup').modal('hide');
                    $scope.success = resp.data;
                    $scope.newSectionGroup ={};
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.showSectionGroup = function(sectionGroup){
            $scope.selectedSectionGroup = sectionGroup;
            $('#showSectionGroup').modal('show');
        }

        $scope.updateSectionGroup = function(){
            $scope.payload = {
                id: $scope.selectedSectionGroup.id,
                name: $scope.selectedSectionGroup.name,
                icon_color: $scope.selectedSectionGroup.icon_color,
                icon: $scope.selectedSectionGroup.icon,
            };
            appService.sendNormalData('/update-section-group',$scope.payload,
                function (resp) {
                    $('#showSectionGroup').modal('hide');
                    $scope.success = resp.data;
                    $scope.selectedSectionGroup ={};
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.deleteSectionGroup = function(sectionGroup){
            $scope.payload = {
                id: sectionGroup.id,
            };
            appService.sendNormalData('/delete-section-group',$scope.payload,
                function (resp) {
                    $scope.success = resp.data;
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }
        // End Section Group

        $scope.addItem = function(){
            $scope.payload = {
                name: $scope.newItem.name,
                item_code: $scope.newItem.code,
                icon_color: $scope.newItem.icon_color,
                icon: $scope.newItem.icon,
                sectionGroup: $scope.newItem.sectionGroup,
                section: $scope.newItem.section,
                itemGroup: $scope.newItem.itemGroup,
            };
            console.log($scope.payload);
            appService.sendNormalData('/add-item',$scope.payload,
                function (resp) {
                    $('#addItem').modal('hide');
                    $scope.success = resp.data;
                    $scope.newItem = {};
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.showItem = function(sectionGroup){
            $scope.selectedItem = sectionGroup;
            $('#showItem').modal('show');
        }

        $scope.updateItem = function(){
            $scope.payload = {
                id: $scope.selectedItem.id,
                name: $scope.selectedItem.name,
                item_code: $scope.selectedItem.item_code,
                icon_color: $scope.selectedItem.icon_color,
                icon: $scope.selectedItem.icon,
                section_group_id: $scope.selectedItem.section_group_id,
                section_id: $scope.selectedItem.section_id,
                item_group_id: $scope.selectedItem.item_group_id,
            };
            appService.sendNormalData('/update-item',$scope.payload,
                function (resp) {
                    $('#showItem').modal('hide');
                    $scope.success = resp.data;
                    $scope.selectedItem = {};
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.deleteItem = function(item){
            $scope.payload = {
                id: item.id,
            };
            appService.sendNormalData('/delete-item',$scope.payload,
                function (resp) {
                    $scope.success = resp.data;
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        // Start ItemGroup

        $scope.addItemGroup = function(){
            $scope.payload = {
                name: $scope.newItemGroup.name,
                icon_color: $scope.newItemGroup.icon_color,
                icon: $scope.newItemGroup.icon,
                sectionGroup: $scope.newItemGroup.sectionGroup,
                section: $scope.newItemGroup.section,
            };
            console.log($scope.payload);
            appService.sendNormalData('/add-item-group',$scope.payload,
                function (resp) {
                    $('#addItemGroup').modal('hide');
                    $scope.success = resp.data;
                    $scope.newItemGroup = {};
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.showItemGroup = function(sectionGroup){
            $scope.selectedItemGroup = sectionGroup;
            $('#showItemGroup').modal('show');
        }

        $scope.updateItemGroup = function(){
            $scope.payload = {
                id: $scope.selectedItemGroup.id,
                name: $scope.selectedItemGroup.name,
                icon_color: $scope.selectedItemGroup.icon_color,
                icon: $scope.selectedItemGroup.icon,
                section_group_id: $scope.selectedItemGroup.section_group_id,
                section_id: $scope.selectedItemGroup.section_id,
            };
            appService.sendNormalData('/update-item-group',$scope.payload,
                function (resp) {
                    $('#showItemGroup').modal('hide');
                    $scope.success = resp.data;
                    $scope.model.getData();
                    $scope.selectedItemGroup = {};
                }, function(resp){
                    $scope.error = resp.data;
                });
        }

        $scope.deleteItemGroup = function(item){
            $scope.payload = {
                id: item.id,
            };
            appService.sendNormalData('/delete-item-group',$scope.payload,
                function (resp) {
                    $scope.success = resp.data;
                    $scope.model.getData();
                }, function(resp){
                    $scope.error = resp.data;
                });
        }
        // End ItemGroup

        $scope.changeSection = function(){
            console.log('New', $scope.newItem.sectionGroup);
        }
        
        $interval( function(){ 
            $scope.success = null; 
            $scope.error = null; 
            $scope.model.getData();
            $scope.error1 = null;
            $scope.success1 = null;
        }, 10000);

    }]);