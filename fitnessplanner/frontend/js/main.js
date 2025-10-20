const app = document.getElementById("app");

function loadPage(page) {
  fetch(`./frontend/views/${page}.html`)
    .then(response => {
      if (!response.ok) throw new Error(`Page not found: ${page}`);
      return response.text();
    })
    .then(html => {
      document.getElementById("app").innerHTML = html;

      // Aktiviraj JS logiku po stranici
      if (page === "workout") {
        initWorkoutToggles();
      }

      if (page === "nutrition") {
        // ⬇️ Malo kašnjenje da se modal sigurno učita prije aktiviranja listenera
        setTimeout(initNutritionModals, 100);
      }
    })
    .catch(err => {
      document.getElementById("app").innerHTML =
        `<p class="text-center text-danger mt-5">${err.message}</p>`;
    });
}

// Router
function router() {
  const hash = window.location.hash.replace("#", "") || "home";
  loadPage(hash);
}

window.addEventListener("hashchange", router);
window.addEventListener("load", router);

// =======================
// 🏋️ WORKOUT MODAL FUNKCIJE
// =======================
function initWorkoutToggles() {
  const buttons = document.querySelectorAll(".view-btn");
  if (!buttons.length) return;

  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      const plan = btn.dataset.plan;
      showWorkoutDetails(plan);
    });
  });
}

function showWorkoutDetails(plan) {
  const modalTitle = document.getElementById("workoutModalLabel");
  const modalBody = document.getElementById("workoutModalBody");
  const modal = new bootstrap.Modal(document.getElementById("workoutModal"));

  let title = "";
  let content = "";

  if (plan === "strength") {
    title = "💪 Full Body Strength Plan";
    content = `
      <p>This 4-day strength plan builds endurance, flexibility, and power.</p>
      <ul>
        <li>Day 1 – Upper Body Strength</li>
        <li>Day 2 – Lower Body Power</li>
        <li>Day 3 – Core & Conditioning</li>
        <li>Day 4 – Stretch & Mobility</li>
      </ul>
    `;
  } else if (plan === "hiit") {
    title = "🔥 Cardio & HIIT Routine";
    content = `
      <p>Fast-paced cardio and HIIT program to burn calories and boost stamina.</p>
      <ul>
        <li>Day 1 – Sprint Intervals</li>
        <li>Day 2 – Full Body HIIT</li>
        <li>Day 3 – Stretch & Recovery</li>
      </ul>
    `;
  } else if (plan === "upper") {
    title = "🏋️ Upper Body Focus";
    content = `
      <p>Targeted program for building your chest, back, arms, and shoulders.</p>
      <ul>
        <li>Day 1 – Chest & Triceps</li>
        <li>Day 2 – Back & Biceps</li>
        <li>Day 3 – Shoulders</li>
        <li>Day 4 – Arms & Core</li>
        <li>Day 5 – Recovery & Mobility</li>
      </ul>
    `;
  }

  modalTitle.innerHTML = title;
  modalBody.innerHTML = content;
  modal.show();
}

// =======================
// 🍽️ NUTRITION MODAL FUNKCIJE
// =======================
function initNutritionModals() {
  const buttons = document.querySelectorAll(".nutrition-btn");
  if (!buttons.length) return;

  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      const plan = btn.dataset.plan;
      showNutritionDetails(plan);
    });
  });
}

function showNutritionDetails(plan) {
  const modalEl = document.getElementById("nutritionModal");
  if (!modalEl) return; // sigurnosna provjera

  const modalTitle = document.getElementById("nutritionModalLabel");
  const modalBody = document.getElementById("nutritionModalBody");
  const modal = new bootstrap.Modal(modalEl);

  let title = "";
  let content = "";

  if (plan === "protein") {
    title = "🥩 High Protein Plan";
    content = `
      <p>This plan helps build lean muscle and speed up recovery.</p>
      <ul>
        <li>🍳 Breakfast – Omelet with spinach and feta</li>
        <li>🍗 Lunch – Grilled chicken with quinoa and veggies</li>
        <li>🍣 Dinner – Salmon with brown rice and broccoli</li>
        <li>🥜 Snacks – Greek yogurt, almonds, or protein shake</li>
      </ul>
    `;
  } else if (plan === "balanced") {
    title = "🥗 Balanced Diet Plan";
    content = `
      <p>Perfect balance of carbs, protein, and fats for steady energy.</p>
      <ul>
        <li>🥣 Breakfast – Oatmeal with fruits and honey</li>
        <li>🥗 Lunch – Chicken salad with avocado</li>
        <li>🍝 Dinner – Whole-grain pasta with turkey and veggies</li>
        <li>🍎 Snacks – Mixed nuts or fresh fruit</li>
      </ul>
    `;
  } else if (plan === "vegan") {
    title = "🌱 Vegan Energy Plan";
    content = `
      <p>Boost endurance with plant-based nutrition.</p>
      <ul>
        <li>🥑 Breakfast – Smoothie with oats, banana, and almond milk</li>
        <li>🥙 Lunch – Lentil wrap with hummus</li>
        <li>🍛 Dinner – Tofu stir-fry with brown rice</li>
        <li>🥜 Snacks – Nuts, seeds, and protein bars</li>
      </ul>
    `;
  }

  modalTitle.innerHTML = title;
  modalBody.innerHTML = content;
  modal.show();
}
