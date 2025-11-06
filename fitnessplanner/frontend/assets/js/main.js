$(document).ready(function () {
  var app = $.spapp({
    defaultView: "home",
    templateDir: "./frontend/views/"
  });

  app.route({ view: "home", load: "home.html" });
  app.route({ view: "workout", load: "workout.html" });
  app.route({ view: "nutrition", load: "nutrition.html" });
  app.route({ view: "progress", load: "progress.html" });
  app.route({ view: "profile", load: "profile.html" });
  app.route({ view: "login", load: "login.html" });
  app.route({ view: "register", load: "register.html" });
  app.route({ view: "dashboard", load: "dashboard.html" });

  app.run();
});
