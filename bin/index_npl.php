<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>NPL - Intro</title>
    <link rel="stylesheet" href="../css/npl_index_style.css">
    <style>body, html { overflow: hidden; }</style>
</head>
<body>
    <div class="intro-section" id="intro">
      <h1>Arrogante</h1>
      <p class="subtitle">
        Fame di vittoria, ideali diversi dalla tradizione e convinzione nel dimostrare che le proprie abilità
        necessitano solo di essere capite non migliorate. La sconfitta è come la morte, questo è l'ideale della squadra.    
        Il progetto della Neo Prodigy League presenta il progetto Arrogante.
      </p>
    </div>

    <script>
        const intro = document.getElementById('intro');
        function start() {
            intro.classList.add('slide-up');
            setTimeout(() => { window.location.href = './NPL/home_npl.php'; }, 1200);
        }
        window.addEventListener('wheel', (e) => { if(e.deltaY > 0) start(); });
        document.body.addEventListener('click', start);
    </script>
</body>
</html>