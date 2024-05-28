$(function () {
    // Rendre une DIV avec le rôle "button" cliquable
    $("div").on("click", "div[role=\"button\"]", function (e) {
        window.location = $(this).data("href");
    })

    // Rendre une ligne de table avec le role "button" cliquable
    $("table").on("click", "tr[role=\"button\"]", function (e) {
        window.location = $(this).data("href");
    })
})
