<?php

// Gérer précisément les erreurs et les stocker dans le tableau $erreurs.

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => "Méthode non autorisée."]);
    exit;
}

$champs = ['nom', 'prenom', 'email', 'objet', 'message'];
$donnees = [];
$erreurs = [];

// Parcours de chaque champ du formulaire, puis regarde si ils sont vides ou non
foreach ($champs as $champ) {
    $val = trim($_POST[$champ] ?? '');
    if ($val === '') {
        $erreurs[$champ] = "Le champ $champ est requis.";
    } else {
        $donnees[$champ] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    }
}



if (!empty($donnees['nom'])) {
    if (strlen($donnees['nom']) < 2) {
        $erreurs['nom'] = "Le nom doit contenir au moins 2 caractères.";
    } elseif (!preg_match('/^[a-zA-ZÀ-ÿ\-\'\s]+$/u', $donnees['nom'])) {
        $erreurs['nom'] = "Le nom ne doit contenir que des lettres et espaces.";
    }
}

if (!empty($donnees['prenom'])) {
    if (strlen($donnees['prenom']) < 2) {
        $erreurs['prenom'] = "Le prénom doit contenir au moins 2 caractères.";
    } elseif (!preg_match('/^[a-zA-ZÀ-ÿ\-\'\s]+$/u', $donnees['prenom'])) {
        $erreurs['prenom'] = "Le prénom ne doit contenir que des lettres et espaces.";
    }
}

if (!empty($donnees['email'])) {
    if (!filter_var($donnees['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'adresse email est invalide.";
    }
}

if (!empty($donnees['objet'])) {
    $objets_valides = ['Documents', 'RDV', 'Entreprise', 'Association', 'Autre'];
    if (!in_array($donnees['objet'], $objets_valides)) {
        $erreurs['objet'] = "Objet non valide.";
    }
}

if (!empty($donnees['message'])) {
    if (strlen($donnees['message']) < 10) {
        $erreurs['message'] = "Le message doit contenir au moins 10 caractères.";
    }
}

if (!isset($_POST['cgu'])) {
    $erreurs['cgu'] = "Vous devez accepter les mentions légales.";
}


// En fait vous allez ajouter, ici, des conditions pour chacun des champs
// Exemple : le champ ... contient au moins 3 caractères
// Ca peut se faire via regex
// Le problème des regex, c'est que la validation ou non est globale (on ne peut pas savoir précisément si un manque de majuscule, un nombre trop faible de caractères, etc.)
// Une regex générale c'est une bonne idée.
// Cependant, dans l'idéal il faudrait ensuite procéder aux tests de façon individuelle. (tester la longueur de la chaine indépendament).

// Si le champ email est au format email ou non
if (!filter_var($donnees['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
    $erreurs['email'] = "Email invalide.";
}

// Si le champ CGU n'est pas coché
//if (!isset($_POST['cgu'])) {
  //  $erreurs['cgu'] = "Vous devez accepter les CGU.";
//}

// Si le tableau $erreurs n'est pas vide (il y a eu au moins une erreur)
if (!empty($erreurs)):
    echo json_encode(['success' => false, 'erreurs' => $erreurs]);
    exit;

// Si le tableau $erreurs est vide (c'est qu'il n'y a pas d'erreurs)
else:

    // On renseigne les informations permettant d'envoyer le mail
    $destinataire = "mairie@tracylemont.fr";
    $sujet = "📩 Nouveau message : " . $donnees['objet'];
    $message = "Nom : {$donnees['nom']}\n";
    $message .= "Prénom : {$donnees['prenom']}\n";
    $message .= "Email : {$donnees['email']}\n";
    $message .= "Objet : {$donnees['objet']}\n";
    $message .= "Message :\n{$donnees['message']}\n";

    // On envoie le mail à l'aide de la fonction mail nativement incluse à PHP
    $envoye = mail($destinataire, $sujet, $message);

    // Test si l'envoie a pu s'effectuer
    if ($envoye):
        echo json_encode(['success' => true, 'message' => "Votre message a bien été envoyé ✅"]);
    // Le cas contraire
    else:
        // json_encode permet de convertir un tableau en json (JSON étant la syntaxe de formatage des données appropriée pour transmission à JS).
        echo json_encode(['success' => false, 'message' => "Erreur lors de l’envoi. Réessayez."]);
    endif;
endif;
exit;
?>
