<?php

require_once 'connexion.php';


$categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
?>
<?php 
require_once 'commandes.php';

$id_categorie = $_GET['id'];


$categorie = getCategorieById($id_categorie);

$produitsDeLaCategorie = afficherProduitsParCategorie($id_categorie);
?>
<?php
require_once 'commandes.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch product details based on ID
    $produit = afficherUnProduit($id);
    
    // Check if product exists
    if(!$produit) {
        echo "Product not found.";
        exit;
    }
    
    // Assuming $produit is an object containing product details
    $produit = $produit[0];
 
    if(isset($_POST['add_to_cart'])) {
        ajouterAuPanier($produit->nom, 1, $produit->prix, $produit->image, $produit->description, $produit->id_cat);
        echo "Product added to cart.";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        /* Styles CSS ici */
    </style>
</head>
<body>
<header data-bs-theme="dark">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php" style="float: left;">Home</a>
                    </li>
                    <!-- Liste des catégories récupérées depuis la base de données -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catégories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($categories as $categorie) : ?>
                                <li><a class="dropdown-item" href="categorie.php?id=<?= $categorie['id_cat'] ?>"><?= $categorie['type_cat'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a href="inscrit.php" class="btn btn-light">
                            <img src="logo.png" alt="Logo" class="mr-2" style="height: 24px; right: 0px;"> Connexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Autres éléments de la barre de navigation -->
                <li class="nav-item">
                    <a class="nav-link" href="panier.php">
                        <img src="panier.png" alt="Panier" style="width: 30px; height: 30px;">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
    <div class="container">
        
        <h1>Product Details</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <img src="<?= $produit->image ?>" alt="<?= $produit->nom ?>" class="bd-placeholder-img card-img-top" width="100%" height="400">
                    <div class="card-body">
                        <h2><?= $produit->nom ?></h2>
                        <p class="card-text"><?= $produit->description ?></p>
                        <p class="card-text">Prix: <?= $produit->prix ?>Dt</p>
                        <!-- Formulaire d'ajout au panier -->
                        <form method="post" action="panier.php">
                            <input type="submit" name="add_to_cart" value="Ajouter au panier" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inclure les fichiers JavaScript de Bootstrap si nécessaire -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</body>
</html>

