<?php 
$index = true;
include_once("header.php");
include_once("main.php");

// Requête pour récupérer les données
$query = "SELECT c.nom, c.telephone, c.ville, cmd.date, art.description, art.prix_unitaire, lc.quantité, cmd.id_commande 
          FROM client c
          JOIN commande cmd ON c.id_client = cmd.id_client
          JOIN ligne_commande lc ON cmd.id_commande = lc.id_commande
          JOIN article art ON art.id_article = lc.id_article";


// Préparation et exécution de la requête
$pdostmt = $pdo->prepare($query);
$pdostmt->execute();
?>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Accueil</h1>
    <table id="datatable" class="display">
      <thead> <!-- Correction ici de 'thread' à 'thead' -->
        <tr>
          <th></th>
          <th> NOM</th>
          <th> TELEPHONE</th>
          <th> VILLE</th>
          <th> DATE</th>
          <th> DESCRIPTION</th>
          <th> PRIX UNITAIRE</th>
          <th> QUANTITE</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($ligne = $pdostmt->fetch(PDO::FETCH_ASSOC)) { ?>
          <tr>
          <td>
          <a href="details.php?id=<?php echo isset($ligne['id_commande']) ? $ligne['id_commande'] : ''; ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
        </svg>
    </a>
</td>


            <td><?php echo htmlspecialchars($ligne["nom"]); ?></td>
            <td><?php echo htmlspecialchars($ligne["telephone"]); ?></td>
            <td><?php echo htmlspecialchars($ligne["ville"]); ?></td>
            <td><?php echo htmlspecialchars($ligne["date"]); ?></td>
            <td><?php echo htmlspecialchars($ligne["description"]); ?></td>
            <td><?php echo htmlspecialchars($ligne["prix_unitaire"]); ?></td>
            <td><?php echo htmlspecialchars($ligne["quantité"]); ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  </div>

</main>
<?php 
$pdostmt->closeCursor();
include_once("footer.php");
?>
