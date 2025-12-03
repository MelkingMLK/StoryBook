const intro = document.querySelector('.intro-section');
const main = document.querySelector('main');
let introHidden = false;
let isAnimating = false;

// --- GESTIONE SCROLL (Animazione Intro/Main) ---

window.addEventListener('scroll', () => {
  const scrollY = window.scrollY;

  if (isAnimating) return; // Evita conflitti tra animazioni

  // --- ENTRATA NEL MAIN (Scroll Down da 0) ---
  if (scrollY > 10 && !introHidden) {
    isAnimating = true;

    // 1. Iniziamo l'animazione di uscita dell'intro
    intro.classList.add('slide-up');
    intro.classList.remove('slide-down');

    // 2. Blocchiamo lo scroll e rendiamo visibile il main
    document.body.style.overflow = 'hidden';
    main.classList.add('visible');
    main.classList.remove('hidden');
    
    window.scrollTo({ top: 1, behavior: 'smooth' });

    setTimeout(() => {
      // 3. Al termine dell'animazione: nascondiamo l'intro in modo definitivo
      intro.style.display = 'none';
      intro.style.position = 'static';
      
      // 4. Sblocchiamo lo scroll
      document.body.style.overflow = 'auto';
      introHidden = true;
      isAnimating = false;
    }, 1500);
  }

  // --- RITORNO ALL'INTRO (Scroll UP arrivato a 0) ---
  else if (scrollY === 0 && introHidden) {
    isAnimating = true;

    // 1. Prima di farla rientrare, la riattiviamo subito fuori schermo
    intro.style.display = 'flex'; 
    intro.style.position = 'fixed'; 
    
    // 2. Blocchiamo lo scroll
    document.body.style.overflow = 'hidden';

    // 3. Avviamo l'animazione di discesa (slide-down)
    setTimeout(() => {
        intro.classList.remove('slide-up');
        intro.classList.add('slide-down');
    }, 50); 

    // 4. Iniziamo l'animazione di uscita del main
    main.classList.add('slide-back-up');
    main.classList.remove('visible');
    main.classList.add('hidden');
    
    // 5. Cleanup dopo l'animazione
    setTimeout(() => {
      main.classList.remove('slide-back-up');
      
      // Quando l'animazione è finita, possiamo sbloccare lo scroll
      document.body.style.overflow = 'auto'; 
      introHidden = false;
      isAnimating = false;
    }, 1500); 
  }
});



document.addEventListener('DOMContentLoaded', () => {
    if (window.scrollY > 0) {
        introHidden = true;
        intro.style.display = 'none';
        intro.style.position = 'static';
        main.classList.add('visible');
        main.classList.remove('hidden');
        document.body.style.overflow = 'auto';
    } else {
        intro.style.display = 'flex';
        intro.style.position = 'fixed';
        main.classList.remove('visible');
        main.classList.add('hidden');
    }
});


const mainSections = document.querySelectorAll('.main-section');
let isRedirecting = false;

mainSections.forEach(section => {
    section.addEventListener('click', function() {
        const targetUrl = this.getAttribute('data-href');
        
        // Verifica la bandiera di reindirizzamento
        if (isRedirecting || !targetUrl) {
            return;
        }

        isRedirecting = true;
        
        // 1. Avviamo l'animazione di uscita sul main
        main.classList.add('slide-back-up'); 
        
        // 2. Blocchiamo lo scroll per garantire che l'animazione sia visibile
        document.body.style.overflow = 'hidden'; 
        
        // 3. Reindirizziamo l'utente dopo la durata dell'animazione
        setTimeout(() => {
            window.location.href = targetUrl;
        }, 1200); // 1200ms è la durata della tua animazione CSS
    });
});