<?php 
ob_start();
$client=true;
include_once ("header.php");
include_once ("main.php");
if (!empty($_POST["inputnom"]) && !empty($_POST["inputville"]) && !empty($_POST["inputtel"])) {
  $query = "INSERT INTO client (nom, ville, telephone) VALUES (:nom, :ville, :telephone)";
  $pdostm = $pdo->prepare($query);
  $pdostm->execute([
      "nom" => $_POST["inputnom"],
      "ville" => $_POST["inputville"],
      "telephone" => $_POST["inputtel"]
  ]);
  $pdostm->closeCursor();

  header("Location: clients.php");
  exit; // Assurez-vous d'arrêter l'exécution après une redirection
}

ob_end_flush();
?>
    

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Client</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="row g-3" method="post">
      <div class="modal-body">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">NOM</label>
    <input type="text" class="form-control" id="inputnom" name="inputnom"required>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">VILLE</label>
    <input type="text" class="form-control" id="inputville" name="inputville" required>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">TELEPHONE</label>
    <input type="text" class="form-control" id="inputtel"  name="inputtel" required>
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">AJOUTER</button>
      </div>
      </form>
    </div>
  </div>
</div>


</div>
</main>
<?php 
include_once ("footer.php");
?>