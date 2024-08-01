<?php
header("Content-Type: application/json");

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votre_base_de_donnees";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données JSON envoyées
$data = json_decode(file_get_contents('php://input'), true);

$matricule = $data['matricule'];
$password = $data['password'];

// Préparation et exécution de la requête SQL
$sql = "SELECT * FROM agent WHERE matricule = ? AND mot_de_passe = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $matricule, $password);
$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result->num_rows > 0) {
    // L'authentification est correcte
    $response['status'] = 'correct';
    $response['message'] = 'Connexion réussie.';
} else {
    // L'authentification est incorrecte
    $response['status'] = 'incorrect';
    $response['message'] = 'Matricule ou mot de passe incorrect.';
}

// Envoi de la réponse JSON
echo json_encode($response);

// Fermeture de la connexion
$conn->close();
?>
