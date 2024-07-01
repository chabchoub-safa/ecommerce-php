<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Catégorie</title>
</head>
<body>
    

    <?php
    require_once '../connexion.php';
    $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id_cat=?');
    $id_cat = $_GET['id_cat'];
    $sqlState->execute([$id_cat]);

    $categorie = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modifier'])) {
        $id_cat = $_POST['id_cat'];
        $type_cat = $_POST['type_cat'];
       

        if (!empty($id_cat) && !empty($type_cat)) {
            $sqlState = $pdo->prepare('UPDATE categorie
            SET id_cat = ?,
                type_cat = ?
            WHERE id_cat = ?
            ');
            $sqlState->execute([$id_cat, $type_cat]);
            header('location: liste_categories.php');
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Libelle , description sont obligatoires
            </div>
            <?php
      }

    }

    ?>
<form method="post">
    <?php if ($categorie): ?>
        <input type="hidden" class="form-control" name="id_cat" value="<?php echo $categorie['id_cat'] ?>">
<label class="form-label">Type</label>
<input type="text" class="form-control" name="type_cat" value="<?php echo $categorie['type_cat'] ?>">

        <input type="submit" value="Modifier catégorie" class="btn btn-primary my-2" name="modifier">
    <?php endif; ?>
</form>

</body>
</html>
