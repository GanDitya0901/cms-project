document.addEventListener("DOMContentLoaded", () => {
  const menuItems = document.querySelectorAll(".menu-item[data-page]");
  const mainContent = document.getElementById("main-content");

  menuItems.forEach(item => {
    item.addEventListener("click", (e) => {
      e.preventDefault();
      
      menuItems.forEach(i => i.classList.remove("active"));
      item.classList.add("active");

      const page = item.getAttribute("data-page");
      mainContent.innerHTML = "<p>Loading...</p>";

      fetch(`${BASE_URL}/partials/${page}-list.php`)

        .then(res => {
          if (!res.ok) throw new Error(`HTTP error! Status: ${res.status}`);
          return res.text();
        })
        .then(data => mainContent.innerHTML = data)
        .catch(err => {
          mainContent.innerHTML = "<p>Error loading content.</p>";
          console.error(err);
        });
    });
  });
});
