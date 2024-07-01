<?php
session_start();
require_once 'commandes.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    

    ajouterCommande($nom, $quantite, $prix);
    

    unset($_SESSION['panier']);

    header("Location: confirmation_commande.php");
    exit;
} else {
   
    header("Location: index.php");
    exit;
}
?>
