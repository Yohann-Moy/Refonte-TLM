<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => "Méthode non autorisée."]);
    exit;
}

$champs = ['nom', 'prenom', 'email', 'objet', 'message'];
$donnees = [];
$erreurs = [];

foreach ($champs as $champ) {
    $val = trim($_POST[$champ] ?? '');
    if ($val === '') {
        $erreurs[$champ] = "Le champ $champ est requis.";
    } else {
        $donnees[$champ] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    }
}

if (!filter_var($donnees['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
    $erreurs['email'] = "Email invalide.";
}

if (!isset($_POST['cgu'])) {
    $erreurs['cgu'] = "Vous devez accepter les CGU.";
}

if (!empty($erreurs)) {
    echo json_encode(['success' => false, 'erreurs' => $erreurs]);
    exit;
}

// Construction du mail
$destinataire = "mairie@tracylemont.fr";
$sujet = "📩 Nouveau message : " . $donnees['objet'];
$message = "Nom : {$donnees['nom']}\n";
$message .= "Prénom : {$donnees['prenom']}\n";
$message .= "Email : {$donnees['email']}\n";
$message .= "Objet : {$donnees['objet']}\n";
$message .= "Message :\n{$donnees['message']}\n";

// Envoi
$envoye = mail($destinataire, $sujet, $message);

if ($envoye) {
    echo json_encode(['success' => true, 'message' => "Votre message a bien été envoyé ✅"]);
} else {
    echo json_encode(['success' => false, 'message' => "Erreur lors de l’envoi. Réessayez."]);
}
exit;
?>
