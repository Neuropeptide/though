document.addEventListener("DOMContentLoaded", function () {
    const $serviceMenu = document.querySelector("#services-menu");
    const $servicesContainer = document.querySelector(".services-container");
    const $serviceLinks = document.querySelectorAll(".service-link");

    $serviceMenu.addEventListener("click", function (event) {
        if (!event.target.classList.contains("service-link")) return;
        event.preventDefault();

        // enlever la classe "active" sur le lien actuellement activé
        $serviceMenu.querySelector(".active").classList.remove("active");
        // ou bien on enleve la classe "active" sur tous les liens
        /*
        for (const $link of $serviceLinks) {
          $link.classList.remove("active");
        }
        */

        // ajouter la classe "active" sur le lien cliqué
        event.target.classList.add("active");

        const service = event.target.dataset.link;

        // Masquer le contenu deja affiché (ici on les masques tous !)
        for (const $service of $servicesContainer.children) {
            $service.classList.remove("active");
        }

        // Trouver le contenu correspondant au lien cliqué
        const $content = $servicesContainer.querySelector(
            `[data-service=${service}]`
        );

        // Afficher le contenu correspondant
        $content.classList.add("active");
    });

    // -----------------------------------------------------------------------------
    // Menu
    // -----------------------------------------------------------------------------

    // const $menuToggle = document.querySelector("#menu-toggle");
    // const $menu = document.querySelector("#menu");

    // $menuToggle.addEventListener("click", function () {
    //   $menu.classList.toggle("open");
    // });
});
