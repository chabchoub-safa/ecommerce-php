<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
</head>
<body>
    
    <?php/* include 'nav.php' */?>
    <div class="container py-2">
    <?php 
if(isset($_POST['connexion'])){
    $login = $_POST['login'];
    $pwd = isset($_POST['password']) ;


    if(!empty($login) && !empty($pwd)){
        require_once '../connexion.php';
        $sqlState = $pdo->prepare( 'SELECT * FROM admin
        WHERE login=?
        AND password=?');
        $sqlState->execute([$login,$pwd]);
        if($sqlState->rowCount()>=1){
            session_start();
            $_SESSION['admin'] = $sqlState-> $sqlState->fetch();
            header('location:admin/afficher.php');
        }
        
}else {
    ?>
    <div class="alert alert-danger" role="alert">
        login ou password incorrectes </div>
        <?php
}}?>
<h4>connexion</h4>
<form method="post" action="afficher.php">
    <label class="form-laabel">login</label>
    <input type="text" class="form-control" name="login">

    <label class="form-laabel">Password</label>
<input type="password" class="form-control" name="password">


    <input type="submit" value="connexion" class="btn btn-primary my-2" name="connexion">  
</form>
</div>
</body>
</html>