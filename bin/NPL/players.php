<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Players - Arrogante - NPL</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../../css/npl_players_style.css">
</head>
<<body>
<header>
<nav class="navbar glass">
<div class="logo">
<a href="../index_npl.php">
<img src="../../source/Logo_NPL.png" alt="Logo NPL - Torna alla Home" class="logo-img" />
</a>
</div>
</nav>
</header>
<main class="visible">
    <div class="card-container"> <div class="fifa-card-wrapper">
            <img src="../../source/MELNYK.png" alt="404" class="fifa-card-image" data-player-id="5">
        </div>

        <div class="fifa-card-wrapper">
            <img src="../../source/SHEHU.png" alt="404" class="fifa-card-image" data-player-id="10">
        </div>

        </div>

    <div id="playerModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 id="modalPlayerName">Dettagli Giocatore</h2>
            <div id="modalDetails"></div>
        </div>
    </div>
</main>
<script>
    // INDIRIZZO DEL TUO SCRIPT PHP (con percorso corretto)
const API_URL = '../../api/db_npl.php'; 

// 1. Ottieni gli elementi del DOM (invariati)
const playerModal = document.getElementById("playerModal");
const closeButton = document.querySelector(".close-button");
const allCards = document.querySelectorAll(".fifa-card-image"); 

// 2. Funzione ASINCRONA per recuperare i dati e popolare il Modal
async function showPlayerDetails(playerId) {
    // 2a. Chiama l'API PHP passando l'ID come parametro GET
    const response = await fetch(`${API_URL}?id=${playerId}`);
    
    // Controlla se la risposta è OK
    if (!response.ok) {
        console.error('Errore durante il recupero dei dati:', response.statusText);
        return; 
    }
    
    const player = await response.json();

    // Gestione di un eventuale errore restituito dal PHP
    if (player.error) {
        console.error("Errore DB:", player.error);
        alert(`Impossibile caricare i dati: ${player.error}`);
        return;
    }
    
    // ⬇️ MAPPATURA E PULIZIA DEI DATI (Assicurati che i nomi 'player.xxx' siano esatti)
    // Assicurati che 'secondo_nome' esista nel tuo DB, altrimenti lascialo vuoto.
    const playerName = player.nome || ''; 
    const playerSecondName = player.secondo_nome || ''; 
    const playerSurname = player.cognome || ''; 
    const playerNationality = player.nazionalita || 'N/D';
    const playerDateOfBirth = player.data_nascita || 'N/D';
    const playerHeight = player.altezza || 'N/D';
    const playerWeight = player.peso || 'N/D';
    const playerFoot = player.piede_preferito || 'N/D';
    const playerRole = player.ruolo || 'N/D';       
    const playerNumber = player.numero_maglia || 'N/D';  
    
    // Corretta concatenazione del nome completo
    const fullName = `${playerName} ${playerSecondName} ${playerSurname}`.trim().replace(/ +/g, ' ');

    // 2b. POPOLAZIONE CORRETTA DEL MODAL (con i nuovi campi)
    document.getElementById("modalPlayerName").textContent = `Dettagli Giocatore: ${playerSurname}`;
    document.getElementById("modalDetails").innerHTML = `
        <p><strong>Nome:</strong> ${playerName}</p>
        <p><strong>Cognome:</strong> ${playerSurname}</p>
        <p><strong>Data di Nascita:</strong> ${playerDateOfBirth}</p>   
        <p><strong>Nazionalità:</strong> ${playerNationality}</p>
        <p><strong>Altezza:</strong> ${playerHeight} cm</p>
        <p><strong>Peso:</strong> ${playerWeight} kg</p>
    
        <hr style="border: 1px solid rgba(255, 255, 255, 0.1); margin: 15px 0;">

        <p><strong>Piede Preferito:</strong> ${playerFoot}</p>
        <p><strong>Numero Maglia:</strong> ${playerNumber}</p>
        <p><strong>Ruolo:</strong> ${playerRole}</p>

      
    `;

    // 2c. Mostra il modal
    playerModal.style.display = "flex";
}

// 3. Aggiungi Listener di click a TUTTE le carte (invariato)
allCards.forEach(card => {
    card.addEventListener('click', () => {
        const playerId = card.getAttribute('data-player-id');
        showPlayerDetails(playerId);
    });
});

// 4. Listener per chiudere il Modal (invariato)
closeButton.onclick = function() {
    playerModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target === playerModal) {
        playerModal.style.display = "none";
    }
}
</script>

</body>
</html>



