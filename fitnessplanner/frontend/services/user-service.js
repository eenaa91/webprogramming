var UserService = {

    init: function () {

        if (localStorage.getItem("user_token")) {
            window.location.hash = "dashboard";
            return;
        }

        $("#login-form").validate({
            submitHandler: function (form) {
                let entity = Object.fromEntries(new FormData(form).entries());
                UserService.login(entity);
            }
        });
    },


    login: function (entity) {

        RestClient.post("auth/login", entity,
            function (result) {
                localStorage.setItem("user_token", result.data.token);

                localStorage.setItem("user", JSON.stringify(result.data));

                window.location.hash = "dashboard";
            },

            function (xhr) {
                toastr.error(xhr?.responseJSON?.error || "Login failed");
            }
        );
    },


    register: function (entity) {

        RestClient.post("auth/register", entity,
            function (result) {
                toastr.success("Registration successful! Please log in.");
                window.location.hash = "login";
            },

            function (xhr) {
                toastr.error(xhr?.responseJSON?.error || "Registration failed");
            }
        );
    },


    logout: function () {
        localStorage.removeItem("user_token");
        localStorage.removeItem("user");
        window.location.hash = "login";
    },


    generateMenuItems: function () {

        let token = localStorage.getItem("user_token");

        if (!token) {
            window.location.hash = "login";
            return;
        }

        let user = Utils.getUserData(); 

        let nav = `
            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#workout">Workouts</a></li>
            <li class="nav-item"><a class="nav-link" href="#nutrition">Nutrition</a></li>
            <li class="nav-item"><a class="nav-link" href="#progress">Progress</a></li>
            <li class="nav-item"><a class="nav-link" href="#profile">Profile</a></li>
        `;

        if (user.role === Constants.ADMIN_ROLE) {
            nav += `
                <li class="nav-item"><a class="nav-link" href="#users">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="#dashboard">Admin Dashboard</a></li>
            `;
        }

        nav += `
            <li class="nav-item">
                <button class="btn btn-danger ms-3" onclick="UserService.logout()">Logout</button>
            </li>
        `;

        $("#navbarNav ul").html(nav);
    }

};
