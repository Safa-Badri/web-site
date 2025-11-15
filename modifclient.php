<?php 
 ob_start(); // Cette ligne est commentée car elle n'est pas utilisée ici
 $clients = true;

include_once("header.php");
include_once("main.php");

// Vérification et mise à jour des données si un formulaire POST est soumis
if (!empty($_POST)) {
    $query = "UPDATE client SET nom = :nom, ville = :ville, telephone = :tel WHERE id_client = :id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "nom" => $_POST["inputnom"],
        "ville" => $_POST["inputville"],
        "tel" => $_POST["inputtel"],
        "id" => $_POST["myid"]
    ]);
    // Redirection après la mise à jour pour éviter une soumission multiple
    header("Location: clients.php");
    exit();
    ob_end_flush();
}

// Affichage des données si un ID est passé en GET
if (!empty($_GET["id"])) {
    $query = "SELECT * FROM client WHERE id_client = :id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["id" => $_GET["id"]]);

    while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) { 
?>
    <h1 class="mt-5">Modifier un Client</h1>
    <form class="row g-3" method="POST">
        <input type="hidden" name="myid" value="<?php echo $row['id_client']; ?>"/>
        <div class="col-md-6">
            <label for="inputnom" class="form-label">NOM</label>
            <input type="text" class="form-control" id="inputnom" name="inputnom" value="<?php echo $row['nom']; ?>" required>
        </div>
        <div class="col-md-6">
            <label for="inputville" class="form-label">VILLE</label>
            <input type="text" class="form-control" id="inputville" name="inputville" value="<?php echo $row['ville']; ?>" required>
        </div>
        <div class="col-12">
            <label for="inputtel" class="form-label">TELEPHONE</label>
            <input type="text" class="form-control" id="inputtel" name="inputtel" value="<?php echo $row['telephone']; ?>" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">MODIFIER</button>
        </div>
    </form>
<?php 
    }
    $pdostmt->closeCursor();
} /*else {

// Redirection si aucun ID n'est passé
    header("Location: clients.php");
    exit();
}*/
?>
</div>
<?php 
include_once("footer.php");
?>
