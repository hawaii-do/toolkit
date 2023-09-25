<?php

namespace Toolkit;

get_header()
?>

<main>
    <div class="page404-wrapper">
        <h1>Oups !</h1>
        <p>La page que vous recherchez n'existe pas</p>
        <a href="<?= home_url(); ?>" class="btn">Revenir sur la page d'accueil</a>
    </div>
</main>

<?php get_footer() ?>