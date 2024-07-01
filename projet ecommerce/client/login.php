
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
    <title>connexion</title>
    <link rel="stylesheet" href="style.css">
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
    
    <div class="container py-2">
    <?php 
if(isset($_POST['connexion'])){
    $login = $_POST['login'];
    $pwd = isset($_POST['password']) ;


    if(!empty($login) && !empty($pwd)){
        require_once 'connexion.php';
        $sqlState = $pdo->prepare( 'SELECT * FROM utilisateur
        WHERE login=?
        AND password=?');
        $sqlState->execute([$login,$pwd]);
        if($sqlState->rowCount()>=1){
            session_start();
            $_SESSION['utlisateur'] = $sqlState-> $sqlState->fetch();
            header('location:index.php');
        }
        
}else {
    ?>
    <div class="alert alert-danger" role="alert">
        login ou password incorrectes </div>
        <?php
}}?>

     
 <section>
            <div class="form-box">
                <div class="form-value">
                    <form method="post" action="index.php">
                        <h2>Login</h2>
                        <div class="inputbox"> <ion-icon name="mail-outline"></ion-icon> <input type="email" required>
                            <label>Email</label>
                        </div>
                        <div class="inputbox"> <ion-icon name="lock-closed-outline"></ion-icon> <input type="password"
                                required> <label>Password</label> </div>
                        <div class="forget"> <label><input type="checkbox">Remember Me</label> <a href="#">Forgot
                                Password</a> </div> <button>Log In</button>
                        <div class="register">
                            <p>Don't have an account? <a href="inscrit.php">Sign Up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </section> 


</body>
</html>

