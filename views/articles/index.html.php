<h1>Mes articles</h1>

<?php
//  Ici on va recuperer tous les elements de notre  table "articles" 
// Avec la function Foreach, on va le dire 
?>
<?php foreach ($articles as $unArticle) : ?>
    <h2><?= $unArticle['title'] ?></h2>
    <small>Ecrit le <?= $unArticle['created_at'] ?></small>
    <p><?= $unArticle['chapo'] ?></p>
    <a href="article.php?id=<?= $unArticle['id'] ?>">Lire la suite</a>
    <a href="models/delete_article.php?id=<?= $unArticle['id'] ?>" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a>
<?php endforeach ?>