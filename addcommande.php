<?php 
ob_start();
$commande = true;
include_once("header.php");
include_once("main.php");

// Requête pour récupérer les id_client
$query = "SELECT id_client FROM client";
$objstmt = $pdo->prepare($query);
$objstmt->execute();

// Requête pour récupérer les id_client
$query2= "SELECT id_article FROM article";
$objstmt2 = $pdo->prepare($query2);
$objstmt2->execute();

// Vérification de la soumission du formulaire
if (!empty($_POST["inputqte"]) && !empty($_POST["inputdate"])) {
    // Requête pour insérer la commande
    $query = "INSERT INTO commande (id_client, date) VALUES (:idcl, :date)";
    $pdostm = $pdo->prepare($query);
    
    // Exécution de la requête d'insertion
    $pdostm->execute([
        "idcl" => $_POST["inputidcl"],
        "date" => $_POST["inputdate"],
    ]);
$idcmd=$pdo->lastInsertId();    
    // Redirection vers la page commandes
     // Requête pour insérer la commande
     $query2 = "INSERT INTO ligne_commande (id_article,id_commande,quantité) VALUES (:idart, :idcmd, :idqte)";
     $pdostm = $pdo->prepare($query2);
     
     // Exécution de la requête d'insertion
     $pdostm->execute([
         "idart" => $_POST["inputidarticle"],
         "idcmd" => $idcmd,
         "idqte" => $_POST["inputqte"], // Corrected from 'idqte' to 'inputqte'
        ]);
     $pdostm->closeCursor();
     
     // Redirection vers la page commandes
     header("Location: commandes.php");
    exit();
}

ob_end_flush();
?>

<h1 class="mt-5">Ajouter Commande</h1>
<form class="row g-3" method="post">
    <div class="col-md-6">
        <label for="inputidcl" class="form-label">ID CLIENT</label>
        <select class="form-control" id="inputidcl" name="inputidcl" required>
            <?php 
            // Boucle pour afficher les options du select
            foreach ($objstmt->fetchAll(PDO::FETCH_NUM) as $tab) {
                foreach ($tab as $elmt) {
                    // Sécurisation des données avec htmlspecialchars
                    echo "<option value='" . htmlspecialchars($elmt) . "'>" . htmlspecialchars($elmt) . "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="inputdate" class="form-label">DATE</label>
        <input type="date" class="form-control" id="inputdate" name="inputdate" required>
    </div>
    <div class="col-md-6">
        <label for="inputidarticle" class="form-label">ARTICLE</label>
        <select class="form-control" id="inputidarticle" name="inputidarticle" required>
            <?php 
            // Boucle pour afficher les options du select
            foreach ($objstmt2->fetchAll(PDO::FETCH_NUM) as $tab) {
                foreach ($tab as $elmt) {
                    // Sécurisation des données avec htmlspecialchars
                    echo "<option value='" . htmlspecialchars($elmt) . "'>" . htmlspecialchars($elmt) . "</option>";
                }
            }
            ?>
        </select>  
      </div>
    <div class="col-md-6">
        <label for="inputqte" class="form-label">QUANTITE</label>
        <input type="text" class="form-control" id="inputqte" name="inputqte" required>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">AJOUTER</button>
    </div>
</form>

</div>
</main>

<?php 
include_once("footer.php");
?>
