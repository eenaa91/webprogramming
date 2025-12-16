$(document).ready(function () {

    var app = $.spapp({
        defaultView: "home",
        templateDir: "views/"
    });

    app.route({ view: "home", load: "home.html" });
    app.route({ view: "workout", load: "workout.html" });
    app.route({ view: "nutrition", load: "nutrition.html" });
    app.route({ view: "progress", load: "progress.html" });
    app.route({ view: "profile", load: "profile.html" });
    app.route({ view: "login", load: "login.html" });
    app.route({ view: "register", load: "register.html" });
    app.route({ view: "dashboard", load: "dashboard.html" });

    app.route({ view: "admin-mealplans", load: "admin_mealplans.html" });
    app.route({ view: "admin-workouts", load: "admin_workouts.html" });
    app.route({ view: "admin-users", load: "admin_users.html" });

    app.run();
});


const API_URL = "http://localhost/EnaJasarevic/webprogramming/fitnessplanner/backend/";

async function api(path, method = "GET", data = null, auth = false) {

    const headers = { "Content-Type": "application/json" };

    if (auth) {
        const token = localStorage.getItem("user_token");
        if (token) headers["Authorization"] = "Bearer " + token; 
    }

    const res = await fetch(API_URL + path, {
        method,
        headers,
        body: data ? JSON.stringify(data) : null
    });

    return res.json();
}
