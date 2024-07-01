<?php
session_start();
require_once 'commandes.php'; 

// Vérifiez si un produit est ajouté au panier
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'ajout' && isset($_POST['nom']) && isset($_POST['quantite']) && isset($_POST['prix'])) {
    $nomProduit = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    
    // Appeler la fonction pour ajouter le produit au panier
    ajouterAuPanier($nomProduit, $quantite, $prix);
}
?>
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            padding-top: 56px; /* Pour compenser la hauteur de la barre de navigation */
        }

        .container {
            margin-top: 20px;
        }

        /* Barre de navigation */
        .navbar {
            position: relative;
        }

        .navbar img {
            max-width: 100%;
        }

        /* Panier */
        .navbar-nav li.nav-item {
            position: relative;
        }

        .navbar-nav li.nav-item .nav-link {
            padding-right: 40px; /* Pour laisser de l'espace pour l'icône du panier */
        }

        .navbar-nav li.nav-item .nav-link img {
            position: absolute;
            top: 5px; /* Ajuster verticalement au centre */
            right: 10px; /* Ajuster horizontalement au centre */
        }

        /* Autres éléments de la barre de navigation */
        .navbar-nav li.nav-item:not(:last-child) {
            margin-right: 20px;
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catégories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($categories as $cat) : ?>
                                <li><a class="dropdown-item" href="categorie.php?id=<?= $cat['id_cat'] ?>"><?= $cat['type_cat'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active"href="inscrit.php" class="btn btn-light">
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
    <h1>Votre Panier</h1>
    <?php if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0) : ?>
        <ul>
            <?php foreach ($_SESSION['panier'] as $key => $produit) : ?>
                <li>
                    <?= $produit['nom'] ?> - <?= $produit['quantite'] ?> - <?= $produit['prix'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <!-- Formulaire de commande en dehors de la boucle -->
        <form action="confirmation_commande.php" method="post">
            <input type="hidden" name="action" value="commande">
            <button type="submit">Commander tous les produits</button>
        </form>
    <?php else : ?>
        <p>Votre panier est vide</p>
    <?php endif; ?>
</div>
</body>
</html>
