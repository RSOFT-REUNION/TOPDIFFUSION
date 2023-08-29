// Change format for Number input when the ".currency" class is present
$(document).ready(function () {
    $(".currency").change(function() {
        $(this).val(parseFloat($(this).val()).toFixed(2));
    });
});

function timeoutAlert()
{
    document.getElementById("alert").style.display = 'none'
}
setTimeout('timeoutAlert()', 1000);



function reloadPage() {
    location.reload();
}

// SLIDER PRIMARY
const slidesContainer = document.getElementById("slides-container");
const slide = document.querySelector(".slide");
const prevButton = document.getElementById("slide-arrow-prev");
const nextButton = document.getElementById("slide-arrow-next");

// Défilement automatique toutes les 30 secondes
setInterval(() => {
    const slideWidth = slide.clientWidth;
    slidesContainer.scrollLeft += slideWidth;

    if(slidesContainer.scrollLeft + slidesContainer.clientWidth >= slidesContainer.scrollWidth) {
        // Revenir au début du conteneur de diapositive
        slidesContainer.scrollLeft = 0;
    }

}, 6000);
nextButton.addEventListener("click", (even) => {
    const slideWidth = slide.clientWidth;
    slidesContainer.scrollLeft += slideWidth;

    if(slidesContainer.scrollLeft + slidesContainer.clientWidth >= slidesContainer.scrollWidth) {
        // Revenir au début du conteneur de diapositive
        slidesContainer.scrollLeft = 0;
    }
});
prevButton.addEventListener("click", (even) => {
    const slideWidth = slide.clientWidth;
    const scrollAmount = slideWidth


    if(slidesContainer.scrollLeft === 0) {
        // Si nous sommes au début, passer à la dernière diapositive
        slidesContainer.scrollLeft = slidesContainer.scrollWidth - slidesContainer.clientWidth;
    } else {
        slidesContainer.scrollLeft -= scrollAmount;
    }
});

