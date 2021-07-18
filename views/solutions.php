<?php

// Génération du Header+Navbar:
include(dirname(__FILE__).'/../views/templates/navBar.php');

?>
<div class="container-fluid h-100">
    <div class="card bg-light shadow bg-body rounded-3 mb-2">
        <div class="card-body">
            <h2 class="card-title">
                S'en protéger ?
            </h2>
            <p class="card-text">
                Pour se protéger des XSS il faut remplacer les caractères qui pourraient éventuellement
                être compris par le navigateur comme des balises par leur entité HTML.

                Le navigateur affichera textuellement le caractère et ne cherchera plus à l'interpréter.
                htmlentities encode tous les caractères spéciaux mais aussi les é è à ù… alors que htmlspecialchars
                se contente des caractères spéciaux ce qui suppose donc que vous utilisez un charset supportant les
                caractères comme é è à ù sinon vous aurez probablement des � à la place.

                Le paramètre ENT_QUOTES est ajouté à la fonction htmlentities ou htmlspecialchars pour préciser
                d'échapper également les simples guillemets car cela peut être problématique, notamment si, par exemple,
                vous utilisez la chaîne vulnérable dans un attribut d'une balise HTML qui est sous la forme
                attribut='valeur' : le simple guillemet n'étant pas échappé, il est donc encore possible de fermer cet
                attribut. Le ENT_QUOTES empêchera cela.

            </p>
            <div class="d-flex text-center border-top border-1 pt-2">Continuer à lire l'article

            </div>
        </div>
    </div>
</div>

<?php

// Génération du Footer:
include(dirname(__FILE__).'/../views/templates/footer.php');

?>