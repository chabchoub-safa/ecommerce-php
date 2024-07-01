

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  
    <div class="container py-2">
    <?php
    $erreur = ""; // Variable pour stocker les messages d'erreur

    if(isset($_POST['ajout'])){     /* POST, les données du formulaire sont envoyées au serveur */
        $login           = $_POST['login'];
        $pwd             = $_POST['password']; // assuming password field name
        $nom             = $_POST['nom'];
   

        // Vérifier si tous les champs obligatoires sont remplis
        if(empty($login) || empty($pwd) || empty($nom) ) { 
            $erreur = "Tous les champs sont obligatoires.";
        } else {
            require_once '../connexion.php'; // Inclure le fichier database.php pour établir la connexion à la base de données
          
            $sqlState = $pdo->prepare('INSERT INTO admin (login, password,  nom) VALUES (?,?,?)');

            $sqlState->execute([$login, $pwd,  $nom]);

            
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
        <form method="post">



            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom">

            <label class="form-label">Login</label>
            <input type="text" class="form-control" name="login">

            <label class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password">

            <input type="submit" value="Inscription" class="btn btn-primary my-2" name="ajout">  
        </form>
    </div>
</body>
</html>

