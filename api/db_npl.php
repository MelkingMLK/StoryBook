<?php

$servername = "localhost";
$username = "root"; // es. root
$password = "root";     // es. password_del_db
$dbname = "arrogante"; // es. npl_players_db


$table_name = "giocatori";
$id_column = "codGiocatore"; 
$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die(json_encode(["error" => "Connessione fallita: " . $conn->connect_error]));
}

// 2. Prepara la risposta JSON (header)
header('Content-Type: application/json');
// Permette richieste da origini diverse (utile in fase di sviluppo)
header('Access-Control-Allow-Origin: *'); 

// 3. Prendi l'ID del giocatore inviato dal JavaScript
// Se l'ID è presente nella richiesta GET (es. ?id=1)
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $playerId = $_GET['id'];
    
    // Query SQL sicura con prepared statement
    $stmt = $conn->prepare("SELECT * FROM $table_name WHERE $id_column = ?");
    $stmt->bind_param("i", $playerId); // "i" sta per integer (numero intero)
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Estrai il dato come array associativo
        $data = $result->fetch_assoc();
        echo json_encode($data); // Restituisce i dati del singolo giocatore
    } else {
        echo json_encode(["error" => "Giocatore non trovato con ID: " . $playerId]);
    }
    
    $stmt->close();

} else {
    // Se nessun ID è specificato, restituisce tutti i giocatori (opzionale, ma utile)
    $sql = "SELECT * FROM $table_name";
    $result = $conn->query($sql);
    
    $allPlayers = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Usa l'ID del giocatore come chiave
            $allPlayers[$row[$id_column]] = $row; 
        }
    }
    echo json_encode($allPlayers); // Restituisce tutti i giocatori (utile per JS)
}

$conn->close();
?>