<?php
/**
 * CE FICHIER SERV A ENREGISTRER UN NOUVEAU COMMENTAIRE 
 * 
 * On doit d'abord vérifier que toutes les informations ont été entrées dans le formulaire
 * Si ce n'est pas le cas : un message d'erreur
 * Sinon, on va sauver les informations
 * 
 * Pour sauvegarder les informations, ce serait bien qu'on soit sur que l'article qu'on essaye de commenter existe
 * Il faudra donc faire une première requête pour s'assurer que l'article existe
 * Ensuite on pourra intégrer le commentaire
 * 
 * Et enfin on pourra rediriger l'utilisateur vers l'article en question
 */

// on appelle le fichier que contient la connexion à la bd
require_once('models/database.php');
require_once('models/utils.php');
// On appel la function pour faire la connection a la base données et on la stoke en la variable $db
$db = getPdo();

/**
 * 1. On vérifie que les données ont bien été envoyées en POST
 * D'abord, on récupère les informations à partir du POST
 * Ensuite, on vérifie qu'elles ne sont pas nulles
 */
// On commence par l'author
$author = null;
if (!empty($_POST['author'])) {
    $author = $_POST['author'];
}

// Ensuite le contenu
$content = null;
if (!empty($_POST['content'])) {
    // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
    $content = htmlspecialchars($_POST['content']);
}

// Enfin l'id de l'article
$article_id = null;
if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
}

// Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
// Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
if (!$author || !$article_id || !$content) {
    die("Votre formulaire a été mal rempli !");
}

// 2.  Requette vers la base de données 

$query = $pdo->prepare('SELECT * FROM articles WHERE id = :article_id');
$query->execute(['article_id' => $article_id]);

// Si rien n'est revenu, on fait une erreur
if ($query->rowCount() === 0) {
    die("Ho ! L'article $article_id n'existe pas boloss !");
}

// 3. Insertion du commentaire
$query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
$query->execute(compact('author', 'content', 'article_id'));

// 4. Redirection vers l'article en question :
redirect("article.php?id=" . $article_id); 

?>