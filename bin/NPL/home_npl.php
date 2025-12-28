<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>NEO PRODIGY LEAGUE - Home</title>
    <link rel="stylesheet" href="../../css/npl_index_style.css">
</head>
<body>
<header>
    <nav class="navbar glass">
        <div class="nav-left"><ul class="nav-links">
            <li><a href="#players">PLAYERS</a></li>
            <li><a href="#statistics">STATISTICS</a></li>
            <li><a href="#formation">FORMATION</a></li>
        </ul></div>
        <div class="logo">
            <img src="../../source/Logo_NPL.png" alt="Logo" class="logo-img">
        </div>
        <div class="nav-right"><ul class="nav-links">
            <li><a href="#match">MATCH</a></li>
            <li><a href="#calendar">CALENDAR</a></li>
            <li><a href="#scoreboard">SCORE BOARD</a></li>
        </ul></div>
    </nav>
</header>

<main>
    <main>
    <div id="players" class="main-section" data-href="./players.php">
        <h2>Players</h2>
    </div>
    <div id="statistics" class="main-section" data-href="./statistics.php"><h2>Statistics</h2></div>
    <div id="formation" class="main-section" data-href="./formation.php"><h2>Formation</h2></div>
    <div id="match" class="main-section" data-href="./match.php"><h2>Match</h2></div>
    <div id="calendar" class="main-section" data-href="./calendar.php"><h2>Calendar</h2></div>
    <div id="scoreboard" class="main-section" data-href="./scoreboard.php"><h2>Score Board</h2></div>
</main>

<script>
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
});
</script>
</body>
</html>