<?php
/* db_npl.php */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "arrogante";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["error" => "Connessione fallita"]);
    exit;
}

$id_column = "codGiocatore";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $playerId = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM giocatori WHERE $id_column = ?");
    $stmt->bind_param("i", $playerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($data = $result->fetch_assoc()) {
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Giocatore non trovato"]);
    }
    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM giocatori");
    $players = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($players);
}

$conn->close();
?>