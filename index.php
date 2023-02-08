<?php

require_once('models\database.php');
require_once('models\utils.php');
// cet ficchier va a afficher la liste des articles qui sera aussi la page d'accueil
// c'est que on appelle un "dispacher" 
// on va creer une function pour faire la connection à la base données
// pour ca on utiliza la extension PDO 

// 1. on va se connecter a la base de données
// et on va tester si il y a un erreur 

$db = getPdo();

$articles = finAllArticles();

$pageTitle = "Accueil";

// jusqy'à la je vais le dire garde tout l'information dans un tampon (le valeur de $ârticles et $pageC); Pour ça on utilise ob_start()
// dans le on_start on va garder le "require" qui se trouve dans le chemin suivant
// en suite, on va le dire maintenant tu recuperer le tampon et tu peu lire le contenu du tampon et tu le met dans la variable $pageContent
// et finalment on fait un require pour appeler le ficchier et celui la s'execute. Dans ce ficchier on trouvera les deux variables $pageTitle et $pageContent

render ('index', compact('pageTitle','articles' ))

/* ON A FAI CA AVANT DE UTILISER LA FUNCTION RENDER ET COMPACT
ob_start();
require('views\articles\index.html.php');
$pageContent = ob_get_clean();

require('views\layout.html.php');

// rappel toi que la idee ca etait de faire un tampon et le garder, recuperer tous les variables de index.html.php
 et que tu ce que j'ai recollecte on l'estoke dans la variable $pageContent



/* On affiche chaque article un par un
   foreach ($articles as $unArticle) {
   ?>
        <p><?php echo $unArticle['title']; ?></p>
<?php
}
*/


?> 