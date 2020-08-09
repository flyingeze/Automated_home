mainApp.factory('appService', ['$http','$location', '$window', function($http, $location, $window){

    /////////////////////////////////////////////
    //START

    function alert($message, $type) {
        return new Toast({message : $message, type: $type});
    }
    
    function fetchData(url, onSuccess, onError) {
        $http.get(url
        ).then(function (response) {
            //console.log
            if (response.data && response.data.success) {
                onSuccess(response);
            }
            else {
                onError(response);
            }

        }, function (response) {

            onError(response);

        });
    }

    function offLoad(url) {
        return window.open(url, "_blank");
    }

    function sendImageData(url, data, onSuccess, onError) {
        $http.post(url, data,
            {
                headers: { 'Content-Type': undefined},
                //prevents serializing payload.  don't do it.
                transformRequest: angular.identity
            }
        ).then(function (response) {
            //console.log
            if (response.data && response.data.success) {
                onSuccess(response);
            }
            else {
                onError(response);
            }

        }, function (response) {

            onError(response);

        });
    }

    function sendNormalData(url, data, onSuccess, onError) {
        $http.post(url, data
        ).then(function (response) {
            //console.log
            if (response.data && response.data.success) {
                onSuccess(response);
            }
            else {
                onError(response);
            }

        }, function (response) {

            onError(response);

        });
    }

    function uploadBanner(url, data, onSuccess, onError) {

        var formData = new FormData();

        formData.append('link', data.link);
        formData.append('banner', data.image);

        $http.post(url, formData,
            {
                headers: { 'Content-Type': undefined},
                //prevents serializing payload.  don't do it.
                transformRequest: angular.identity
            }
        ).then(function (response) {
            //console.log
            if (response.data && response.data.success) {
                onSuccess(response);
            }
            else {
                onError(response);
            }

        }, function (response) {

            onError(response);

        });
    }

    function addStudentAccount(dt, url, onSuccess, onError) {
        var formData = new FormData();
        //append form data
        formData.append('name', dt.name);
        formData.append('email', dt.email);
        formData.append('phone', dt.phone);
        formData.append('password', dt.password);
        formData.append('institution', dt.institution);
        formData.append('avatar', dt.avatar);
        formData.append('careerPath', dt.careerPath.name);

        if (dt.address){
            formData.append('address', dt.address);
        }

        $http.post(url,formData,
            {
                headers: { 'Content-Type': undefined},
                //prevents serializing payload.  don't do it.
                transformRequest: angular.identity
            }
        ).then(function (response) {
            //console.log
            if (response.data && response.data.success) {
                onSuccess(response);
            }
            else {
                onError(response);
            }

        }, function (response) {

            onError(response);

        });
    }

    function updateDataSvr(url, onSuccess, onError) {
        $http.get(url
        ).then(function (response) {
            //console.log
            if (response.data && response.data.success) {
                onSuccess(response);
            }
            else {
                onError(response);
            }

        }, function (response) {

            onError(response);

        });
    }


    return {
        alert : alert,
        offLoad : offLoad,
        fetchData : fetchData,
        uploadBanner : uploadBanner,
        sendNormalData : sendNormalData,
        sendImageData : sendImageData,
        addStudentAccount : addStudentAccount,
        updateDataSvr : updateDataSvr,
    };
}]);
