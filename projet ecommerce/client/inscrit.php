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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <style>
        /* Ajoutez vos styles personnalisés ici */
        body {
            background: linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%), url("background.jpg") no-repeat;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-blend-mode: multiply;
            font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;
        }

        .custom-form {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        .custom-form h4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .custom-form label {
            font-weight: bold;
        }

        .custom-form input[type="text"],
        .custom-form input[type="password"],
        .custom-form select {
            width: 100%;
            height: 40px;
            margin-bottom: 20px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .custom-form input[type="date"] {
            width: 100%;
            height: 40px;
            margin-bottom: 20px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .custom-form input[type="submit"] {
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background-color: #007bff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            color: #fff;
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
                            <?php foreach ($categories as $categorie) : ?>
                                <li><a class="dropdown-item" href="categorie.php?id=<?= $categorie['id_cat'] ?>"><?= $categorie['type_cat'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="inscrit.php" class="btn btn-light">
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
<div class="container py-2">
    <?php
    $erreur = ""; // Variable pour stocker les messages d'erreur

    if(isset($_POST['ajout'])){     /* POST, les données du formulaire sont envoyées au serveur */
        $login           = $_POST['login'];
        $pwd             = $_POST['password']; // assuming password field name
        $nom             = $_POST['nom'];
        $prenom          = $_POST['prenom'];
        $num             = $_POST['num'];
        $gender          = $_POST['gender'];
        $address         = $_POST['address'];
        $date_naissance  = $_POST['date_naissance'];

        // Vérifier si tous les champs obligatoires sont remplis
        if(empty($login) || empty($pwd) || empty($nom) || empty($prenom) || empty($num) || empty($gender) || empty($address) || empty($date_naissance)) { 
            $erreur = "Tous les champs sont obligatoires.";
        } else {
            require_once 'connexion.php'; // Inclure le fichier database.php pour établir la connexion à la base de données
            $date_creation = date('Y-m-d');
            $sqlState = $pdo->prepare('INSERT INTO utilisateur (login, password, date_creation, nom, prenom, numero, address, date_naissance, gender) VALUES (?,?,?,?,?,?,?,?,?)');
            $sqlState->execute([$login, $pwd, $date_creation, $nom, $prenom, $num, $address, $date_naissance, $gender]);
            
            header('location:login.php');
        }
    }
    if(!empty($erreur)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $erreur; ?>
            </div>
    <?php endif; ?>
    <div class="custom-form">
        <h4>Inscription</h4>
        <form method="post" action="login.php">
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom">
            </div>

            <label class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom">

            <label class="form-label">Numéro</label>
            <input type="text" class="form-control" name="num">

            <label class="form-label">Genre</label>
            <select class="form-select" name="gender">
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
               
                <option value="autre">Autre</option>
            </select>

            <label class="form-label">Adresse</label>
            <input type="text" class="form-control" name="address">

            <label class="form-label">Date de naissance</label>
            <input type="date" class="form-control" name="date_naissance">

            <label class="form-label">Login</label>
            <input type="text" class="form-control" name="login">

            <label class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password">
            <input type="submit" value="Inscription" class="btn btn-primary my-2" name="ajout">  
        </form>
    </div>
</body>
</html>