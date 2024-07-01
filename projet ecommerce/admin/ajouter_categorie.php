<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"
      type="text/css">
<link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
<style>
    /* Style du formulaire */
form {
    max-width: 400px;
    margin: 100px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    
}

/* Style des étiquettes */
.form-label {
    font-weight: bold;
}

/* Style des champs de saisie */
.form-control {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

/* Style du bouton */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Style des messages d'alerte */
.alert {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 4px;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
}

</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="../">Administration</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link" aria-current="page" href="../admin/afficher.php">Produits</a>
        </li>
        <li class="nav-item">
          <a  class="nav-link"aria-current="page" href="../admin/ajout.php">Nouveau</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="supprimer.php">Suppression</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="liste_categorie.php">liste_catergorie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="font-weight: bold;"  class="nav-link" href="ajouter_categorie.php">ajouter_categorie</a>
        </li>
      </ul>
      <div style="margin-right: 500px">
        <h5 style="color: #545659; opacity: 0.5;">Connecté en tant que: <?= $nom ?></h5>
      </div>
      
      <a class="btn btn-danger d-flex" style="display: flex; justify-content: flex-end;" href="destroy.php">Se deconnecter</a>
    </div>
  </div>
</nav>
<?php
require_once '../connexion.php';

if(isset($_POST['ajouter'])){
    $id_cat = $_POST['id_cat']; 
    $type_cat = $_POST['type_cat']; 

    if(!empty($id_cat) && !empty($type_cat)){
        // Check if id_cat already exists
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM categorie WHERE id_cat = ?');
        $stmt->execute([$id_cat]);
        $count = $stmt->fetchColumn();

        if($count > 0) {
            // Display error message if id_cat already exists
            echo '<div class="alert alert-danger" role="alert">id_cat already exists. Please choose a different id_cat.</div>';
        } else {
            // Insert new category
            $sqlState = $pdo->prepare('INSERT INTO categorie(id_cat,type_cat) VALUES(?,?)');
            $sqlState->execute([$id_cat, $type_cat]);
            header('location: liste_categorie.php');
            exit(); // Don't forget to exit after redirection
        }
    } else {
        // Display error message if id_cat or type_cat is empty
        echo '<div class="alert alert-danger" role="alert">id_cat and type_cat are required.</div>';
    }
}
?>


<form method="post">
    <label class="form-label">id</label>
    <input type="text" class="form-control" name="id_cat">

    <label class="form-label">type</label>
    <textarea class="form-control" name="type_cat"></textarea>

    

    <input type="submit" value="Ajouter catégorie" class="btn btn-primary my-2" name="ajouter">
</form>
</div>

</body>
</html>