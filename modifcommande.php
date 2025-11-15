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
    $query = "UPDATE commande SET id_client=:idcl,date=:date where id_commande=:idcmd";
    $pdostm = $pdo->prepare($query);
    
    // Exécution de la requête d'insertion
    $pdostm->execute([
        "idcl" => $_POST["inputidcl"],
        "date" => $_POST["inputdate"],
        "idcmd" => $_POST["cmd_id"],

    ]);
    // Redirection vers la page commandes
     // Requête pour insérer la commande
     $query2 = "UPDATE ligne_commande SET id_article=:idart, quantité=:quant WHERE id_commande=:idcmd";
     $pdostm = $pdo->prepare($query2);
     
     // Exécution de la requête avec les paramètres appropriés
     $pdostm->execute([
         "idart" => $_POST["inputidarticle"],
         "idcmd" => $_POST["cmd_id"],
         "quant" => $_POST["inputqte"]  // Assurez-vous d'utiliser le bon nom de paramètre
     ]);
     
     $pdostm->closeCursor();
     
     
     // Redirection vers la page commandes
     header("Location: commandes.php");
    exit();
}
// Affichage des données si un ID est passé en GET
if (!empty($_GET["id"])) {
    $query = "SELECT * FROM commande, ligne_commande WHERE ligne_commande.id_commande = commande.id_commande AND commande.id_commande = :idcmd";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["idcmd" => $_GET["id"]]); // Maintenant, vous avez un paramètre pour 'idcmd'
    

    $row = $pdostmt->fetch(PDO::FETCH_ASSOC) ;


ob_end_flush();
?>

<h1 class="mt-5">Modifier Commande</h1>
<form class="row g-3" method="post">
<input type="hidden" name="cmd_id" value="<?php echo $_GET['id']; ?>"/>

    <div class="col-md-6">
        <label for="inputidcl" class="form-label">ID CLIENT</label>
        <select class="form-control" id="inputidcl" name="inputidcl" required>
            <?php 
            // Boucle pour afficher les options du select
            foreach ($objstmt->fetchAll(PDO::FETCH_NUM) as $tab) {
                foreach ($tab as $elmt)  {
                    // Sécurisation des données avec htmlspecialchars
                   // echo "<option value='" . htmlspecialchars($elmt) . "'>" . htmlspecialchars($elmt) . "</option>";
                   if($elmt==$row["id_client"]){
                    $selected="selected";
                   }else{
                    $selected="";
                   }
                   echo "<option value=".$elmt." ".$selected.">".$elmt."</option>  "    ;  
                   }
            }
            ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="inputdate" class="form-label">DATE</label>
        <input type="date" class="form-control" id="inputdate" name="inputdate" value="<?php echo htmlspecialchars($row['date']); ?>" required>
    </div>
    <div class="col-md-6">
        <label for="inputidarticle" class="form-label">ARTICLE</label>
        <select class="form-control" id="inputidarticle" name="inputidarticle" required>
            <?php 
            // Boucle pour afficher les options du select
            foreach ($objstmt2->fetchAll(PDO::FETCH_NUM) as $tab) {
                foreach ($tab as $elmt) {

               if($elmt==$row["id_article"]){
                $selected="selected";
               }else{
                $selected="";
               }
               echo "<option value=".$elmt." ".$selected.">".$elmt."</option>  "    ;  
               }}
            ?>
        </select>  
      </div>
    <div class="col-md-6">
        <label for="inputqte" class="form-label">QUANTITE</label>
        <input type="text" class="form-control" id="inputqte" name="inputqte" value="<?php echo htmlspecialchars($row['quantité']); ?>"  required>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">AJOUTER</button>
    </div>
</form>

</div>
</main>
<?php 
    
    $pdostmt->closeCursor();
}
include_once("footer.php");
?>
