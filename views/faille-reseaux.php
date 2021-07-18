<?php

// Génération du Header+Navbar:
include(dirname(__FILE__).'/../views/templates/navBar.php');

?>

<div class="card bg-light shadow bg-body rounded-3 mb-2">
    <div class="card-body">
        <h2 class="card-title">
            S'en protéger ?
        </h2>
        <p class="card-text">

            L'essentiel est de faire en sorte de naviguer en toute sécurité. En chiffrant le trafic entre le réseau et
            votre appareil à l'aide d'un logiciel de chiffrement de navigation, vous pouvez repousser les éventuelles
            attaques dites de l'homme du milieu.

            Vérifiez toujours que les sites que vous visitez sont sécurisés. La plupart des navigateurs affichent un
            symbole de cadenas à côté de l'URL lorsqu'un site Web est sécurisé. Si vous ne voyez pas ce symbole,
            vérifiez que l'adresse Web commence par « https ». Le « S » signifie sécurisé et garantit que vos données ne
            seront pas susceptibles d'être interceptées par un pirate.

            Utiliser un pare-feu est également un moyen fiable de protéger vos données de navigation. Sans être
            infaillible, un pare-feu fournit un degré de sécurité supplémentaire lorsque vous utilisez un réseau wifi
            public. Si vous naviguez souvent sur un réseau wifi public, il est conseillé de configurer un réseau privé
            virtuel (VPN). Ce type de réseau protège votre trafic et complique la tâche des pirates qui voudrait
            l'intercepter.

            Mettez vos logiciels de sécurité à jour. Les cybercriminels ne cessent de s'adapter et de se perfectionner,
            vous devriez en faire de même. En mettant à jour votre solution de sécurité, vous avez accès en permanence à
            des outils dernier cri qui surveillent votre activité en ligne pour une navigation sécurisée et agréable.

        </p>
    </div>
</div>

<?php

// Génération du Footer:
include(dirname(__FILE__).'/../views/templates/footer.php');

?>