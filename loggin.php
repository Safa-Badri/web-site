<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "gestioncommandes";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}

// Retrieve cookies if they exist
$cookie_username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$cookie_password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
$cookie_remember_me = isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Vérification des informations dans la base de données
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user'] = $user;

            // If "Remember me" is checked
            if (isset($_POST['remember_me'])) {
                setcookie('username', $username, time() + (7 * 24 * 60 * 60), '/', '', false, true); // Expire in 1 week
                setcookie('password', $password, time() + (7 * 24 * 60 * 60), '/', '', false, true);
                setcookie('remember_me', '1', time() + (7 * 24 * 60 * 60), '/', '', false, true);
            } else {
                // Clear cookies if "Remember me" is unchecked
                setcookie('username', '', time() - 3600, '/');
                setcookie('password', '', time() - 3600, '/');
                setcookie('remember_me', '', time() - 3600, '/');
            }

            // Redirect to the next page after successful login
            header("Location: accueil.php");
            exit;
        } else {
            $_SESSION['error'] = "Identifiant ou mot de passe invalide.";
        }
    } else {
        $_SESSION['error'] = "Veuillez remplir tous les champs.";
    }
}

// Display error or success messages
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
    background: url('images/3.jpeg') no-repeat center center fixed;
    background-size: cover;
    color: #fff; /* Texte blanc */
}
.welcome-message-container {
            background-color: #000; /* Fond noir */
            color: #fff; /* Texte blanc */
            padding: 20px; /* Espacement autour du texte */
            text-align: center;
            font-size: 24px; /* Taille de texte plus grande */
            font-weight: bold;
            border-radius: 5px 5px 0 0; /* Coins arrondis en haut */
            margin-bottom: 30px; /* Espacement en bas */
        }


        .login-form {
            background: #000;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            margin: 100px auto;
            text-align: center;
        }

        .login-form h2 {
            color: #ffffff;
            margin-bottom: 30px;
        }

        .form-control {
            background-color: #34495e;
            color: #ffffff;
            border: 1px solid #34495e;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .form-control::placeholder {
            color: #bdc3c7;
        }

        .form-control:focus {
            background-color: #2c3e50;
            border-color: #7386ee;
            box-shadow: 0 0 10px rgba(22, 160, 133, 0.6);
        }

        .btn-primary {
            background-color: #7386ee;
            border: none;
            padding: 15px;
            font-size: 18px;
            width: 100%;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #7386ee;
            transform: scale(1.05);
        }

        .form-check-label {
            color: #ecf0f1;
            font-size: 14px;
        }

        .login-form a {
            color: #7386ee;
            text-decoration: none;
        }

        .login-form a:hover {
            text-decoration: underline;
        }

        .clearfix {
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="welcome-message-container">
Welcome to your Order Management dashboard! Please log in to access your control panel.
</div>
    <div class="login-form">

        <form action="index.php" method="post">
            <h2>Connexion</h2>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required="required" value="<?php echo htmlspecialchars($cookie_username); ?>">
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" value="<?php echo htmlspecialchars($cookie_password); ?>">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>

            <div class="clearfix">
                <label class="float-left form-check-label">
                    <input type="checkbox" value="1" name="remember_me" <?php echo $cookie_remember_me ? 'checked' : ''; ?>> Se souvenir de moi
                </label>
            </div>
        </form>
    </div>
</body>
</html>
