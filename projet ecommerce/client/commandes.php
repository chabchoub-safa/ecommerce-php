<?php function getAdmin($email, $password) {
    require("connexion.php");

    $req = $pdo->prepare("SELECT * FROM admin WHERE login=? AND password=?");

    $req->bindParam(':login', $login);
    $req->bindParam(':password', $password);

    $req->execute();

    if ($req->rowCount() == 1) {
        $data = $req->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}

function afficherUnProduit($id)
{
    if(require("connexion.php"))
    {
        $req = $pdo->prepare("SELECT * FROM Produits WHERE id=?");

        $req->execute(array($id));

        $data = $req->fetchAll(PDO::FETCH_OBJ);

        return $data;

        $req->closeCursor();
    }
}


  function ajouter($image, $nom, $prix, $desc, $id_cat)
  {
    if(require("connexion.php"))
    {
      $req = $pdo->prepare("INSERT INTO Produits (image, nom, prix, description, id_cat) VALUES (?, ?, ?, ?,?)");

      $req->execute(array($image, $nom, $prix, $desc, $id_cat));

      $req->closeCursor();
    }
  }

  function afficher()
  {
      if(require("connexion.php"))
      {
          $req = $pdo->prepare("SELECT Produits.*, categorie.type_cat AS nom_categorie FROM Produits INNER JOIN categorie ON Produits.id_cat = categorie.id_cat ORDER BY Produits.id DESC");
  
          $req->execute();
  
          $data = $req->fetchAll(PDO::FETCH_OBJ);
  
          return $data;
  
          $req->closeCursor();
      }
  }

function modifier($image, $nom, $prix, $desc, $id) {
  if(require("connexion.php")) {
      $req = $pdo->prepare("UPDATE Produits SET image=?, nom=?, prix=?, description=? WHERE id=?");

      $req->execute(array($image, $nom, $prix, $desc, $id));

      $req->closeCursor();
  }
}
function supprimer($id)
{
	if(require("connexion.php"))
	{
		$req=$pdo->prepare("DELETE FROM Produits WHERE id=?");

		$req->execute(array($id));

		$req->closeCursor();
	}
}
function getCategories() {
  if(require("connexion.php")) {
      $req = $pdo->prepare("SELECT * FROM categorie");
      $req->execute();
      $categories = $req->fetchAll(PDO::FETCH_ASSOC);
      return $categories;
  }
}
function afficherProduitsParCategorie($id_cat) {
  if(require("connexion.php")) {
      $req = $pdo->prepare("SELECT * FROM Produits WHERE id_cat = ?");
      $req->execute([$id_cat]);
      $produits = $req->fetchAll(PDO::FETCH_ASSOC);
      return $produits;
  }
}

function getCategorieById($id_categorie) {

  $categories = [
      ['id_cat' => 1, 'type_cat' => 'Femme'],
      ['id_cat' => 2, 'type_cat' => 'Homme'],
      ['id_cat' => 3, 'type_cat' => 'Enfant']
  ];

  foreach ($categories as $categorie) {
      if ($categorie['id_cat'] == $id_categorie) {
          return $categorie;
      }
  }
  return false; 
}
function ajouterAuPanier($nom, $quantite, $prix) {
  if (!isset($_SESSION['panier'])) {
      $_SESSION['panier'] = array();
  }

  // Add the product to the cart
  $_SESSION['panier'][] = array(
      'nom' => $nom,
      'quantite' => $quantite,
      'prix' => $prix
  );
}




?>