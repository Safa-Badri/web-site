<?php 
 ob_start(); // Cette ligne est commentée car elle n'est pas utilisée ici
 $article=true;
include_once("header.php");
include_once("main.php");

// Vérification et mise à jour des données si un formulaire POST est soumis
if (!empty($_POST)) {
    $query = "UPDATE article SET description = :desc, prix_unitaire = :pu  WHERE id_article = :id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
        "desc" => $_POST["inputdesc"],
        "pu" => $_POST["inputpu"],
        "id" => $_POST["myid"]

    ]);
    header("Location: articles.php");
    exit();
    ob_end_flush();
}

if (!empty($_GET["id"])) {
    $query = "SELECT * FROM article WHERE id_article = :id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["id" => $_GET["id"]]);
    while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) { 
?>
    <h1 class="mt-5">Modifier un article</h1>
    <form class="row g-3" method="post">
    <input type="hidden" name="myid" value="<?php echo $row['id_article']; ?>"/>

  <div class="col-md-6">
  <label for="floatingTextarea">DESCRIPTION</label>
     <textarea class="form-control"  id="inputdesc" name="inputdesc" required> <?php echo $row['description']; ?></textarea>
</div>
  <div class="col-md-6">
    <label for="inputpu" class="form-label">PRIX UNITAIRE</label>
    <input type="text" class="form-control" id="inputpu" name="inputpu" value="<?php echo $row['prix_unitaire']; ?>" required>
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
</main>
<?php 
include_once ("footer.php");
?>