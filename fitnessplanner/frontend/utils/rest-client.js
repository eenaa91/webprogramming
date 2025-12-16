let RestClient = {

    get: function (url, callback, error_callback) {
        $.ajax({
            url: Constants.PROJECT_BASE_URL + url,
            type: "GET",
            dataType: "json",

            beforeSend: function (xhr) {
                const token = localStorage.getItem("user_token");
                if (token) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                }
            },

            success: function (response) {
                if (callback) callback(response);
            },

            error: function (jqXHR) {
                if (error_callback) error_callback(jqXHR);
                else toastr.error(jqXHR.responseText || "GET request failed");
            }
        });
    },

    request: function (url, method, data, callback, error_callback) {
        $.ajax({
            url: Constants.PROJECT_BASE_URL + url,
            type: method,
            data: data ? JSON.stringify(data) : null,
            contentType: "application/json",
            dataType: "json",

            beforeSend: function (xhr) {
                const token = localStorage.getItem("user_token");
                if (token) {
                    xhr.setRequestHeader("Authorization", "Bearer " + token);
                }
            },

            success: function (response) {
                if (callback) callback(response);
            },

            error: function (jqXHR) {
                if (error_callback) error_callback(jqXHR);
                else toastr.error(jqXHR.responseText || "Request failed");
            }
        });
    },

    post: function (url, data, callback, error_callback) {
        RestClient.request(url, "POST", data, callback, error_callback);
    },

    put: function (url, data, callback, error_callback) {
        RestClient.request(url, "PUT", data, callback, error_callback);
    },

    delete: function (url, callback, error_callback) {
        RestClient.request(url, "DELETE", null, callback, error_callback);
    },

    patch: function (url, data, callback, error_callback) {
        RestClient.request(url, "PATCH", data, callback, error_callback);
    }
};
