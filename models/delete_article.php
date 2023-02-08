<?php
// on appelle le fichier que contient la connexion à la bd
require_once('models/database.php');
require_once('models/utils.php');
// On appel la function pour faire la connection a la base données et on la stoke en la variable $db
$db = getPdo();

/**
 * AVEC CET FICCHIER ON VA POUVOIR SUPPRIMER UN ARTICLE AVEC LA VARIABLE GLOBAL GET 
 * ET L'ID de la variable choisi pour l'utilisateur
 * 
 * Il va donc falloir bien s'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
 * Après de supprimir l'aticle on va l'indiquer au système de rediriger l'utilisateurs
 * vers la page d'accueil
 */

/**Alors...
 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die(" on n'a pas précisé l'id de l'article !");
}

$id = $_GET['id'];

/**
 * 2. On appelle a la function pour recuperer UN SEULE ARTICLE pour
 * Vérifie si l'article existe 
 */

if ($query->rowCount() === 0) {
    die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
}

/**
 * 3. Pour supprimir l'article
 */
$query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
$query->execute(['id' => $id]);

/**
 * 5. Redirection vers la page d'accueil 
 * header("Location: index.php");
 * exit();
 */
redirect('index.php');

?>