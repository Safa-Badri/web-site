<?php 
ob_start(); // Démarre la mise en tampon de sortie
$clients = true;
include_once("header.php");
include_once("main.php");

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

ob_end_flush(); // Envoie la sortie tamponnée au navigateur


$count=0;
$query="SELECT id_client FROM client WHERE id_client IN ( SELECT id_client FROM commande WHERE commande.id_client=client.id_client)";
$pdostmt=$pdo->prepare($query);
$pdostmt->execute();
foreach($pdostmt->fetchAll(PDO::FETCH_NUM)as $tabvalues){
    foreach($tabvalues as $tabelements){
        $list[]=$tabelements;
    }
}
?>

<!-- Begin page content -->

    <h1 class="mt-5">Clients</h1>
    <button type="button" class="btn btn-primary" style="float:right;margin-bottom:20px;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
  <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
</svg>
</button>
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
   
    <?php
    $query="select * from client";
    $pdostm=$pdo->prepare($query);
    $pdostm->execute();
    //var-dump($pdostm->fetchAll(PDO::FETCH_ASSOC));
    ?>
    <table id="myTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>TELEPHONE</th>
            <th>ACTION</th>

        </tr>
    </thead>
    <tbody>
    <?php while ($ligne = $pdostm->fetch(PDO::FETCH_ASSOC)) { 
    $count++; // Ensure $count is incremented inside the loop.
?>
<tr>
    <td><?php echo htmlspecialchars($ligne["id_client"]); ?></td>
    <td><?php echo htmlspecialchars($ligne["nom"]); ?></td>
    <td><?php echo htmlspecialchars($ligne["ville"]); ?></td>
    <td><?php echo htmlspecialchars($ligne["telephone"]); ?></td>
    <td>
        <a href="modifclient.php?id=<?php echo $ligne["id_client"]?>" class="btn btn-success">
            <!-- Edit Icon (no action here yet) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
            </svg>
        </a>   
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" <?php if (in_array($ligne["id_client"],$list)){echo "disabled";}?> data-bs-target="#deleteModal<?php echo $count ?>">
            <!-- Delete Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
            </svg>
        </button>
    </td>
</tr> 

<!-- Modal -->
<div class="modal fade" id="deleteModal<?php echo $count ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SUPPRESSION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Voulez vous vraiment supprimer ce client?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="delete.php?id=<?php echo $ligne["id_client"] ?>" class="btn btn-danger">Supprimer</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

    </tbody>
</table>
  </div>
</main>

<?php 
include_once ("footer.php");
?>