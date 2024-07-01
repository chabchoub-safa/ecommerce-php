<?php
session_start();

require("../commandes.php");



?>

<!DOCTYPE html>
<html>
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<title></title>
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
        <a  class="nav-link" aria-current="page" href="../admin/afficher.php">Produits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" style="font-weight: bold;" aria-current="page" href="../admin/ajout.php">Nouveau</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="supprimer.php">Suppression</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="liste_categorie.php">liste_catergorie</a>
        </li>
        <li class="nav-item">
          <a  class="nav-link" href="ajouter_categorie.php">ajouter_categorie</a>
        </li>
      </ul>
      <div style="margin-right: 500px">
        <h5 style="color: #545659; opacity: 0.5;">Connecté en tant que: <?= $nom ?></h5>
      </div>
      
      <a class="btn btn-danger d-flex" style="display: flex; justify-content: flex-end;" href="destroy.php">Se deconnecter</a>
    </div>
  </div>
</nav>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

      
<form method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">L'image du produit</label>
    <input type="name" class="form-control" name="image" required>

  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Nom du produit</label>
    <input type="text" class="form-control" name="nom"  required>
  </div>

   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Prix</label>
    <input type="number" class="form-control" name="prix" required>
  </div>

   <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <textarea class="form-control" name="desc" required></textarea>
  </div>
  <?php
  require_once '../connexion.php';
        $categorie = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label class="form-label">Catégorie</label>
        <select name="categorie" class="form-control">
            <option value="">Choisissez une catégorie</option>
            <?php
            foreach ($categorie as $categorie) {
                echo "<option value='" . $categorie['id_cat'] . "'>" . $categorie['type_cat'] . "</option>";
            }
            ?>
</select>
  
  <button type="submit" name="valider" class="btn btn-primary">Ajouter un nouveau produit</button>
</form>

      </div></div></div>

    
</body>
</html>

<?php

if(isset($_POST['valider'])) {
  if(isset($_POST['image']) && isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['desc']) && isset($_POST['categorie'])) {
      if(!empty($_POST['image']) && !empty($_POST['nom']) && !empty($_POST['prix']) && !empty($_POST['desc']) && !empty($_POST['categorie'])) {
          $image = htmlspecialchars(strip_tags($_POST['image']));
          $nom = htmlspecialchars(strip_tags($_POST['nom']));
          $prix = htmlspecialchars(strip_tags($_POST['prix']));
          $desc = htmlspecialchars(strip_tags($_POST['desc']));
          $categorie = $_POST['categorie']; // Assurez-vous de récupérer la valeur de la catégorie

          try {
              ajouter($image, $nom, $prix, $desc, $categorie); // Assurez-vous de passer la valeur de la catégorie à la fonction 'ajouter'
              header('Location: afficher.php');
              exit(); // Assurez-vous de sortir après la redirection pour éviter l'exécution de code supplémentaire
          } catch (Exception $e) {
              echo $e->getMessage(); // Affichez le message d'erreur en cas de problème
          }
      }
  }
}
?>
