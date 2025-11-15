<?php 
ob_start();
$article=true;
include_once ("header.php");
include_once ("main.php");
   
    
    
    if (!empty($_FILES["inputimg"]["size"])&&!empty($_POST["inputdesc"]) && !empty($_POST["inputpu"])&&$_FILES["inputimg"]["size"]<$_POST["MAX-FILE-SIZE"]) {
      // Vérifier si le dossier images existe, sinon le créer
      if (!is_dir("images")) {
          mkdir("images");
      }
  
      // Obtenir l'extension du fichier téléchargé
      $extension = pathinfo($_FILES["inputimg"]["name"], PATHINFO_EXTENSION);
  
      // Vérifier si l'extension est valide
      if (!in_array($extension, ["jpg", "jpeg", "png"])) {
          echo "L'extension que vous avez choisie n'est pas autorisée!";
      } else {
          // Déplacer le fichier téléchargé vers le dossier images
          $uploadPath = "images/" .time()."_". $_FILES["inputimg"]["name"]; // Définir $uploadPath
          $upload = move_uploaded_file($_FILES["inputimg"]["tmp_name"], $uploadPath);
         if($upload){
            $query1 = "INSERT INTO article (description, prix_unitaire) VALUES (:desc, :pu)";
            $pdostm1 = $pdo->prepare($query1);
            $pdostm1->execute([
                "desc" => $_POST["inputdesc"],
                "pu" => $_POST["inputpu"]
            ]);
            $id_article=$pdo->lastInsertId();
            $query2 = "INSERT INTO image (nom_img, chemin_img, taille_img, id_article) VALUES (:nom, :chemin, :taille, :id_article)";
            $pdostm2 = $pdo->prepare($query2);
            $pdostm2->execute([
                "nom" => $_FILES["inputimg"]["name"],
                "chemin" => $uploadPath, // Utiliser $uploadPath ici
                "taille" => $_FILES["inputimg"]["size"],
                "id_article" => $id_article,
            ]);
            $pdostm1->closeCursor();
            $pdostm2->closeCursor();
            header("Location: articles.php");


          }else{"Transfert échoué : " . $_FILES["inputimg"]["error"];}
  
        
      }
  }
  
  
    ob_end_flush();

?>
    <h1 class="mt-5">Ajouter Article</h1>
    <form class="row g-3" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="MAX-FILE-SIZE" value="1000000"/>
  <div class="col-md-6">
  <label for="floatingTextarea">DESCRIPTION</label>

     <textarea class="form-control" placeholder="Mettre la description" id="inputdesc" name="inputdesc" required></textarea>
</div>

 
  <div class="col-md-6">
    <label for="inputpu" class="form-label">PRIX UNITAIRE</label>
    <input type="text" class="form-control" id="inputpu" name="inputpu" required>
  </div>

  
  <div class="col-md-12">
    <label for="inputpu" class="form-label">CHARGER IMAGE</label>
    <input type="file" class="form-control" id="inputimg" name="inputimg" required>
    <p>PNG ,JPEG ,JPG</p>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">AJOUTER</button>
  </div>
</form>

</div>
</main>
<?php 
include_once ("footer.php");
?>