

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $empty = false;         

    $erreurs = [];
    $donnees = [];
    $champs = ['nom', 'prenom', 'email', 'objet', 'message'];

    $regexNom = "/^[a-zA-ZÀ-ÿçÇ\-' ]{2,20}$/u"; 
    $regexMessage = "/^[a-zA-ZÀ-ÿçÇ0-9\s\-\.,!?()'\"éèêëàâäîïôöùûüç]{20,256}$/u";

    foreach ($champs as $champ) {
        $val = trim($_POST[$champ] ?? '');  

        if ($val === '') {
            $empty = true;  
        }

        
        $donnees[$champ] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    }

  
    if (!preg_match($regexNom, $donnees['nom'])) {
        $erreurs[] = " Nom invalide.";
    }

    if (!preg_match($regexNom, $donnees['prenom'])) {
        $erreurs[] = " Prénom invalide.";
    }

    if (!filter_var($donnees['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = " Adresse email invalide.";
    }

    if (empty($donnees['objet'])) {
        $erreurs[] = " Objet non sélectionné.";
    }

    if (!preg_match($regexMessage, $donnees['message'])) {
        $erreurs[] = " Le message doit faire entre 20 et 256 caractères.";
    }

  
    if (!isset($_POST['cgu'])) {
        $erreurs[] = " Vous devez accepter les conditions générales d’utilisation.";
    }

   
    if ($empty) {
        echo "<p style='color:red;'> Tous les champs doivent être remplis.</p>";
    } elseif (!empty($erreurs)) {
        foreach ($erreurs as $e) {
            echo "<p style='color:red;'>$e</p>";
        }
    } else {
        $destinataire = "mairie@tracylemont.fr";  
        $sujet = "📩 Nouveau message : " . $donnees['objet'];
        $contenu = "Nom : {$donnees['nom']}\n";
        $contenu .= "Prénom : {$donnees['prenom']}\n";
        $contenu .= "Email : {$donnees['email']}\n";
        $contenu .= "Objet : {$donnees['objet']}\n\n";
        $contenu .= "Message :\n{$donnees['message']}\n";

    
        wp_mail($destinataire, $sujet, $contenu);

        echo "<p style='color:green;'>✅ Votre message a bien été envoyé !</p>";
    }

} else {
    wp_redirect(home_url());
    exit;
}
?>
