const app = document.getElementById("app");

// Funkcija za učitavanje stranice
function loadPage(page) {
  fetch(`./frontend/views/${page}.html`)
    .then(response => {
      if (!response.ok) throw new Error(`Page not found: ${page}`);
      return response.text();
    })
    .then(html => {
      document.getElementById("app").innerHTML = html;
    })
    .catch(err => {
      document.getElementById("app").innerHTML = `<p class="text-center text-danger mt-5">${err.message}</p>`;
    });
}


// Router
function router() {
  const hash = window.location.hash.replace("#", "") || "home";
  loadPage(hash);
}

// Event listeneri
window.addEventListener("hashchange", router);
window.addEventListener("load", router);
