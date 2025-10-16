window.addEventListener('scroll', () => {
    const intro = document.querySelector('.intro-section');
    const main = document.querySelector('main');

    if (window.scrollY > 10) {
        intro.classList.add('slide-up');
        main.classList.add('visible');

        window.scrollTo({ top: 0, behavior: 'smooth' }); // scrolla in cima alla pagina in modo fluido
    }
});
//*scroll not scrolling e scroll up