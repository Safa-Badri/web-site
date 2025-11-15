<?php 
$articles=true;
include_once ("header.php");
include_once ("main.php");
$count=0;
$query="SELECT id_article FROM article WHERE id_article IN ( SELECT id_article FROM ligne_commande WHERE ligne_commande.id_article=article.id_article)";
$pdostmt=$pdo->prepare($query);
$pdostmt->execute();
foreach($pdostmt->fetchAll(PDO::FETCH_NUM)as $tabvalues){
    foreach($tabvalues as $tabelements){
        $list[]=$tabelements;
    }
}
?>

<section class="gallery-page">
        <div class="container">
            <h2>Recently Added products</h2>
            <div class="row justify-content-center">
                <div class="col-md-12 col-12">
                    <div class="row">
                        <a src="images/22jpeg.jpeg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-6 col-md-4 box-1">
                          <img src="images/22jpeg.jpeg" class="img-fluid">
                            
                        </a>
                        <a src="images/11.png" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-3 col-md-4 box-2">
                         <img src="images/11.png" class="img-fluid">
                           
                        </a>
                        <a src="images/12.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-3 col-md-4 box-2">
                         <img src="images/12.jpg" class="img-fluid">
                           
                        </a>
                    </div>
                    <div class="row">
                        <a src="images/13.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-3 col-md-4 box-2">
                          <img src="images/13.jpg" class="img-fluid">
                            
                        </a>
                        <a src="images/14.jpeg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-3 col-md-4 box-2">
                         <img src="images/14.jpeg" class="img-fluid">
                           
                        </a>
                        <a src="images/15.jpeg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-6 col-md-4 box-1">
                         <img src="images/15.jpeg" class="img-fluid">
                           
                        </a>
                    </div>
                    <div class="row">
                        <a src="images/16.jpeg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-6 col-md-4 box-1">
                          <img src="images/16.jpeg" class="img-fluid">
                            
                        </a>
                        <a src="images/17.jpeg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-3 col-md-4 box-2">
                         <img src="images/17.jpeg" class="img-fluid">
                           
                        </a>
                        <a src="images/18.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-3 col-md-4 box-2">
                         <img src="images/18.jpg" class="img-fluid">
                          
                        </a>
                    </div>
                    <div class="row">
                        <a src="images/19.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-3 col-md-4 box-2">
                          <img src="images/19.jpg" class="img-fluid">
                            
                        </a>
                        <a src="images/20.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-3 col-md-4 box-2">
                         <img src="images/20.jpg" class="img-fluid">
                          
                        </a>
                        <a src="images/21.jpg" data-toggle="lightbox" data-gallery="example-gallery" class="col-xl-6 col-md-4 box-1">
                         <img src="images/21.jpg" class="img-fluid">
                           
                        </a>
                    </div>
                </div>
            </div>
           
        </div>
    </section>
<!-- Begin page content -->

    <h1 class="mt-5">Articles</h1>
    <a href="addarticle.php" class="btn btn-primary" style="float:right;margin-bottom:20px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0"/>
</svg>
</a>
    <?php
    $query="select * from article";
    $pdostm=$pdo->prepare($query);
    $pdostm->execute();
    //var-dump($pdostm->fetchAll(PDO::FETCH_ASSOC));
    ?>
    <table id="myTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>DESCRIPTION</th>
            <th>PRIX_UNITAIRE</th>
            <th>ACTION</th>

        </tr>
    </thead>
    <tbody>
    <?php while ($ligne = $pdostm->fetch(PDO::FETCH_ASSOC)) { 
    $count++; // Ensure $count is incremented inside the loop.
?>
<tr>
    <td><?php echo htmlspecialchars($ligne["id_article"]); ?></td>
    <td><?php echo htmlspecialchars($ligne["description"]); ?></td>
    <td><?php echo htmlspecialchars($ligne["prix_unitaire"]); ?></td>
    <td>
        <a href="modifarticle.php?id=<?php echo $ligne["id_article"]?>" class="btn btn-success">
            <!-- Edit Icon (no action here yet) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
            </svg>
        </a>   
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" <?php if (in_array($ligne["id_article"],$list)){echo "disabled";}?> data-bs-target="#deleteModal<?php echo $count ?>">
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
                Voulez vous vraiment supprimer cet article?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <a href="delete.php?idarticle=<?php echo $ligne["id_article"] ?>" class="btn btn-danger">Supprimer</a>
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