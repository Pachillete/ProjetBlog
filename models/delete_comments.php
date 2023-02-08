<?php
// on appelle le fichier que contient la connexion à la bd
require_once('models/database.php');
require_once('models/utils.php');
// On appel la function pour faire la connection a la base données et on la stoke en la variable $db
$db = getPdo();

/* 1. Récupération du paramètre "id" en GET
*/
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
   die("Ho ! Fallait préciser le paramètre id en GET !");
}

$id = $_GET['id'];



/**
* 2. Vérification de l'existence du commentaire
*/
$query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
$query->execute(['id' => $id]);
if ($query->rowCount() === 0) {
   die("Aucun commentaire n'a l'identifiant $id !");
}

/**
* 3. Suppression réelle du commentaire
* On récupère l'identifiant de l'article avant de supprimer le commentaire
*/

$commentaire = $query->fetch();
$article_id = $commentaire['article_id'];

$query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
$query->execute(['id' => $id]);

/**4. Redirection vers l'article en question
On peu aussi utiliser une function afin de executer cette partie
header("Location: article.php?id=" . $article_id);
exit();
*/
redirect("article.php?id=" . $article_id); 

?>