let Utils = {

    datatable: function (table_id, columns, data, pageLength = 15) {
        if ($.fn.dataTable.isDataTable("#" + table_id)) {
            $("#" + table_id).DataTable().destroy();
        }

        $("#" + table_id).DataTable({
            data: data,
            columns: columns,
            pageLength: pageLength,
            responsive: true,
            lengthMenu: [5, 10, 15, 25, 50, 100, "All"],
        });
    },


    parseJwt: function (token) {
        if (!token) return null;

        try {
            const base64Url = token.split('.')[1];
            const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            const jsonPayload = decodeURIComponent(
                atob(base64).split('').map(function (c) {
                    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                }).join('')
            );

            return JSON.parse(jsonPayload);

        } catch (e) {
            console.error("Invalid JWT:", e);
            return null;
        }
    },


    getUserData: function () {
        let token = localStorage.getItem("user_token");
        if (!token) return null;

        let payload = Utils.parseJwt(token);
        return payload ? payload.user : null;
    },


    getUserRole: function () {
        let user = Utils.getUserData();
        return user ? user.role : null;
    },

    isAdmin: function () {
        return Utils.getUserRole() === "admin";
    },

    isUser: function () {
        return Utils.getUserRole() === "user";
    },


    checkAuth: function () {
        let token = localStorage.getItem("user_token");
        if (!token) {
            window.location.hash = "login";
            return false;
        }
        return true;
    },


    logout: function () {
        localStorage.removeItem("user_token");
        localStorage.removeItem("user");
        window.location.hash = "login";
    }
};
