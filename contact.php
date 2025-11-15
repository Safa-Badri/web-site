<?php 
$contact = true;
include_once("header.php");
include_once("main.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et sécuriser les données du formulaire
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Valider les données
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Votre message a été envoyé avec succès.";
        } else {
            echo "Une erreur est survenue lors de l'envoi de votre message.";
        }
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>

<div class="contact-container">
    <h1>Contact Us</h1>
    <p>If you have any questions or need assistance, feel free to contact us. We're here to help!</p>

    <form action="contact.php" method="post">
        <label for="name">Your name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Your message:</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit">SEND</button>
    </form>

    <div class="contact-info">
        <h2>Nos Coordonnées</h2>
        <p><strong>Adresse :</strong> 123 Rue des Affaires, Suite 100, Ville, Pays</p>
        <p><strong>Téléphone :</strong> (123) 456-7890</p>
        <p><strong>Email :</strong> support@votresite.com</p>
    </div>
</div>
<style>
    /* Style général */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.contact-container {
    width: 80%;
    margin: 50px auto;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

p {
    text-align: center;
    color: #666;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 20px;
}

label {
    font-weight: bold;
    color: #333;
}

input, textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    width: 100%;
}

input:focus, textarea:focus {
    border-color: #007BFF;
    outline: none;
}

button {
    padding: 10px;
    background-color: #7386ee;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    width: 100%;
}

button:hover {
    background-color: #0056b3;
}

.contact-info {
    margin-top: 30px;
    text-align: center;
}

.contact-info h2 {
    color: #333;
}

.contact-info p {
    color: #666;
}
</style>
</div>
<?php 
include_once("footer.php");
?>
