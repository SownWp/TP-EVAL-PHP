<form action="#" method="post" id="inscription-form">
    <div>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo isset($nom) ? htmlspecialchars($nom) : ''; ?>" required>
    </div>
    <div>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo isset($prenom) ? htmlspecialchars($prenom) : ''; ?>" required>
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>
    </div>
    <div>
        <label for="age">Âge :</label>
        <input type="number" id="age" name="age" min="0" value="<?php echo isset($age) ? htmlspecialchars($age) : ''; ?>" required>
    </div>
    <div>
        <input type="checkbox" id="Caseàcocher" name="Caseàcocher" <?php echo (isset($Caseàcocher) && $Caseàcocher === 'on') ? 'checked' : ''; ?> required>
        <label for="Caseàcocher">J'accepte les conditions générales</label>
    </div>
    <div>
        <button type="submit">S'inscrire</button>
    </div>
</form>

<?php
/*Nom*/
$nomError = '';
$nom = '';

/*Prénom*/
$prenomError = '';
$prenom = '';

/*Email*/
$emailError = '';
$email = '';

/*Age*/
$ageError = '';
$age = '';

/* Case à cocher (Conditions Générales) */
$CaseàcocherError = '';
$Caseàcocher = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nom
    $nom = trim($_POST['nom'] ?? '');
    if ($nom === '') {
        $nomError = "Le nom est requis";
    } elseif (mb_strlen($nom) < 2) {
        $nomError = "Le nom ne peut pas être inférieur à 2 caractères";
    } elseif (mb_strlen($nom) > 50) {
        $nomError = "Le nom ne peut pas dépasser 50 caractères";
    }

    // Prénom
    $prenom = trim($_POST['prenom'] ?? '');
    if ($prenom === '') {
        $prenomError = "Le prénom est requis";
    } elseif (mb_strlen($prenom) < 2) {
        $prenomError = "Le prénom ne peut pas être inférieur à 2 caractères";
    } elseif (mb_strlen($prenom) > 50) {
        $prenomError = "Le prénom ne peut pas dépasser 50 caractères";
    }

    // Email
    $email = trim($_POST['email'] ?? '');
    if ($email === '') {
        $emailError = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "L'email est incorrect";
    }

    // Âge
    $age = trim($_POST['age'] ?? '');
    if ($age === '') {
        $ageError = "L'âge est requis";
    } elseif ($age < 16) {
        $ageError = "Vous devez avoir au moins 16 ans pour vous inscrire";
    }

    // Case à cocher (conditions générales)
    if (isset($_POST['Caseàcocher'])) {
        $Caseàcocher = $_POST['Caseàcocher'];
    } else {
        $CaseàcocherError = "Vous devez accepter les conditions générales pour vous inscrire";
    }
}

// Affichage des erreurs
if (!empty($nomError)) {
    echo '<div style="color:red; font-size:0.95em;">' . htmlspecialchars($nomError) . '</div>';
}
if (!empty($prenomError)) {
    echo '<div style="color:red; font-size:0.95em;">' . htmlspecialchars($prenomError) . '</div>';
}
if (!empty($emailError)) {
    echo '<div style="color:red; font-size:0.95em;">' . htmlspecialchars($emailError) . '</div>';
}
if (!empty($ageError)) {
    echo '<div style="color:red; font-size:0.95em;">' . htmlspecialchars($ageError) . '</div>';
}
if (!empty($CaseàcocherError)) {
    echo '<div style="color:red; font-size:0.95em;">' . htmlspecialchars($CaseàcocherError) . '</div>';
}

/*Étape 3 : Étape 3 : Gestion après validation*/
$successMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        empty($nomError) &&
        empty($prenomError) &&
        empty($emailError) &&
        empty($ageError) &&
        empty($CaseàcocherError)
    ) {
        $successMessage = "<div style='color:green;'>Inscription réussie ! Bienvenue " . htmlspecialchars($prenom) . " " . htmlspecialchars($nom) . "</div>";
        
        $nom = '';
        $prenom = '';
        $email = '';
        $age = '';
        $Caseàcocher = '';
    
    }
    if (!empty($successMessage)) {
        echo $successMessage;
    }
}
?>