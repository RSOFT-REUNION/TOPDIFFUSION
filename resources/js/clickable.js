$(function () {
    $("table").on("click", "tr[role=\"button\"]", function (e) {
        window.location = $(this).data("href");
    });

    $("div").on("click", "div[role=\"button\"]", function () {
        window.location = $(this).data("href");
    })
});

// ************************ Vérifier si on clique en dehors de la div "CART_RESUME"
document.addEventListener("DOMContentLoaded", function () {
    const myDiv = document.getElementById("cart_resume");
    const myButton = document.getElementById("btn_cart_resume");
    const myIcon = document.getElementById("icon_cart_resume");

    // Affiche la div "CART_RESUME" lorsque l'on clique dessus
    myDiv.addEventListener("click", function (event){
        event.stopPropagation();
    })

    // Affiche la div lorsque l'on clique sur le bouton de panier
    myButton.addEventListener("click", function (event) {
        if(event.target === myButton || event.target === myIcon) {
            myDiv.style.display = "block";
            setTimeout(() => {
                myDiv.style.opacity = "1";
            }, 10);
        }
    })

    // Masque la div lorsque l'on clique en dehors de celle-ci
    document.addEventListener("click", function (event) {
        if (event.target !== myDiv && event.target !== myButton && event.target !== myIcon) {
            myDiv.style.opacity = "0";
            setTimeout(() => {
                myDiv.style.display = "none";
            }, 300);
        }
    })
})
