/* npl_script.js */

document.addEventListener('click', function (e) {
    // Cerca se l'elemento cliccato o uno dei suoi genitori è la nostra .main-section
    const section = e.target.closest('.main-section');
    
    if (section) {
        const url = section.getAttribute('data-href');
        console.log("Click rilevato su:", section.id, "URL:", url);
        
        if (url) {
            // Testiamo il reindirizzamento forzato
            window.location.assign(url);
        }
    }
});

// Gestione Scroll Up per tornare alla Intro
window.addEventListener('wheel', (e) => {
    if (window.scrollY <= 0 && e.deltaY < 0) {
        window.location.href = '../index_npl.php';
    }


    // Gestione Scroll Up per tornare alla Intro
    window.addEventListener('wheel', (e) => {
        if (window.scrollY <= 0 && e.deltaY < 0) {
            console.log("Scroll up rilevato, ritorno a index_npl.php");
            window.location.href = '../index_npl.php';
        }
    });
});
