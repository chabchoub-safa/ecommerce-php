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
    <title>Confirmer commande</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@700&display=swap');

        body {
            height: 100vh;
            margin: 0;
            background-color: #353535;
            font-family: 'Josefin Sans', Arial, sans-serif;
            overflow-x: hidden;
            display: grid;
            place-items: center;
        }

        a {
            text-decoration: none;
            color: #9ca0b1;
        }

        .wrapper {
            text-align: center;
        }

        .wrapper h1 {
            color: #fff;
            font-size: 92px;
            text-transform: uppercase;
            font-weight: 700;
            font-family: 'Josefin Sans', sans-serif;
            background: linear-gradient(to right, #095fab 10%, #25abe8 50%, #57d75b 60%);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            animation: textclip 1.5s linear infinite;
            display: inline-block;
        }

        @keyframes textclip {
            to {
                background-position: 200% center;
            }
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

    <div class="wrapper">
        <h1>Commande validée</h1>
    </div>
</body>
</html>
