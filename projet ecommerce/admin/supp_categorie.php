<?php
    require_once '../connexion.php';
    $id_cat = $_GET['id_cat'];
    $sqlState = $pdo->prepare('DELETE FROM categorie WHERE id_cat=?');
    $supprime = $sqlState->execute([$id_cat]);
    header('location: liste_categorie.php');