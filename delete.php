<?php
include_once ("main.php");


if (!empty($_GET["id"])) {
    $idclient = $_GET["id"];

    $query = "DELETE FROM client WHERE id_client =:id";

    $objstmt = $pdo->prepare($query);

    $objstmt->bindParam(':id', $idclient, PDO::PARAM_INT);

    $objstmt->execute();

    $objstmt->closeCursor();

    header("Location: clients.php");
    exit;
}

if (!empty($_GET["idarticle"])) {
    $idarticle = $_GET["idarticle"];

    $query = "DELETE FROM article WHERE id_article = :idarticle";
    $objstmt = $pdo->prepare($query);

   
    $objstmt->bindParam(':idarticle', $idarticle, PDO::PARAM_INT);

    if ($objstmt->execute()) {
        header("Location: articles.php"); 
        exit;
    } else {
        echo "Une erreur est survenue lors de la suppression de l'article.";
    }

    $objstmt->closeCursor();
}


/*
if (!empty($_GET["idcommande"])) {
    $idclient = $_GET["idcommande"];

    $query = "DELETE FROM commande WHERE id_commande =:idcommande";

    $objstmt = $pdo->prepare($query);

    $objstmt->bindParam(':idcommande', $idclient, PDO::PARAM_INT);

    $objstmt->execute();

    $objstmt->closeCursor();

    header("Location: commandes.php");
    exit;
}

if (!empty($_GET["idcmd"])) {
    $query = "DELETE FROM ligne_commande WHERE id_commande =:id";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["id"=>$_GET["idcmd"]]);
    $objstmt->closeCursor();
    $query2 = "DELETE FROM commande WHERE id_commande =:id";
    $objstmt2 = $pdo->prepare($query2);
    $objstmt2->execute(["id" => $_GET["idcmd"]]);
    $objstmt2->closeCursor();

    header("Location: commandes.php");
    exit;
}*/


// Check if 'idcmd' is passed in the URL
if (!empty($_GET["idcmd"])) {
    $idcmd = $_GET["idcmd"];

    // Delete related ligne_commande entries first
    $query = "DELETE FROM ligne_commande WHERE id_commande = :idcmd";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute(["idcmd" => $idcmd]); // Corrected "id" to "idcmd"
    $objstmt->closeCursor();

    // Now delete the associated commande
    $query2 = "DELETE FROM commande WHERE id_commande = :idcmd";
    $objstmt2 = $pdo->prepare($query2);
    $objstmt2->execute(["idcmd" => $idcmd]); // Corrected "id" to "idcmd"
    $objstmt2->closeCursor();

    // Redirect to commandes.php
    header("Location: commandes.php");
    exit;
}

?>




