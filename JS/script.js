document.addEventListener("DOMContentLoaded", () => {

  // ===== NAVBAR ACTIVE LINK =====
  const links = document.querySelectorAll(".top-nav a");
  const currentPage = window.location.pathname.split("/").pop(); 

  links.forEach(link => {
      const linkPage = link.getAttribute("href").split("/").pop();

      // Correzione per la Home Page che ha un link 'index.html' ma spesso la pagina è solo '/'
      if (linkPage === currentPage || (linkPage === "index.html" && currentPage === "")) {
          link.classList.add("active");
      }
  });

  // ===== COUNTER ANIMATION (Selettiva per il "+") =====
  const counters = document.querySelectorAll(".counter");
  const speed = 130; // smaller = faster

  
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
                  // Ottiene l'elemento P successivo per verificare il contenuto
                  const label = counter.nextElementSibling ? counter.nextElementSibling.innerText.toUpperCase() : '';

                  let displayText = target;

                  // Aggiunge il "+" solo ai contatori di Service
                  if (label.includes("SERVICE") || label.includes("ASSOCIAZIONI")) {
                      displayText += "+";
                  }
                  
                  counter.innerText = displayText;
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

  // ===== CONTACT FORM HANDLING (Nuova integrazione) =====
  const contactForm = document.getElementById('contactForm');

  // Il codice dentro l'if viene eseguito solo se siamo nella pagina contatti
  if (contactForm) {
      contactForm.addEventListener('submit', function(event) {
          event.preventDefault(); // Blocca l'invio standard del form

          // Recupera i valori dai campi
          const nome = document.getElementById('name').value;
          const cognome = document.getElementById('surname').value;
          const email = document.getElementById('email').value;
          const messaggio = document.getElementById('message').value;

          // Indirizzo destinazione
          const emailDestinatario = "rac.trento@rotaract2060.it";
          
          // Crea l'oggetto della mail
          const oggetto = "Contatto da " + nome + " " + cognome;

          // Crea il corpo del messaggio
          const corpoMessaggio = "Ciao, vi ho contattato dal sito\n\n" +
                                 "Nome: " + nome + "\n" +
                                 "Cognome: " + cognome + "\n" +
                                 "Email utente: " + email + "\n\n" +
                                 "Messaggio:\n" +
                                 messaggio;

          // Crea il link mailto e reindirizza
          window.location.href = "mailto:" + emailDestinatario + 
                                 "?subject=" + encodeURIComponent(oggetto) + 
                                 "&body=" + encodeURIComponent(corpoMessaggio);
      });
  }

});