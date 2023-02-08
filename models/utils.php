<?php
// en function des actions des utilisateurs qui va se passer dans le url actions
// peu importa que action fait l'utilisateur tout a c'est passe dans la page Index


// on va creer une function qui peut nous renvoyer affiche le contenu du l'url que l'utilisateur a chosit
// Avec cette fonction render notre page se redigera dans l'url que l'utilisateur a choisi
// et fera execution dans chaque une de nous ficchier 
function render (string $path, array $variables =[]){
/* on doit passer aussi comme paramètre les valeurs de les variables que 
 que on veut aussi que render affiche. Pour ca on va creer un tableau pour 
 le donner les variables que render a besoin et qui son deja declare dans la page article
  alors a render on le fait passer un tableau que par defaut sera vide
*/
/*apres on va utiliser la funciton extract pour transforme le tableau associative en 
veritables variables 
*/
    extract($variables);
    ob_start();
    require('views/articles/'. $path .'.html.php');
    $pageContent = ob_get_clean(); 
    require('views/layout.html.php');
}

function redirect(string $url): void {
  header("Location: $url");
  exit();
}
?>