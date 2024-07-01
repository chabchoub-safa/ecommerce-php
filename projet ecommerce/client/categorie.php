<?php
// Inclure le fichier de connexion à la base de données
require_once 'connexion.php';

// Récupérer les catégories depuis la base de données
$categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
?>
<?php 
require_once 'commandes.php';


$id_categorie = $_GET['id'];


$categorie = getCategorieById($id_categorie);


$produitsDeLaCategorie = afficherProduitsParCategorie($id_categorie);
?>




<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="/docs/5.3/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Album example · Bootstrap v5.3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        h1 {
            font-size: 50px;
            color: #333;
            margin-bottom: 2px;
            margin-left: 15px;
            margin-top: 20px;
        }

        .album {
            background: url("backgroundFemme.jpg");
            padding: 20px;
            margin-bottom: 20px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-blend-mode: multiply;
        }

        .col {
            flex-basis: 30%;
            padding: 10px;
            min-width: 200px;
            margin-bottom: 40px;
            margin-top: 80px;
            transition: 0.5s;
            text-align: center;
            box-shadow: 20px 20px 30px #777;
            margin-left: 30px;
            margin-top: 20px;
        }

        .col img {
        }

        .col p {
            font-size: 14px;
        }
        
    </style>
</head>
<body>
<header data-bs-theme="dark">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php" style="float: left;">Home</a>
                    </li>
                    <!-- Liste des catégories récupérées depuis la base de données -->
                    <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

<main>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                
                <?php foreach ($produitsDeLaCategorie as $produit): ?>
   
        <div class="col"> 
            
            <div class="card shadow-sm" >
           
                <img src="<?= $produit['image'] ?>" >
                <div class="card-body">
    <h3><?= substr($produit['nom'], 0, 10); ?></h3>
    <p><?= substr($produit['description'], 0, 100); ?></p>
    <!-- Display product price -->
    <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
            <!-- Bouton Ajouter au panier -->
            <form action="panier.php" method="post">
    <input type="hidden" name="action" value="ajout">
    <input type="hidden" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>">
    <input type="hidden" name="quantite" value="1">
    <input type="hidden" name="prix" value="<?= $produit['prix'] ?>">
    <button type="submit" class="btn btn-primary">Ajouter au panier</button>
</form>
            <!-- Bouton Détails -->
            <form action="product_details.php" method="get">
                <input type="hidden" name="id" value="<?= $produit['id'] ?>">
                <button type="submit" class="btn btn-secondary">Détails</button>
            </form>
        </div>
        <small class="text-body-secondary"><?= $produit['prix'] ?>Dt</small>
    </div>
</div>

            </div>
        </div>
   
<?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
