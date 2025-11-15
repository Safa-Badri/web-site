<?php 
ob_start();
$index = true;
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

// Affichage des données si un ID est passé en GET
if (!empty($_GET["id"])) {
    $query = "SELECT * FROM commande, ligne_commande , client WHERE commande.id_client=client.id_client and ligne_commande.id_commande = commande.id_commande AND commande.id_commande = :idcmd";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["idcmd" => $_GET["id"]]); // Maintenant, vous avez un paramètre pour 'idcmd'
    $row = $pdostmt->fetch(PDO::FETCH_ASSOC) ;

$query_views="update commande set vues=:views where id_commande=:idcmd";
$objstmt_views=$pdo->prepare($query_views);
$objstmt_views->execute(["idcmd"=>$row["id_commande"],"views"=>$row["vues"]+1]);

$query_views_select = "SELECT * FROM commande WHERE id_commande = :idcmd";
$objstmt_views_select = $pdo->prepare($query_views_select); // Assurez-vous que cette ligne est présente pour initialiser l'objet
$objstmt_views_select->execute(["idcmd" => $row["id_commande"]]);

$row_selected=$objstmt_views_select->fetch(PDO::FETCH_ASSOC);

ob_end_flush();
?>

<h1 class="mt-5">Details Commande</h1>
<div style="float:right;color:blue">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
        </svg>
        <?php echo $row_selected["vues"];?>
</div>
<form class="row g-3" method="">

    <div class="col-md-6">
        <label for="inputidcl" class="form-label">ID CLIENT</label>
        <select class="form-control" id="inputidcl" name="inputidcl" disabled>
            <?php 
            // Boucle pour afficher les options du select
            foreach ($objstmt->fetchAll(PDO::FETCH_NUM) as $tab) {
                foreach ($tab as $elmt) {
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
        <label for="inputqte" class="form-label">NOM</label>
        <input type="text" class="form-control" id="inputnom" name="inputnom" value="<?php echo htmlspecialchars($row['nom']); ?>" disabled>
        </div>
        <div class="col-md-6">
        <label for="inputqte" class="form-label">ADRESSE</label>
        <input type="text" class="form-control" id="inputville" name="inputville" value="<?php echo htmlspecialchars($row['ville']); ?>" disabled>
        </div>
        <div class="col-md-6">
        <label for="inputqte" class="form-label">TELEPHONE</label>
        <input type="text" class="form-control" id="inputtelephone" name="inputtelephone" value="<?php echo htmlspecialchars($row['telephone']); ?>" disabled>
        </div>
    <div class="col-md-6">
        <label for="inputdate" class="form-label">DATE</label>
        <input type="date" class="form-control" id="inputdate" name="inputdate" value="<?php echo htmlspecialchars($row['date']); ?>" disabled>
    </div>
    <div class="col-md-6">
        <label for="inputidarticle" class="form-label">ARTICLE</label>
        <select class="form-control" id="inputidarticle" name="inputidarticle" disabled>
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
        <input type="text" class="form-control" id="inputqte" name="inputqte" value="<?php echo htmlspecialchars($row['quantité']); ?>" disabled>
        </div>
    <div class="col-12">
        <a href="index.php" class="btn btn-primary">FERMER</a>
    </div>
</form>

</div>
</main>
<?php 
    
    $pdostmt->closeCursor();
}
$objstmt->closeCursor();
$objstmt2->closeCursor();
//$mon_objstmt-closeCursor();
$objstmt_views->closeCursor();
$objstmt_views_select->closeCursor();

include_once("footer.php");
?>
