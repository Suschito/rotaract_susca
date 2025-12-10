document.addEventListener("DOMContentLoaded", () => {
  // We wrap EVERYTHING inside here to ensure HTML exists before we select it.

  // ==========================================
  // 1. COUNTER ANIMATION
  // ==========================================
  const counters = document.querySelectorAll(".counter");
  const statsSection = document.querySelector(".stats-section");
  const speed = 200; // Lower number = Faster animation

  const animateCounters = () => {
    counters.forEach(counter => {
      const updateCount = () => {
        // Get the target number from the HTML attribute
        const target = +counter.getAttribute("data-target");
        
        // Get the current number displayed (strip symbols if any)
        const count = +counter.innerText.replace(/\D/g, ''); 
        
        // Calculate the jump size
        const increment = target / speed;

        if (count < target) {
          counter.innerText = Math.ceil(count + increment);
          setTimeout(updateCount, 20);
        } else {
          // Animation Complete
          counter.innerText = target;
          
          // Re-add the "+" logic specifically for Service/Associations
          // We check the "P" tag below the counter
          const label = counter.nextElementSibling ? counter.nextElementSibling.innerText.toUpperCase() : '';
          
          if (label.includes("SOCI") || label.includes("ASSOCIAZIONI")) {
             counter.innerText += "+";
          }
        }
      };
      updateCount();
    });
  };

  // Intersection Observer: Only runs animation when you scroll to it
  if (statsSection) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounters();
          observer.disconnect(); // Disconnect so it runs only once
        }
      });
    }, { threshold: 0.1 }); // Trigger when 10% of the section is visible
    
    observer.observe(statsSection);
  }

  // ==========================================
  // 2. NAVBAR ACTIVE LINK
  // ==========================================
  const links = document.querySelectorAll(".top-nav a");
  const currentPage = window.location.pathname.split("/").pop();

  links.forEach(link => {
    const linkPage = link.getAttribute("href").split("/").pop();
    if (linkPage === currentPage || (linkPage === "index.html" && currentPage === "")) {
      link.classList.add("active");
    }
  });

  // ==========================================
  // 3. CONTACT FORM
  // ==========================================
  const contactForm = document.getElementById('contactForm');

  if (contactForm) {
    contactForm.addEventListener('submit', function(event) {
      event.preventDefault();

      const nome = document.getElementById('name').value;
      const cognome = document.getElementById('surname').value;
      const email = document.getElementById('email').value;
      const messaggio = document.getElementById('message').value;
      const emailDestinatario = "rac.trento@rotaract2060.it";
      const oggetto = "Contatto da " + nome + " " + cognome;

      const corpoMessaggio = "Ciao, vi ho contattato dal sito\n\n" +
        "Nome: " + nome + "\n" +
        "Cognome: " + cognome + "\n" +
        "Email utente: " + email + "\n\n" +
        "Messaggio:\n" +
        messaggio;

      window.location.href = "mailto:" + emailDestinatario +
        "?subject=" + encodeURIComponent(oggetto) +
        "&body=" + encodeURIComponent(corpoMessaggio);
    });
  }
});