<?php
// cette page va a afficher Un article avec tous ses elements et ses commentaires
// on appelle le ficchier pour la connection a la base de données
require_once('models/database.php');
require_once('models/utils.php');
// On appel la function pour faire la connection a la base données et on la stoke en la variable $db
$db = getPdo();

// On part du principe qu'on ne possède pas de param "id"
$article_id = null;

// Mais si il y'en a un et que c'est un nombre entier, alors c'est bon
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $article_id = $_GET['id'];
}
// on appelle la function pour recuperer la liste de articles 
$article = findArticle($article_id);

// on appelle la function pour recuperer la liste de commentaires 
$commentaires = findAllComments($article_id);


$pageTitle = $article['title'];


/*
5 On affiche toutes les resultats jusqu'à la 
*/


ob_start();


// on appel a la function render et on le donne de paramètre l'url que on veut
// dans ce cas la sera le ficchier qui s'appel show

// render('show', ['pageTitle' => $pageTitle, 'article' =>$article, 'article_id'=> $article_id ]);


/* ON PEU AUSSI UTILISER LA FUNCTION -COMPACT- POUR SIMPLIFIER LE CODE 
cette function il fera la meme chose que la declaracion de un tableau asociative 
la diference que il le fera directament 
*/

render('show', compact('pageTitle', 'article', 'commentaires','article_id'));
// mz function COMPACT me permet de creer un tableau asociative a partir de le nom de la variable
// que je meterai la. 
/*
outre chose que on a fait se cree un tableau associative on le donnant de valeur a tous nous elements 
 cet tableau doit pouvoir interprete la page utils que contient la function render
 pour ca on utilisara la function extract. Grace a cette function on pourra transforme cet
 tableau en veritables variables que notre function pourra interprete



 */
?>