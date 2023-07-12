$(function () {
    $("table").on("click", "tr[role=\"button\"]", function (e) {
        window.location = $(this).data("href");
    });

    $("div").on("click", "div[role=\"button\"]", function () {
        window.location = $(this).data("href");
    })
});
