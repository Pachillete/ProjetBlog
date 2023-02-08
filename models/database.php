<?php
// dans cet ficchier on stoke tout l'information en php que on demandera de afficher 

try {

// 1. Premier function servira a appeller la base de données 

    function getPdo(): PDO
    {
        $db = new PDO('mysql:host=localhost;dbname=blogperso;charset=utf8','root','',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        /* mais pour que la function soit explotable. Il faut que la variable que a stoke le resultat $db soit explotable et que nos renvoi quelque chose 
        donc on va faire un return de la variable de la function ou du resultat de la function que sera stoke dans la variable $db. C'est a dire etablir la connection
        alors il va retourne quelque chose de la extention PDO
        */
        return $db;
    }
}
catch (Exception $e)
    {

    die('Erreur : ' . $e->getMessage());
    }
    /* 2. On va a creer une function servira pour executer la requete sql pour appeler tous les articles de la 
    base de données 
    */

    // on a creer la function et on a copie notre code de la page index.php et après on a fait
    // un return, pour que puis nous returne le tableau que contient la liste des articles
    // classe pour la date de creation  

    function finAllArticles(): array {
        $db = getPdo();
    // on va utiliser la methode query (veut dire prepare et executer la requete)

        $resultats = $db->query('SELECT * FROM articles ORDER BY created_at DESC');

    // on va le demander d'aller feuille et recuperer les donnees et les stoker dans une variable $articles
        $articles = $resultats->fetchAll();
    return $articles;
    }

    /* 3. On va creer une function a la quelle on va l'envoyer un identifiand et elle va 
    nous retourne l'article complet
    */

    function findArticle(int $id) : array {
    // il faut preciser de quoi il s'agit la variable $db
    $db = getPdo();
    /*On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
    jamais confiance à l'utilisateur
    stoke dans la variable $query une requete de preparation de la base données 
    del paramètre articles ou l'id a comment valeur article_id
    */
    $query = $db->prepare("SELECT * FROM articles WHERE id = :article_id");

    // On exécute la requête et on precise le paramètre :article_id 
    // atention on va le dire que la variable que contiendra le resultad de la requete
    // sera $id. La meme variable que on a define dans notre parametre de function 
    $query->execute(['article_id' => $id]);

    // On fouille le résultat pour en extraire les données réelles de l'article
    $article = $query->fetch();
    // si on me pas return alors le serveur nous demande pourquoi on a demande un array
    // alors que on demande pas le tableau. 
    // ce pour quoi c'est important de faire le return pour que nous renvoi le tableau
    return $article;

    }
    /*
    On fera la meme chose pour la requete que nous permetra recuperer tous les commentaires
    */
    function  findAllComments(int $article_id) : array {
    $db = getPdo();
        /**
    * Récupération des commentaires de l'article en question
    * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
    */
    $query = $db->prepare("SELECT * FROM comments WHERE article_id = :article_id");
    $query->execute(['article_id' => $article_id]);
    $commentaires = $query->fetchAll();

    return $commentaires;

    }

?>