// ===== NAVBAR ACTIVE LINK =====
document.addEventListener("DOMContentLoaded", () => {

  const links = document.querySelectorAll(".top-nav a");
  const currentPage = window.location.pathname.split("/").pop(); 

  links.forEach(link => {
      const linkPage = link.getAttribute("href").split("/").pop();

      if (linkPage === currentPage) {
          link.classList.add("active");
      }
  });

  // ===== COUNTER ANIMATION =====
  const counters = document.querySelectorAll(".counter");
  const speed = 125; // smaller = faster

  const animateCounters = () => {
      counters.forEach(counter => {
          const updateCount = () => {
              const target = +counter.getAttribute("data-target");
              const count = +counter.innerText;
              const increment = target / speed;

              if (count < target) {
                  counter.innerText = Math.ceil(count + increment);
                  setTimeout(updateCount, 20);
              } else {
                  counter.innerText = target;
              }
          };
          updateCount();
      });
  };

  // Animate when visible on screen
  const statsSection = document.querySelector(".stats-section");

  if (statsSection) {  // evita errori sulle pagine senza counter
      const observer = new IntersectionObserver(entries => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  animateCounters();
                  observer.disconnect(); // run once
              }
          });
      });

      observer.observe(statsSection);
  }

});
